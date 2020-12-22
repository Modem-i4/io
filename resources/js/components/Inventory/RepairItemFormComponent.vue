<template>
    <v-menu
        content-class="v-small-dialog__menu-content"
        :close-on-content-click="false"
        v-model="isRepairOpen"
    >
        <template v-slot:activator="{ on, attrs }">
            <template v-if="isSelectable">
                <v-icon
                    small
                    @click="show"
                >
                    mdi-hammer-wrench
                </v-icon>
            </template>
            <template v-else>
                <v-icon
                    color="grey lighten-1"
                    small
                >
                    mdi-hammer-wrench
                </v-icon>
            </template>
        </template>
        <div class="container">
            <template v-if="isReparing">
                <span class="col-5 my-0 py-0 text-muted text-center">Завершення ремонту</span>
                <datepicker-dropdown
                    v-model="itemToRepair.end_date"
                    :autofill="true"
                    input-label="Дата завершення"
                    input-icon="mdi-calendar"
                    required
                ></datepicker-dropdown>
            </template>
            <template v-else>
                <div class="row justify-content-center">
                    <span class="col-5 my-0 py-0 text-muted text-center">Додавання в ремонт</span>
                    <v-checkbox
                        class="my-0 py-0 mb-0 unrepairable-checkbox"
                        v-bind:label="`Не підлягає ремонту`"
                        v-model="unrepairable"
                    ></v-checkbox>
                </div>
                <div class="d-flex mx-4">
                    <v-autocomplete
                        v-model="itemToRepair.provider_id"
                        :items="providers"
                        :disabled="unrepairable"
                        item-text="title"
                        item-value="id"
                        prepend-icon="mdi-account"
                        label="Виконавець"
                        required
                    ></v-autocomplete>

                    <datepicker-dropdown
                        v-model="itemToRepair.start_date"
                        input-label="Дата початку"
                        input-icon="mdi-calendar"
                        :disabled="unrepairable"
                        :autofill="true"
                        required
                    ></datepicker-dropdown>
                </div>
            </template>
            <template v-if="!isReparing">
                <template v-if="!unrepairable" >
                    <v-btn
                        text
                        light
                        width="49%"
                        @click="closeAndSave"
                    >
                        {{ this.closeText }}
                    </v-btn>
                    <v-btn
                        color="primary"
                        text
                        light
                        width="49%"
                        class="float-right"
                        @click="save"
                    >
                        {{ this.addRepairText }}
                    </v-btn>
                </template>
                <template v-else>
                    <v-btn
                        text
                        light
                        width="100%"
                        @click="closeAndSave"
                    >
                        {{ this.closeText }}
                    </v-btn>
                </template>
            </template>
            <template v-else> <!--isReparing-->
                <v-btn
                    text
                    light
                    width="49%"
                    @click="close"
                >
                    {{ this.closeText }}
                </v-btn>
                <v-btn
                    color="primary"
                    text
                    light
                    width="49%"
                    class="float-right"
                    @click="finishRepair"
                >
                    {{ this.finishRepairText }}
                </v-btn>
            </template>
        </div>

    </v-menu>
</template>

<script>


import DatePickerDropdownComponent from "../DatePickerDropdownComponent";
import SnackbarControl from "../mixins/SnackbarControl";

export default {

    name: "RepairItemFormComponent",
    components: {
        'datepicker-dropdown': DatePickerDropdownComponent,
    },
    mixins: [SnackbarControl],
    data () {
        return {
            isRepairOpen: false,
            unrepairable: false,
            isReparing: false,
            crudApiEndpoint: '/api/repairs',
        }
    },
    props: {
        addRepairText: {
            default: 'Додати в ремонт',
        },
        closeText:{
            default:'Закрити',
        },
        finishRepairText:{
            default: 'Завершити ремонт',
        },
        itemToRepair: {
            default: {},
        },
        providers: {
            default: [],
        },
    },
    computed: {
        isSelectable: function() {
            return (this.itemToRepair.status_id !== 6 && this.itemToRepair.status_id !== 7)
        }
    },
    methods: {
        saveStatus(){
            let newStatus; // 4 - не підлягає ремонту, 5 - пошкоджено, null - без змін
            if(this.unrepairable && this.itemToRepair.status_id !== 4) {
                newStatus = 4;
            }
            else if(!this.unrepairable && this.itemToRepair.status_id === 4) {
                newStatus = 5;
            }
            if(newStatus) {
                this.$emit('setStatus', this.itemToRepair.id, newStatus);
            }
        },
        show () {
            this.isRepairOpen = true;
            this.unrepairable = this.itemToRepair.status_id === 4;
            this.isReparing = this.itemToRepair.status_id === 3;
        },
        closeAndSave() {
            this.isRepairOpen = false;
            this.saveStatus();
        },
        close() {
            this.isRepairOpen = false;
        },
        save() {
            this.isRepairOpen = false
            let newRepair = {
                item_id: this.itemToRepair.id,
                start_date: this.itemToRepair.start_date,
                user_id: this.itemToRepair.owner_id,
                provider_id: this.itemToRepair.provider_id,
            };
            axios.post(this.crudApiEndpoint, newRepair)
                .then(response => {
                    this.snackSuccess('Додано в ремонт');
                    this.$emit('setStatus', this.itemToRepair.id, 3); //status_id = 3 означає, що в ремонті
                }).catch(error => this.handleRequestError(error));
        },
        finishRepair() {
            this.isRepairOpen = false
            axios.post(this.crudApiEndpoint + '/finish_repair/' + this.itemToRepair.id,
                {'end_date': this.itemToRepair.end_date} )
            .then(response => {
                this.snackSuccess('Ремонт завершено');
                this.$emit('setStatus', this.itemToRepair.id, 2); //status_id = 2 означає, що передається
            }).catch(error => {
                this.handleRequestError(error);
            });
        }
    }
}
</script>
<style>
    .unrepairable-checkbox label, .unrepairable-checkbox .v-input__slot {
        margin-bottom: 0;
    }
    .unrepairable-checkbox .v-input__control {
        height: 0; /*stretch to other col's height*/
    }
</style>
