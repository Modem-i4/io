<template>
    <div>
        <v-row>
            <v-col
                cols="12"
                sm="3"
            >
                <datepicker-dropdown
                    v-model="invoice.data.date"
                    input-label="Дата накладної"
                    input-icon="mdi-calendar"
                >

                </datepicker-dropdown>

            </v-col>
            <v-col
                cols="12"
                sm="3"
            >
                <v-text-field
                    v-model="invoice.data.number"
                    :counter="16"
                    :error-messages="errors"
                    label="Номер"
                    required
                ></v-text-field>
            </v-col>
            <v-col
                cols="12"
                sm="3"
            >
                <v-autocomplete
                    v-model="invoice.data.provider_id"
                    :items="providers"
                    :error-messages="errors"
                    label="Постачальник"
                    item-text="title"
                    item-value="id"
                ></v-autocomplete>
            </v-col>
            <v-col
                cols="12"
                sm="3"
            >
                <v-btn
                    class="ma-2"
                    color="green"
                    @click="createInvoice()"
                    large
                    outlined
                >
                    Створити накладну
                    <v-icon>mdi-file-plus</v-icon>
                </v-btn>
            </v-col>
        </v-row>


        <v-simple-table>
            <template v-slot:default>
                <thead>
                <tr>
                    <th>id</th>
                    <th>Тип</th>
                    <th>Номер</th>
                    <th>
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on, attrs }">
                                <span
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    М.В.Особа
                                </span>
                            </template>
                            <span>Матеріально відповідальна особа</span>
                        </v-tooltip>
                    </th>
                    <th>Місце</th>
                    <th>Модель</th>
                    <th>Ціна</th>
                    <th>Кількість</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="(item, index) in invoice.items"
                    :key="item.type_id"
                >
                    <td>{{ index }}</td>
                    <td>
                        <v-autocomplete
                            v-model="item.type_id"
                            :items="types"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-text-field
                            v-model="item.inventory_number"
                            :counter="16"
                            :error-messages="errors"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="item.owner_id"
                            :items="users"
                            :error-messages="errors"
                            item-text="name"
                            item-value="id"
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="item.department_id"
                            :items="departments"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="item.model_id"
                            :items="models"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-text-field
                            v-model="item.price"
                            :error-messages="errors"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-text-field
                            :error-messages="errors"
                            min="1"
                            v-model="item.count"
                            type="number"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-icon
                            @click="deleteItemByIndex(index)"
                            small
                        >
                            mdi-delete
                        </v-icon>
                    </td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>
        <v-btn
            class="ma-2"
            color="indigo"
            @click="addItem()"
            outlined
        >
            Додати обладнання
            <v-icon>mdi-plus</v-icon>
        </v-btn>

        <v-simple-table>
            <template v-slot:default>
                <thead>
                <tr>
                    <th>id</th>
                    <th>Тип</th>
                    <th>Назва</th>
                    <th>
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on, attrs }">
                                <span
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    М.В.Особа
                                </span>
                            </template>
                            <span>Матеріально відповідальна особа</span>
                        </v-tooltip>
                    </th>

                    <th>Дійсна до</th>
                    <th>Ціна</th>
                    <th>Кількість</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="(license, index) in invoice.licenses"
                    :key="license.type_id"
                >
                    <td>{{ index }}</td>
                    <td>
                        <v-autocomplete
                            v-model="license.type_id"
                            :items="types"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-text-field
                            v-model="license.title"
                            :counter="35"
                            :error-messages="errors"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="license.owner_id"
                            :items="users"
                            :error-messages="errors"
                            item-text="name"
                            item-value="id"
                        ></v-autocomplete>
                    </td>
                    <td>
                        <datepicker-dropdown
                            v-model="license.end_date"
                        >
                        </datepicker-dropdown>
                    </td>
                    <td>
                        <v-text-field
                            v-model="license.price"
                            :error-messages="errors"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-text-field
                            :error-messages="errors"
                            min="1"
                            v-model="license.count"
                            type="number"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-icon
                            @click="deleteLicenseByIndex(index)"
                            small
                        >
                            mdi-delete
                        </v-icon>
                    </td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>
        <v-btn
            class="ma-2"
            color="indigo"
            @click="addLicense()"
            outlined
        >
            Додати ліцензію
            <v-icon>mdi-plus</v-icon>
        </v-btn>

    </div>
</template>

<script>
import DatePickerDropdownComponent from "../DatePickerDropdownComponent";
import FormValidate from "../mixins/FormValidate";
import RequestErrorHandler from "../mixins/RequestErrorHandler";
import SnackbarControl from "../mixins/SnackbarControl";

export default {
    name: "InvoiceCreateFormComponent",
    mixins: [FormValidate, RequestErrorHandler, SnackbarControl],
    components: {
        'datepicker-dropdown': DatePickerDropdownComponent,
    },
    data() {
        return{
            departments: [],
            models: [],
            providers: [],
            types: [],
            users: [],

            invoice: {    // TODO: ?????????
                data: {
                    date: new Date().toISOString().substr(0, 10),
                    number: null,
                    provider_id: null,
                    file_url: "sometextlikeurl",
                    total_sum: 13531,
                },
                items: [],
                licenses: [],
            },
        }
    },
    computed: {
        positionsCount: function() {
            return this.invoice.items.length + this.invoice.licenses.length;
        },
    },
    methods: {
        addItem() {
            this.invoice.items.push({
                count: 1,
            });
        },
        addLicense() {
            this.invoice.licenses.push({
                count: 1,
            });
        },
        deleteItemByIndex(itemIndex) {
            this.invoice.items.splice(itemIndex, 1);
        },
        deleteLicenseByIndex(licenseIndex) {
            this.invoice.licenses.splice(licenseIndex, 1);
        },

        createInvoice() {
          axios.post('/api/invoices', this.invoice)
            .then(response => {
                this.snackSuccess('Створено');
            }).catch(error => this.handleRequestError(error));
        },

        getAvailableDepartments() {    // TODO: Refactor
            axios.get('/api/departments/all').then(response => {
                this.departments = response.data;
            }).catch(error => this.handleRequestError(error));
        },
        getAvailableModels() {
            axios.get('/api/models/all').then(response => {
                this.models = response.data;
            }).catch(error => this.handleRequestError(error));
        },
        getAvailableProviders() {
            axios.get('/api/providers/all').then(response => {
                this.providers = response.data;
            }).catch(error => this.handleRequestError(error));
        },
        getAvailableTypes() {
            axios.get('/api/types/all').then(response => {
                this.types = response.data;
            }).catch(error => this.handleRequestError(error));
        },
        getAvailableUsers() {
            axios.get('/api/users/all').then(response => {
                this.users = response.data;
            }).catch(error => this.handleRequestError(error));
        },
    },
    mounted() {
        this.getAvailableDepartments();
        this.getAvailableModels();
        this.getAvailableProviders();
        this.getAvailableTypes();
        this.getAvailableUsers();

        this.addItem();
    }
}
</script>
