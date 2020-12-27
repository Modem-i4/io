<template>
    <v-card>
        <v-toolbar
            flat
        >
            <v-toolbar-title>Інформація про накладну</v-toolbar-title>
            <v-progress-linear
                :active="loading"
                :indeterminate="loading"
                absolute
                bottom
                color="primary accent-4"
            ></v-progress-linear>
        </v-toolbar>
        <v-tabs vertical>
            <v-tab>
                Загальна
            </v-tab>
            <v-tab>
                Обладнання
            </v-tab>
            <v-tab>
                Ліцензії
            </v-tab>

            <v-tab-item><!-- Загальна інформація -->
                <v-card flat>
                    <v-card-text>
                        id: {{ invoice.id }}<br>
                        Номер накладної: {{ invoice.number }}<br>
                        Дата накладної: {{ invoice.date }}<br>
                        Файл: {{ invoice.file_url }}<br>
                        Загальна сума: {{ invoice.total_sum }}<br>
                        Створено запис в системі: {{ invoice.created_at }}<br>
                        Остання зміна: {{ invoice.updated_at }}<br>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item><!-- Обладнання -->
                <template>
                    <v-data-table
                        :headers="itemsHeaders"
                        :items="items"
                        :items-per-page="5"
                        class="elevation-1"
                    ></v-data-table>
                </template>
            </v-tab-item>
            <v-tab-item><!-- Ліцензії -->
                <template>
                    <v-data-table
                        :headers="licensesHeaders"
                        :items="licenses"
                        :items-per-page="5"
                        class="elevation-1"
                    ></v-data-table>
                </template>
            </v-tab-item>
        </v-tabs>
    </v-card>
</template>

<script>
import RequestErrorHandler from "../../mixins/RequestErrorHandler";

export default {
    name: "InvoiceFullDataComponent",
    mixins: [RequestErrorHandler],
    data() {
        return {
            invoice: {},
            items: [],
            licenses: [],

            loading: true,

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
    },
    props: {
        invoiceId: {
            type: Number,
        },
    },
    methods: {
        fetch() {
            axios.get('/api/invoices/' + this.invoiceId)
                .then(response => {
                    this.invoice = response.data.invoice;
                    this.items = response.data.items;
                    this.licenses = response.data.licenses;
                }).catch(error => {
                    this.handleRequestError(error)
                }).finally(() => {
                    this.loading = false;
            });
        }
    },
    created() {
        this.fetch();
    },
}
</script>
