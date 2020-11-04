<template>
    <div>
        <v-row>
            <v-col
                cols="12"
                sm="4"
            >

                <v-menu
                    v-model="invoiceDatePickerMenu"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="invoice.date"
                            label="Дата накладної"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="invoice.date"
                        @input="menu2 = false"
                    ></v-date-picker>
                </v-menu>

            </v-col>
            <v-col
                cols="12"
                sm="4"
            >
                <v-text-field
                    v-model="invoice.number"
                    :counter="16"
                    :error-messages="errors"
                    label="Номер"
                    required
                ></v-text-field>
            </v-col>
            <v-col
                cols="12"
                sm="4"
            >
                <v-autocomplete
                    v-model="invoice.provider"
                    :items="providers"
                    :error-messages="errors"
                    label="Постачальник"
                    item-text="title"
                    item-value="id"
                    return-object
                ></v-autocomplete>
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
                    :key="item.type"
                >
                    <td>{{ index }}</td>
                    <td>
                        <v-autocomplete
                            v-model="item.type"
                            :items="types"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                            return-object
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-text-field
                            v-model="item.number"
                            :counter="16"
                            :error-messages="errors"
                            required
                        ></v-text-field>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="item.user"
                            :items="users"
                            :error-messages="errors"
                            item-text="name"
                            item-value="id"
                            return-object
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="item.department"
                            :items="departments"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                            return-object
                        ></v-autocomplete>
                    </td>
                    <td>
                        <v-autocomplete
                            v-model="item.model"
                            :items="models"
                            :error-messages="errors"
                            item-text="title"
                            item-value="id"
                            return-object
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

    </div>
</template>

<script>
import FormValidate from "../mixins/FormValidate";

export default {
    name: "InvoiceCreateFormComponent",
    mixins: [FormValidate],
    data() {
        return{
            departments: [],
            models: [],
            providers: [],
            types: [],
            users: [],

            invoice: {    // TODO: ?????????
                date: new Date().toISOString().substr(0, 10),
                number: null,

                items: [],
            },


            invoiceDatePickerMenu: false,
        }
    },
    methods: {
        addItem() {
            this.invoice.items.push({
                count: 1,
            });
        },
        deleteItemByIndex(itemIndex) {
            this.invoice.items.splice(itemIndex, 1);
            if(this.invoice.items.length === 0)
                this.addItem();
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
