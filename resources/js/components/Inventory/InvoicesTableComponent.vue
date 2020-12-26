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
                    :headers="headers"
                    :items="items"
                    :footer-props="footerOptions"
                    :options.sync="options"
                    :server-items-length="pagination.total"
                    :loading="loading"
                    :expanded.sync="expanded"
                    show-expand
                    show-select
                >
                    <template v-slot:expanded-item="{ headers, item }">
                        <td :colspan="headers.length">
                            <v-container
                                fluid
                            >
                                <invoice-full-data
                                    :invoice-id="item.id"
                                ></invoice-full-data>
                            </v-container>

                        </td>
                    </template>

                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

<script>
import DataTableCore from "../mixins/DataTableCore";
import InvoiceFullDataComponent from "./Invoice/InvoiceFullDataComponent";


export default {
    mixins: [DataTableCore],
    components: {
        'invoice-full-data': InvoiceFullDataComponent
    },
    data () {
        return {
            expanded: [],

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
                { text: '', value: 'data-table-expand' },
            ],
            itemsHeaders: [
                { text: 'id', align: 'start',  value: 'id' },
                { text: 'Номер', value: 'inventory_number' },
                { text: 'Тип', value: 'type_title' },
                { text: 'Модель', value: 'model_title' },
                { text: 'Власник', value: 'owner_name' },
                { text: 'Статус', value: 'status_title' },
            ],
            licensesHeaders: [
                { text: 'id', align: 'start',  value: 'id' },
                { text: 'Назва', value: 'title' },
                { text: 'Предмет', value: 'item_number' },
                { text: 'Власник', value: 'owner_name' },
                { text: 'Ціна', value: 'price' },
            ],
        }
    }
}
</script>

<style>
.v-data-table > .v-data-table__wrapper tbody tr.v-data-table__expanded__content {
    box-shadow: none !important;
}
</style>
