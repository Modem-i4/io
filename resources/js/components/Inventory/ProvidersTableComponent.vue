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
                            name="Назва"
                            rules="required|min:3|max:40"
                        >
                            <v-text-field
                                v-model="newItem.title"
                                :counter="40"
                                :error-messages="errors"
                                label="Назва"
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
                            name="Адреса"
                            rules="required|min:5|max:50"
                        >
                            <v-text-field
                                v-model="newItem.address"
                                :counter="50"
                                :error-messages="errors"
                                label="Адреса"
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
                            name="Номер телефону"
                            rules="required|min:5|max:20"
                        >
                            <v-text-field
                                v-model="newItem.phone"
                                :counter="20"
                                :error-messages="errors"
                                label="Номер телефону"
                                required
                            ></v-text-field>
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
                            <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати постачальника</span>
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
                        :footer-props="footerOptions"
                        :headers="headers"
                        :items="items"
                        :options.sync="options"
                        :server-items-length="pagination.total"
                        :loading="loading"
                        class="elevation-1"
                    >
                        <template v-slot:item.title="props">

                            <validation-observer
                                :ref="getValidatorRef('title', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.title"
                                    :validator="$refs[getValidatorRef('title', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.title }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Назва"
                                            rules="required|max:40"
                                        >
                                            <v-text-field
                                                v-model="props.item.title"
                                                :counter="40"
                                                :error-messages="errors"
                                                label="Назва"
                                                single-line
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.address="props">

                            <validation-observer
                                :ref="getValidatorRef('address', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.address"
                                    :validator="$refs[getValidatorRef('address', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.address }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Адреса"
                                            rules="required|min:5|max:50"
                                        >
                                            <v-text-field
                                                v-model="props.item.address"
                                                :counter="50"
                                                :error-messages="errors"
                                                label="Назва"
                                                single-line
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </template>
                                </dt-edit-dialog>
                            </validation-observer>
                        </template>

                        <template v-slot:item.phone="props">

                            <validation-observer
                                :ref="getValidatorRef('phone', props.item.id)"
                                v-slot=""
                            >
                                <dt-edit-dialog
                                    :return-value.sync="props.item.phone"
                                    :validator="$refs[getValidatorRef('phone', props.item.id)]"
                                    @save="update(props.item)"
                                    @changeless-save="changeless"
                                    @cancel="cancel"
                                >
                                    {{ props.item.phone }}
                                    <template v-slot:input>
                                        <validation-provider
                                            v-slot="{ errors }"
                                            name="Назва"
                                            rules="required|max:20"
                                        >
                                            <v-text-field
                                                v-model="props.item.phone"
                                                :counter="20"
                                                :error-messages="errors"
                                                label="Назва"
                                                single-line
                                                required
                                            ></v-text-field>
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
import DataTableCore from "../mixins/DataTableCore";

export default {
    mixins: [DataTableCore],
    data () {
        return {
            crudApiEndpoint: '/api/providers',
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: 'Назва', value: 'title' },
                { text: 'Адреса', value: 'address' },
                { text: 'Телефон', value: 'phone' },
                { text: 'Дії', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
        prepareItemForUpdate(item) {
            return {
                id: item.id,
                title: item.title,
                address: item.address,
                phone: item.phone,
            };
        },
        prepareItemForCreate(data) {
            return {
                title: data.title,
                address: data.address,
                phone: data.phone,
            };
        }
    },
}
</script>
