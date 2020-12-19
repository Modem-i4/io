<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <v-card>
                <v-card-title>
                    Накладні
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
            crudApiEndpoint: '/api/invoices',
            headers: [
                { text: 'id', align: 'start',  value: 'id'
                    // sortable: false,
                },
                { text: 'Номер', value: 'number' },
                { text: 'Постачальник', value: 'provider_title' },
                { text: 'Дата накладної', value: 'date' },
                { text: 'Загальна сума', value: 'total_sum' },
                //TODO: { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    }
}
</script>
