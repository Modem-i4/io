<template>
    <v-menu
        v-model="isActive"
        :close-on-content-click="false"
        :nudge-width="200"
        offset-y
    >
        <template v-slot:activator="{ on, attrs }">
            <v-icon
                small
                v-bind="attrs"
                v-on="on"
            >
                mdi-content-copy
            </v-icon>
        </template>

        <v-card>


            <v-list-item two-line>
                <v-list-item-content>
                    <v-text-field
                        min="1"
                        v-model="count"
                        type="number"
                        label="Кількість копій"
                        required
                    ></v-text-field>
                </v-list-item-content>
            </v-list-item>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                    text
                    @click="cancel()"
                >
                    Відмінити
                </v-btn>
                <v-btn
                    color="primary"
                    text
                    @click="duplicate()"
                >
                    Створити
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-menu>
</template>

<script>
export default {
    name: "DuplicateButtonComponent",
    data() {
        return {
            count: 1,
            isActive: false,
        }
    },
    methods: {
        cancel() {
            this.isActive = false
            this.$emit('cancel')
        },
        duplicate() {
            this.isActive = false
            this.$emit('make-copy', this.count)
        },
    }
}
</script>


