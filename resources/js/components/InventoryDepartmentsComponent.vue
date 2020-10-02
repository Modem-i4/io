<template>
    <div class="">
            <div class="form-inline">
            <div class="form-group mr-3">
                <label for="addtitle" class="my-1 mr-2">Назва:</label>
                <input v-model="add_parent_title" type="text" class="form-control" id="addTitle" placeholder="Введіть назву" name="addTitle" minlength="3" required>
            </div>
            <div class="form-group mr-3">
                <label for="addPlace" class="my-1 mr-2">Корпус:</label>
                <v-combobox
                    v-model="add_parent_department"
                    :items="allDepartments"
                    label="Виберіть батьківський департамент"
                    item-text="title"
                    item-value="id"
                ></v-combobox>
            </div>
            <button type="submit" class="btn btn-primary p-2 border rounded" @click="addNewItem">
                <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати приміщення</span>
            </button>
            </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="py-3">
                        <delete-selected-button
                            @click.native="deleteSelectedItems"
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
                                @save="save(props.item)"
                                @cancel="cancel"
                            >
                                {{ props.item.title }}
                                <template v-slot:input>
                                    <v-text-field
                                        v-model="props.item.title"
                                        :rules="[max50chars]"
                                        label="Edit"
                                        single-line
                                        counter
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </template>

                        <template v-slot:item.parent_department.title="props">
                            <v-edit-dialog
                                :return-value.sync="props.item.parent_department"
                                save-text="Зберегти"
                                cancel-text="Відмінити"
                                @save="save(props.item)"
                                @cancel="cancel"
                                large
                            >
                                {{ props.item.parent_title }}
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
            add_parent_title: null,
            add_parent_department: null,

            max50chars: v => v.length <= 50 || 'Input too long!',
            crudApiEndpoint: '/api/departments/',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: "Назва", value: 'title' },
                { text: 'Корпус', value: 'parent_department.title', fieldNameForSort: 'parent_title' },
            ],
        }
    },
    methods: {
        prepareItemForSave(item) {
            return {
                id: item.id,
                parent_id: item.parent_department.id,
                title: item.title,
            };
        },
        prepareItemForSaveNew() {
            return {
                title: this.add_parent_title,
                parent_id: this.add_parent_department.id,

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
        addNewItem() {
            if (typeof this.prepareItemForSaveNew === 'function') {
                var item = this.prepareItemForSaveNew();
            }
            axios.post(this.crudApiEndpoint, item)

                .then(response => {console.log(item);
                    this.snackSuccess('Збережено');
                    this.fetch();
                }).catch(error => {
                if (error.response) {console.log(item);
                    // Сервер повернув помилку
                    let errorText;

                    switch (error.response.status) {
                        case 422:
                            errorText = 'Помилка валідації!';
                            console.log(error.response.data);
                            break;
                        default:
                            errorText = 'Помилка ' + error.response.status;
                            break;
                    }
                    this.snackError(errorText);
                } else if (error.request) {
                    // Сервер не повернув нічого
                    this.snackError('Не вдалось підключитися до сервера')
                } else {
                    // Сталася помилка при створенні запиту
                    this.snackError('Сталася помилка при створенні запиту')
                }
            });

        },
    },
    mounted() {
        this.getAllDepartments();
    }
}
</script>
