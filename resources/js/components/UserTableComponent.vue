<template>
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <v-card>
                    <v-card-title>
                        Користувачі
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
                    ></v-data-table>
                </v-card>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data () {
        return {
            search: null,
            pagination: {},
            items: [],
            options: {
                itemsPerPage: 25,
            },
            loading: true,
            headers: [
                {
                    text: '#id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                { text: "Ім'я", value: 'name' },
                { text: 'Email', value: 'email' },
                { text: 'Роль', value: 'role' },
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

            axios.get('/api/users', {
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
    },
}
</script>
