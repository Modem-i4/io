<template>
    <div class="">
        <validation-observer
            ref="itemCreateObserver"
            v-slot=""
        >
            <v-row>
                <v-col
                    cols="12"
                    md="3"
                >
                    <validation-provider
                        v-slot="{ errors }"
                        name="Ім'я"
                        rules="required|min:5|max:100"
                    >
                        <v-text-field
                            v-model="newItem.name"
                            :counter="100"
                            :error-messages="errors"
                            label="Ім'я"
                            required
                        ></v-text-field>
                    </validation-provider>
                </v-col>
                <v-col
                    cols="12"
                    md="3"
                >
                    <validation-provider
                        v-slot="{ errors }"
                        name="Ел.пошта"
                        rules="required|email"
                    >
                        <v-text-field
                            v-model="newItem.email"
                            :error-messages="errors"
                            label="Ел.пошта"
                            required
                        ></v-text-field>
                    </validation-provider>
                </v-col>
                <v-col
                    cols="12"
                    md="3"
                >
                    <validation-provider
                        v-slot="{ errors }"
                        name="Роль"
                        rules="required"
                    >
                        <v-select
                            :items="roles"
                            v-model="newItem.role"
                            :error-messages="errors"
                            label="Роль"
                            required
                        ></v-select>
                    </validation-provider>
                </v-col>
                <v-col
                    class="d-flex align-items-center"
                    cols="12"
                    md="3"
                >
                    <v-btn
                        class="mr-4"
                        @click="create"
                    >
                        <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати користувача</span>
                    </v-btn>
                </v-col>
            </v-row>
        </validation-observer>

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
                            itemsPerPageOptions: [10, 25, 50]
                        }"
                        :headers="headers"
                        :items="items"
                        :options.sync="options"
                        :server-items-length="pagination.total"
                        :loading="loading"
                        class="elevation-1"
                    >
                        <template v-slot:item.name="props">

                            <validation-observer
                                :ref="getValidatorRef('name', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.name"
                                    :validator="$refs[getValidatorRef('name', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.name }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Ім'я"
                                            rules="required|min:5|max:100"
                                        >
                                            <v-text-field
                                                v-model="props.item.name"
                                                :counter="100"
                                                :error-messages="errors"
                                                label="Ім'я"
                                                single-line
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.email="props">
                            <validation-observer
                                :ref="getValidatorRef('email', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.email"
                                    :validator="$refs[getValidatorRef('email', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.email }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="E-mail"
                                            rules="required|email"
                                        >
                                            <v-text-field
                                                v-model="props.item.email"
                                                :counter="100"
                                                :error-messages="errors"
                                                label="E-mail"
                                                single-line
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.role="props">
                            <validation-observer
                                :ref="getValidatorRef('role', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.role"
                                    :validator="$refs[getValidatorRef('role', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.role }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Роль"
                                            rules="required"
                                        >
                                            <v-select
                                                :items="roles"
                                                v-model="props.item.role"
                                                :error-messages="errors"
                                                label="Роль"
                                                required
                                            ></v-select>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.actions="{ item }">
                            <dt-delete-single
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
import { DataTableCore } from "./mixins/DataTableCore";

export default {
    mixins: [DataTableCore],
    data () {
        return {
            //role : 'user', TODO: Add default value to select
            roles: ['admin', 'user', 'manager'],
            crudApiEndpoint: '/api/users',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                    // sortable: false,
                },
                { text: "Ім'я", value: 'name' },
                { text: 'Email', value: 'email' },
                { text: 'Роль', value: 'role' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
        prepareItemForUpdate(item) {
            return {
                id: item.id,
                name: item.name,
                email: item.email,
                role: item.role,
            };
        },
        prepareItemForCreate(data) {
            return {
                name: data.name,
                email: data.email,
                role: data.role,
            };
        }
    },
}
</script>
