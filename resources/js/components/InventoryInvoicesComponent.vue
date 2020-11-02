<template>
    <div class="">

        <validation-observer
            ref="itemCreateObserver"
            v-slot=""
        >
            <v-row>
                <v-col
                    cols="12"
                    md="3"
                >
                    <validation-provider
                        v-slot="{ errors }"
                        name="Номер накладної"
                        rules="required|max:200"
                    >
                        <v-text-field
                            v-model="newItem.title"
                            :counter="200"
                            :error-messages="errors"
                            label="Номер накладної"
                            required
                        ></v-text-field>
                    </validation-provider>
                </v-col>
                <v-col
                    cols="12"
                    md="3"
                >
                    <validation-provider
                        v-slot="{ errors }"
                        name="Дата накладної"
                        rules="required|max:200"
                    >
                    <v-menu
                        ref="menu1"
                        v-model="menu1"
                        :close-on-content-click="false"
                        transition="scale-transition"
                        offset-y
                        max-width="290px"
                        min-width="290px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="dateFormatted"
                                label="Дата накладної"
                                hint="ДД/ММ/РРРР"
                                persistent-hint
                                prepend-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="date = parseDate(dateFormatted)"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="newItem.date"
                            :error-messages="errors"
                            no-title
                            @input="menu1 = false"
                            required
                        ></v-date-picker>
                    </v-menu>
                    </validation-provider>
                </v-col>

                <v-col
                    cols="12"
                    md="3"
                >
                    <validation-provider
                        v-slot="{ errors }"
                        name="Постачальник"
                        rules="required"
                    >
                        <v-autocomplete
                            v-model="newItem.provider"
                            :items="allProviders"
                            :error-messages="errors"
                            label="Постачальник"
                            item-text="title"
                            item-value="id"
                            return-object
                        ></v-autocomplete>
                    </validation-provider>
                </v-col>
                <v-col
                    cols="12"
                    md="3"
                >
                    <v-file-input
                        counter
                        truncate-length="50"
                    ></v-file-input>
                </v-col>
            </v-row>
            <v-row>
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th class="text-left">
                                #
                            </th>
                            <th class="text-left">
                                Тип
                            </th>
                            <th class="text-left">
                                Інвентарний номер
                            </th>
                            <th class="text-left">
                                Матер. відп. особа
                            </th>
                            <th class="text-left">
                                Приміщення
                            </th>
                            <th class="text-left">
                                Ліцензія
                            </th>
                            <th class="text-left">
                                Модель
                            </th>
                            <th class="text-left">
                                Ціна
                            </th>
                            <th class="text-left">
                                Кількість
                            </th>
                            <th class="text-left">
                                Сума
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0</td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Тип"
                                >
                                    <v-autocomplete
                                        v-model="newItem.model"
                                        :items="allTypes"
                                        :error-messages="errors"
                                        label="Тип"
                                        item-text="title"
                                        item-value="id"
                                        return-object
                                    ></v-autocomplete>
                                </validation-provider>
                            </td>
                            <td>
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Інвентарний номер"
                                        rules="required|max:200"
                                    >
                                        <v-text-field
                                            v-model="newItem.inum"
                                            :counter="200"
                                            :error-messages="errors"
                                            label="Інвентарний номер"
                                            required
                                        ></v-text-field>
                                    </validation-provider>
                            </td>
                            <td>
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Матеріально відповідальна особа"
                                        rules="required"
                                    >
                                        <v-autocomplete
                                            v-model="newItem.model"
                                            :items="allUsers"
                                            :error-messages="errors"
                                            label="Матеріально відповідальна особа"
                                            item-text="title"
                                            item-value="id"
                                            return-object
                                        ></v-autocomplete>
                                    </validation-provider>
                            </td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Приміщення"
                                    rules="required"
                                >
                                    <v-autocomplete
                                        v-model="newItem.parent"
                                        :items="allDepartments"
                                        :error-messages="errors"
                                        label="Приміщення"
                                        item-text="title"
                                        item-value="id"
                                        return-object
                                    ></v-autocomplete>
                                </validation-provider>
                            </td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Ліцензія"
                                >
                                    <v-autocomplete
                                        v-model="newItem.model"
                                        :items="allLicences"
                                        :error-messages="errors"
                                        label="Ліцензія"
                                        item-text="title"
                                        item-value="id"
                                        return-object
                                    ></v-autocomplete>
                                </validation-provider>
                            </td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Модель"
                                    rules="required"
                                >
                                    <v-autocomplete
                                        v-model="newItem.model"
                                        :items="allModels"
                                        :error-messages="errors"
                                        label="Модель"
                                        item-text="title"
                                        item-value="id"
                                        return-object
                                    ></v-autocomplete>
                                </validation-provider>
                            </td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Ціна"
                                    rules="required|max:20"
                                >
                                    <v-text-field
                                        v-model="newItem.price"
                                        :counter="20"
                                        :error-messages="errors"
                                        label="Ціна"
                                        required
                                    ></v-text-field>
                                </validation-provider>
                            </td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Кількість"
                                    rules="required|max:20"
                                >
                                    <v-text-field
                                        v-model="newItem.amount"
                                        :counter="20"
                                        :error-messages="errors"
                                        label="Кількість"
                                        type="number"
                                        required
                                    ></v-text-field>
                                </validation-provider>
                            </td>
                            <td>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Сума"
                                    rules="required"
                                >
                                    <v-text-field
                                        v-model="newItem.sum"
                                        :error-messages="errors"
                                        label="Сума"
                                        required
                                        disabled
                                    ></v-text-field>
                                </validation-provider>
                            </td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-row>
            <v-row>
                <v-col
                    class="d-flex align-items-center"
                    cols="12"
                    md="4"
                >
                    <v-btn
                        class="mr-4"
                        @click="create"
                    >
                        <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати накладну</span>
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
                        <!--Приміщення
                        <v-spacer></v-spacer>-->
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
                            itemsPerPageOptions: [10, 25, 50, 100]
                        }"
                        :headers="headers"
                        :items="items"
                        :options.sync="options"
                        :server-items-length="pagination.total"
                        :loading="loading"
                        class="elevation-1"
                    >
                        <template v-slot:item.title="props">

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
                                    {{ props.item.title }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Назва"
                                            rules="required|max:200"
                                        >
                                            <v-text-field
                                                v-model="props.item.title"
                                                :counter="200"
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

                        <template v-slot:item.parent.title="props">
                            <validation-observer
                                :ref="getValidatorRef('parent', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.parent"
                                    :validator="$refs[getValidatorRef('parent', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ (props.item.parent) ? props.item.parent.title : ' ' }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Назва"
                                            rules="required|max:200"
                                        >
                                            <v-autocomplete
                                                v-model="props.item.parent"
                                                :items="allDepartments"
                                                :error-messages="errors"
                                                label="Виберіть батьківський департамент"
                                                item-text="title"
                                                item-value="id"
                                                return-object
                                            ></v-autocomplete>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <dt-delete-single
                                tooltipText="Має дочірні компоненти"
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
import { DataTableCore } from "./mixins/DataTableCore";
import { EventBus } from "./EventBus";

export default {
    mixins: [DataTableCore],
    data () {
        return {
            allDepartments: [],
            isSelectableByDefault: false,
            crudApiEndpoint: '/api/departments',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: "Назва", value: 'title' },
                { text: 'Корпус', value: 'parent.title', fieldNameForSort: 'parent.title' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
        test() {
            console.log(this.$refs.testProviderRef);
        },
        prepareItemForUpdate(item) {
            console.log('Typeof object - ', typeof item.parent);
            console.log('Typeof object with replace - ', typeof (item.parent ?? {}));
            return {
                id: item.id,
                parent_id: (item.parent ?? {}).id,
                title: item.title,
            };
        },
        prepareItemForCreate(data) {
            return {
                title: data.title,
                parent_id: (data.parent ?? {}).id,

            };
        },
        getAllDepartments() {
            this.loading = true;

            axios.get('/api/departments/all').then(response => {
                this.allDepartments = response.data;

                this.loading = false;
            })
            .catch(error => this.handleRequestError(error));
        },
    },
    mounted() {
        this.getAllDepartments();
    },
    created() {
        EventBus.$on('dt-item-updated', data => {
            this.getAllDepartments();
        });

        EventBus.$on('dt-item-created', data => {
            this.getAllDepartments();
        });

        EventBus.$on('dt-item-deleted', data => {
            this.getAllDepartments();
        });

        EventBus.$on('dt-fetched', data => {
            this.items.forEach(item => {
                item.isSelectable = (item.children_count === 0);
            })
        });
    }
}
</script>
