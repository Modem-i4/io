<template>
    <v-snackbar
        v-model="snack.visible"
        :timeout="3000"
        :color="snack.color"
    >
        {{ snack.text }}

        <template v-slot:action="{ attrs }">
            <v-btn
                v-bind="attrs"
                text
                @click="this.snack.visible = false"

            >
                Закрити
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>

import {EventBus} from "./EventBus";

export default {
    name: "AppSnackbar",
    data() {
        return {
            snack:{
                visible: false,
                color: '',
                text: '',
            },
        }
    },
    methods: {
        show(message, color) {
            this.snack.visible = true
            this.snack.color = color
            this.snack.text = message
        }
    },
    created() {
        EventBus.$on('snackbar-show', data => {
            this.show(data.message, data.color);
        });
    }
}
</script>
