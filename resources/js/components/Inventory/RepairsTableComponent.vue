<template>
    <div class="">
        <validation-observer
            ref="itemCreateObserver"
            v-slot=""
        >
            <v-row>
                <v-col
                    cols="12"
                    lg="2"
                    md="4"
                >
                    <v-autocomplete
                        v-model="newItem.item_id"
                        :items="itemsInfo"
                        :error-messages="errors"
                        item-text="inventory_number"
                        item-value="id"
                        label="Інвентарний номер"
                    ></v-autocomplete>
                </v-col>

                <v-col
                    cols="12"
                    lg="2"
                    md="4"
                >
                    <v-autocomplete
                        v-model="newItem.user_id"
                        :items="users"
                        :error-messages="errors"
                        item-text="name"
                        item-value="id"
                        label="Користувач"
                    ></v-autocomplete>
                </v-col>
                <v-col
                    cols="12"
                    lg="2"
                    md="4"
                >
                    <v-autocomplete
                        v-model="newItem.provider_id"
                        :items="providers"
                        :error-messages="errors"
                        item-text="title"
                        item-value="id"
                        label="Виконавець"
                    ></v-autocomplete>
                </v-col>
                <v-col
                    cols="12"
                    lg="2"
                    md="4"
                >
                    <datepicker-dropdown
                        v-model="newItem.start_date"
                        input-label="Дата початку"
                        input-icon="mdi-calendar"
                        required
                    >
                    </datepicker-dropdown>
                </v-col>
                <v-col
                    cols="12"
                    lg="2"
                    md="4"
                >
                    <datepicker-dropdown
                        v-model="newItem.end_date"
                        value="value"
                        input-label="Дата закінчення"
                        input-icon="mdi-calendar"
                    >
                    </datepicker-dropdown>
                </v-col>
                <v-col
                    class="d-flex align-items-center"
                    cols="12"
                    lg="2"
                    md="4"
                >
                    <v-btn
                        class="mr-4"
                        @click="create"
                    >
                        <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати ремонт</span>
                    </v-btn>
                </v-col>
            </v-row>
        </validation-observer>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="py-3">
                        <dt-delete-selected
                            @click.native="deleteSelectedItems"
                            :disabled="isSelectedAny"
                        ></dt-delete-selected>
                    </div>
                </div>
                <v-card>
                    <v-card-title>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Пошук"
                            single-line
                            hide-details
                            clearable
                        ></v-text-field>
                    </v-card-title>

                    <v-data-table
                        v-model="selected"
                        show-select
                        :footer-props="{
                            itemsPerPageOptions: [10, 25]
                        }"
                        :headers="headers"
                        :items="items"
                        :options.sync="options"
                        :server-items-length="pagination.total"
                        :loading="loading"
                        class="elevation-1"
                    >
                        <template v-slot:item.end_date="props">

                            <validation-observer
                                :ref="getValidatorRef('title', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.title"
                                    :validator="$refs[getValidatorRef('title', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.end_date }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Назва"
                                            rules="required|max:40"
                                        >
                                            <v-text-field
                                                v-model="props.item.end_date"
                                                :counter="40"
                                                :error-messages="errors"
                                                label="Назва"
                                                single-line
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.actions="{ item }">
                            <dt-delete-single
                                @delete="deleteSingleItem(item.id)"
                                :isSelectable="item.isSelectable"
                            ></dt-delete-single>
                        </template>
                    </v-data-table>
                </v-card>
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="py-3">
                        <dt-delete-selected
                            @click.native="deleteSelectedItems"
                        ></dt-delete-selected>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DataTableCore from "../mixins/DataTableCore";
import DatePickerDropdownComponent from "../DatePickerDropdownComponent";
export default {
    mixins: [DataTableCore],
    components: {
        'datepicker-dropdown': DatePickerDropdownComponent,
    },
    data () {
        return {
            allRepairs: [],
            users: [],
            itemsInfo: [],
            providers: [],
            isSelectableByDefault: false,
            crudApiEndpoint: '/api/repairs',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                    // sortable: false,
                },
                { text: "Інвентарний номер", value: 'inventory_number' },
                { text: 'Користувач', value: 'user' },
                { text: 'Виконавець', value: 'provider' },
                { text: 'Дата початку', value: 'start_date' },
                { text: 'Дата кінця', value: 'end_date' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
        prepareItemForUpdate(item) {
            return {
                id: item.id,
                item_id: item.item_id,
                start_date: item.start_date,
                end_date: item.end_date,
                user_id: item.user_id,
                provider_id: item.provider_id,
            };
        },
        prepareItemForCreate(data) {
            return {
                item_id: data.item_id,
                start_date: data.start_date,
                end_date: data.end_date,
                user_id: data.user_id,
                provider_id: data.provider_id,
            };
        },
        getAllRepairs() {
            this.loading = true;
            axios.get('/api/repairs/all').then(response => {
                this.allRepairs = response.data;
                this.loading = false;
            })
                .catch(error => this.handleRequestError(error));
        },
        getAvailableUsers() {
            axios.get('/api/users/all').then(response => {
                this.users = response.data;
            }).catch(error => this.handleRequestError(error));
        },
        getItems() {
            axios.get('/api/items/all').then(response => {
                this.itemsInfo = response.data;
            }).catch(error => this.handleRequestError(error));
        },
        getAllProviders() {
            axios.get('/api/providers/all').then(response => {
                this.providers = response.data;
            }).catch(error => this.handleRequestError(error));
        },
    },
    mounted() {
        this.getAllRepairs();
        this.getAvailableUsers();
        this.getItems();
        this.getAllProviders();
    }
}
</script>
