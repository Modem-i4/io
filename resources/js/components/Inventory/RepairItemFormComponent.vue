<template>
    <v-menu
        content-class="v-small-dialog__menu-content"
        :close-on-content-click="false"
        v-model="isRepairOpen"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-icon
                small
                @click="show"
            >
                mdi-hammer-wrench
            </v-icon>
        </template>
        <pre class="mt-3 ml-12 mb-0 text-muted">Додавання в ремонт</pre>
        <div class="d-flex mx-4">
            <v-autocomplete
                v-model="newRepair.provider_id"
                :items="providers"
                item-text="title"
                item-value="id"
                prepend-icon="mdi-account"
                label="Виконавець"
                required
            ></v-autocomplete>

            <datepicker-dropdown
                v-model="newRepair.start_date"
                input-label="Дата початку"
                input-icon="mdi-calendar"
                required
            ></datepicker-dropdown>
        </div>
        <v-btn
            text
            light
            width="49%"
            @click="cancel"
        >
            {{ this.cancelText }}
        </v-btn>
        <v-btn
            color="primary"
            text
            light
            width="49%"
            class="float-right"
            @click="save"
        >
            {{ this.saveText }}
        </v-btn>
    </v-menu>
</template>

<script>
import DatePickerDropdownComponent from "../DatePickerDropdownComponent";

export default {
    name: "RepairItemFormComponent",
    components: {
        'datepicker-dropdown': DatePickerDropdownComponent,
    },
    data () {
        return {
            isRepairOpen: false
        }
    },
    props: {
        cancelText: {
            default: 'Відмінити',
        },
        saveText: {
            default: 'Додати в ремонт',
        },
        newRepair: {
            default: {},
        },
        providers: {
            default: [],
        }
    },
    methods: {
        show () {
            this.isRepairOpen = true
        },
        cancel() {
            this.isRepairOpen = false
        },
        save() {
            this.$emit("repair", this.newRepair)
            this.isRepairOpen = false
        }
    }
}
</script>
