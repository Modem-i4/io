<template>
    <v-menu
        v-model="pickerMenu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-text-field
                v-model="value"
                :label="inputLabel"
                :prepend-icon="inputIcon"
                :disabled="disabled"
                readonly
                v-bind="attrs"
                v-on="on"
            ></v-text-field>
        </template>
        <v-date-picker
            v-model="value"
            @input="pickerMenu = false"
            @change="handleInput()"
        ></v-date-picker>
    </v-menu>
</template>

<script>
export default {
    name: "DatePickerDropdownComponent",
    props: {
        inputLabel: {
            default: null,
        },
        inputIcon: {
            default: null,
        },
        autofill: {
            default: false,
        },
        fill: {
            default: '',
        },
        disabled: {
            default: false,
        }
    },
    data() {
        return {
            pickerMenu: false,
            value: this.autofill ? new Date().toISOString().substr(0, 10) : (this.fill) ? this.fill : '',
        }
    },
    methods: {
        handleInput (e) {
            this.$emit('input', this.value)
        }
    },
    mounted() {
        if(this.autofill) this.handleInput();
    }
}
</script>
