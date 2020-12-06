<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <v-card>
                <v-card-title>
                    Технічне обладнання
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
                        itemsPerPageOptions: [10, 25, 50, 100]
                    }"
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
            defaultSortByField: 'base.id',
            crudApiEndpoint: '/api/items',
            headers: [
                { text: 'id', align: 'start',  value: 'id', fieldNameForSort: 'base.id'
                    // sortable: false,
                },
                { text: 'Номер', value: 'inventory_number', fieldNameForSort: 'base.inventory_number' },
                { text: 'Тип', value: 'type_title' },
                { text: 'Модель', value: 'model_title' },
                { text: 'Накладна', value: 'invoice_number' },
                { text: 'Власник', value: 'owner_name' },
                //TODO: { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    }
}
</script>
