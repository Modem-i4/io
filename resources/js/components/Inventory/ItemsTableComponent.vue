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
                    :footer-props="footerOptions"
                    :headers="headers"
                    :items="items"
                    :options.sync="options"
                    :server-items-length="pagination.total"
                    :loading="loading"
                    class="elevation-1"
                >
                    <template v-slot:item.actions="{ item }">
                        <div class="d-flex">
                            <repair-item-menu
                                @repair="repairItem"
                                :newRepair="item"
                                :providers="providers"
                            ></repair-item-menu>

                            <dt-delete-single
                                @delete="deleteSingleItem(item.id)"
                                :isSelectable="item.isSelectable"
                            ></dt-delete-single>
                        </div>
                    </template>

                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

<script>
import DataTableCore from "../mixins/DataTableCore";
import RepairItemFormComponent from "./RepairItemFormComponent";
import {EventBus} from "../EventBus";

export default {
    mixins: [DataTableCore],
    components: {
        'repair-item-menu': RepairItemFormComponent,
    },
    data () {
        return {
            crudApiEndpoint: '/api/items',
            providers: [],
            headers: [
                { text: 'id', align: 'start',  value: 'id'
                    // sortable: false,
                },
                { text: 'Номер', value: 'inventory_number' },
                { text: 'Тип', value: 'type_title' },
                { text: 'Модель', value: 'model_title' },
                { text: 'Накладна', value: 'invoice_number' },
                { text: 'Власник', value: 'owner_name' },
                { text: 'Статус', value: 'status_title' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
        repairItem(item) {
            let newItem = {
                item_id: item.id,
                start_date: item.start_date,
                user_id: item.owner_id,
                provider_id: item.provider_id,
            };
            axios.post('/api/repairs', newItem)
                .then(response => {
                    this.snackSuccess('Додано в ремонт');
                }).catch(error => this.handleRequestError(error));
        },
        getAllProviders() {
            axios.get('/api/providers/all').then(response => {
                this.providers = response.data;
            }).catch(error => this.handleRequestError(error));
        },
    },
    mounted() {
        this.getAllProviders()
    }
}
</script>
