<template>
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

                        <template v-slot:item.parent_title="props">
                            <v-edit-dialog
                                :return-value.sync="props.item.parent_id"
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

</template>

<script>
import { DataTableCore } from "./mixins/DataTableCore";

export default {
    mixins: [DataTableCore],

    data () {
        return {
            allDepartments: [],

            max50chars: v => v.length <= 50 || 'Input too long!',
            crudApiEndpoint: '/api/departments/',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: "Назва", value: 'title' },
                { text: 'Корпус', value: 'parent_title' },
            ],

            prepareItemForSave(item) {
                return {
                    id: item.id,
                    parent_id: item.parent_department.id,
                    title: item.title,
                };
            }
        }
    },
    methods: {
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
