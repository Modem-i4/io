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
                        <dt-edit-dialog
                            :return-value.sync="newItem.title"
                            save-text="Зберегти"
                            cancel-text="Відмінити"
                            @save="test(newItem)"
                            @cancel="cancel"
                            validateable
                            persistent
                        >
                            SomeText
                            <template v-slot:input>
                                <v-text-field
                                    v-model="newItem.title"
                                    :counter="200"
                                    :error-messages="errors"
                                    label="Введіть назву"
                                    required
                                ></v-text-field>
                            </template>
                        </dt-edit-dialog>
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
                            <v-edit-dialog
                                :return-value.sync="props.item.title"
                                @save="update(props.item)"
                                @cancel="cancel"
                                persistent
                                large
                            >
                                {{ props.item.title }}
                                <template v-slot:input>
                                    <v-text-field
                                        v-model="props.item.title"
                                        :counter="200"
                                        :error-messages="errors"
                                        label="Edit"
                                        single-line
                                        required
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
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
                            <v-dialog v-model="dialogDelete" max-width="500px">
                                <v-card>
                                    <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                        <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                @click="deleteItem(item)"
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
            //////////////////
            dialogDelete: false,
            watch: {
                dialogDelete (val) {
                    val || this.closeDelete()
                },
            },
            //////////////////////
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
        /////////////////////
        deleteItem (item) {
           // this.editedIndex = this.desserts.indexOf(item)
            //this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
          //  this.desserts.splice(this.editedIndex, 1)
            this.closeDelete()
        },
        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
        //////////////////
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
