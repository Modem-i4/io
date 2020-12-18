<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                    :footer-props="footerOptions"
                    :headers="headers"
                    :items="items"
                    :options.sync="options"
                    :server-items-length="pagination.total"
                    :loading="loading"
                    class="elevation-1"
                >
                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

<script>
import DataTableCore from "../mixins/DataTableCore";

export default {
    mixins: [DataTableCore],
    data () {
        return {
            crudApiEndpoint: '/api/licenses',
            headers: [
                { text: 'id', align: 'start',  value: 'id'
                   // sortable: false,
                },
                { text: 'Назва', value: 'title' },
                { text: 'Предмет', value: 'item_number' },
                { text: 'Накладна', value: 'invoice_number' },
                { text: 'Власник', value: 'owner_name' },
                { text: 'Ціна', value: 'price' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    }
}
</script>
