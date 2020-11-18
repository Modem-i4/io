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
                readonly
                v-bind="attrs"
                v-on="on"
            ></v-text-field>
        </template>
        <v-date-picker
            v-model="value"
            @input="pickerMenu = false"
        ></v-date-picker>
    </v-menu>
</template>

<script>
export default {
    name: "DatePickerDropdownComponent",
    props: {
        value: {},
        inputLabel: {
            default: null,
        },
        inputIcon: {
            default: null,
        },
    },
    data() {
        return {
            pickerMenu: false,
        }
    },
    methods: {
        handleInput (e) {
            this.$emit('input', this.content)
        }
    }
}
</script>
