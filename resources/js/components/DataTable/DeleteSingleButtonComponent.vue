<template>
    <div>
        <template v-if="this.isSelectable">
            <v-icon
                small
                @click="$emit('delete')"
            >
                mdi-delete
            </v-icon>
        </template>
        <template v-else>
            <v-tooltip left>
                <template v-slot:activator="{ on, attrs }">
                    <v-icon
                        color="grey lighten-1"
                        v-bind="attrs"
                        v-on="on"
                        small
                    >
                        mdi-delete
                    </v-icon>
                </template>
                <span>{{ this.tooltipText }}</span>
            </v-tooltip>
        </template>
    </div>
</template>

<script>
export default {
    name: "DeleteSingleButtonComponent",
    props: {
        isSelectable: {
            type: Boolean,
            default: true,
        },
        tooltipText: {
            type: String,
            default: 'Неможливо видалити',
        },
    },
}
</script>


