<template>
                <v-card>
                    <v-card-title>
                        Приміщення
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Пошук"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
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
                        <template v-slot:item.title="props">
                            <v-edit-dialog
                                :return-value.sync="props.item.title"
                                @save="save"
                                @cancel="cancel"
                                @open="open"
                                @close="close"
                            >
                                {{ props.item.title }}
                                <template v-slot:input>
                                    <v-text-field
                                        v-model="props.item.title"
                                        :rules="[max25chars]"
                                        label="Edit"
                                        single-line
                                        counter
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </template>

                    </v-data-table>
                    <v-snackbar
                        v-model="snack"
                        :timeout="3000"
                        :color="snackColor"
                    >
                        {{ snackText }}

                        <template v-slot:action="{ attrs }">
                            <v-btn
                                v-bind="attrs"
                                text
                                @click="snack = false"
                            >
                                Close
                            </v-btn>
                        </template>
                    </v-snackbar>
                </v-card>

</template>

<script>
export default {
    data () {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            max25chars: v => v.length <= 25 || 'Input too long!',

            search: null,
            pagination: {},
            items: [],
            options: {
                itemsPerPage: 10,
            },
            loading: true,
            headers: [
                { text: 'id', align: 'start',  value: 'id',
                   // sortable: false,
                },
                { text: "Назва", value: 'title' },
                { text: 'Корпус', value: 'parent_title' },
            ],
        }
    },
    watch: {
        options: {
            handler() {
                this.fetch()
            },
            deep: true,
        },
        search: _.debounce(function(){
            this.search = (this.search === '' ? null : this.search)
            this.fetch()

        }, 400)
    },
    methods: {
        fetch() {
            this.loading = true;

            axios.get('/api/departments', {
                params: {
                    page: this.options.page,
                    perPage: this.options.itemsPerPage,
                    search: this.search,
                    sortBy: this.options.sortBy[0],
                    sortDirection: this.options.sortDesc[0] ? 'desc' : 'asc',
                }
            }).then(response => {
                    this.items = response.data.data;
                    this.pagination.total = response.data.total;

                    this.loading = false;
                })
        },
        save () {
            this.snack = true
            this.snackColor = 'success'
            this.snackText = 'Data saved'
        },
        cancel () {
            this.snack = true
            this.snackColor = 'error'
            this.snackText = 'Canceled'
        },
        open () {
            this.snack = true
            this.snackColor = 'info'
            this.snackText = 'Dialog opened'
        },
        close () {
            console.log('Dialog closed')
        },
    },
}
</script>
