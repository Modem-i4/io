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
                                        :rules="[max25chars]"
                                        label="Edit"
                                        single-line
                                        counter
                                    ></v-text-field>
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
            max25chars: v => v.length <= 25 || 'Input too long!',
            crudApiEndpoint: '/api/departments/',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: "Назва", value: 'title' },
                { text: 'Корпус', value: 'parent_title' },
            ],
        }
    },
}
</script>
