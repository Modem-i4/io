<template>
    <div class="">
        <validation-observer
            ref="itemCreateObserver"
            v-slot=""
        >
                <v-row>
                    <v-col
                        cols="12"
                        md="4"
                    >
                        <validation-provider
                            v-slot="{ errors }"
                            name="Назва"
                            rules="required|max:200"
                        >
                            <v-text-field
                                v-model="newItem.title"
                                :counter="200"
                                :error-messages="errors"
                                label="Введіть назву"
                                required
                            ></v-text-field>
                        </validation-provider>
                    </v-col>

                    <v-col
                        cols="12"
                        md="4"
                    >
                        <validation-provider
                            v-slot="{ errors }"
                            name="Корпус"
                            rules="required"
                        >
                            <v-combobox
                                v-model="newItem.parent_department"
                                :items="allDepartments"
                                :error-messages="errors"
                                label="Батьківський департамент"
                                item-text="title"
                                item-value="id"
                                return-object
                                required
                            ></v-combobox>
                        </validation-provider>
                    </v-col>
                    <v-col
                        class="d-flex align-items-center"
                        cols="12"
                        md="4"
                    >
                        <v-btn
                            class="mr-4"
                            @click="create"
                        >
                            <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати приміщення</span>
                        </v-btn>
                    </v-col>
                </v-row>
        </validation-observer>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="py-3">
                        <delete-selected-button
                            @click.native="deleteSelectedItems"
                            :disabled="isSelectedAny"
                        ></delete-selected-button>
                    </div>
                </div>
                <v-card>
                    <v-card-title>
                        Приміщення
                        <v-spacer></v-spacer>
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
                            itemsPerPageOptions: [10, 25, 50]
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
                                    save-text="Зберегти"
                                    cancel-text="Відмінити"
                                    @save="update(props.item)"
                                    @cancel="cancel"
                                    large
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
                                                label="Edit"
                                                single-line
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.parent_department.title="props">
                            <v-edit-dialog
                                :return-value.sync="props.item.parent_department"
                                save-text="Зберегти"
                                cancel-text="Відмінити"
                                @save="update(props.item)"
                                @cancel="cancel"
                                large
                            >
                                {{ props.item.parent_department.title }}
                                <template v-slot:input>
                                    <v-combobox
                                        v-model="props.item.parent_department"
                                        :items="allDepartments"
                                        label="Виберіть батьківський департамент"
                                        item-text="title"
                                        item-value="id"
                                    ></v-combobox>
                                </template>
                            </v-edit-dialog>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                @click="deleteSingleItem(item.id)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                    </v-data-table>
                    <v-snackbar
                        v-model="snack.visible"
                        :timeout="3000"
                        :color="snack.color"
                    >
                        {{ snack.text }}

                        <template v-slot:action="{ attrs }">
                            <v-btn
                                v-bind="attrs"
                                text
                                @click="snack.visible = false"
                            >
                                Закрити
                            </v-btn>
                        </template>
                    </v-snackbar>
                </v-card>
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="py-3">
                        <delete-selected-button
                            @click.native="deleteSelectedItems"
                        ></delete-selected-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { DataTableCore } from "./mixins/DataTableCore";

export default {
    mixins: [DataTableCore],
    data () {
        return {
            allDepartments: [],
            crudApiEndpoint: '/api/departments',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: "Назва", value: 'title' },
                { text: 'Корпус', value: 'parent_department.title', fieldNameForSort: 'parent.title' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
        test() {
            console.log(this.$refs.testProviderRef);
        },
        prepareItemForUpdate(item) {
            return {
                id: item.id,
                parent_id: (item.parent_department ?? {}).id,
                title: item.title,
            };
        },
        prepareItemForCreate(data) {
            return {
                title: data.title,
                parent_id: (data.parent_department ?? {}).id,

            };
        },
        getAllDepartments() {
            this.loading = true;

            axios.get('/api/departments/all').then(response => {
                this.allDepartments = response.data;

                this.loading = false;
            })
            .catch(error => {
                if (error.response) {
                    // Сервер повернув помилку
                    this.snackError('Помилка завантаження ' + error.response.status)
                } else if (error.request) {
                    // Сервер не повернув нічого
                    this.snackError('Не вдалось підключитися до сервера')
                } else {
                    // Сталася помилка при створенні запиту
                    this.snackError('Сталася помилка при створенні запиту')
                }

                this.loading = false;
            });
        },
    },
    mounted() {
        this.getAllDepartments();
    }
}
</script>
