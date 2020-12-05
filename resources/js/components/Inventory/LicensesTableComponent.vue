<template>
    <div class="">
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
import DataTableCore from "../mixins/DataTableCore";

export default {
    mixins: [DataTableCore],
    data () {
        return {
            defaultSortByField: 'base.id',
            crudApiEndpoint: '/api/licenses',
            headers: [
                { text: 'id', align: 'start',  value: 'id', fieldNameForSort: 'base.id'
                   // sortable: false,
                },
                { text: 'Назва', value: 'title', fieldNameForSort: 'base.title' },
                { text: 'Предмет', value: 'item_number' },
                //TODO: { text: 'Тип', value: 'type_title' },
                { text: 'Накладна', value: 'invoice_number' },
                { text: 'Власник', value: 'owner_name' },
                { text: 'Ціна', value: 'price', fieldNameForSort: 'base.price' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    }
}
</script>
