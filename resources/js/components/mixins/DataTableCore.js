export const DataTableCore = {
    data () {
        return {
            snack:{
                visible: false,
                color: '',
                text: '',
            },
            pagination: {},
            search: '',
            items: [],

            loading: true,
            options: {
                itemsPerPage: 10,
            },

            crudApiEndpoint: '',
            headers: [],
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
            this.fetch()

        }, 400)
    },
    methods: {
        // Завантаження даних з сервера
        fetch() {
            this.loading = true;

            axios.get(this.crudApiEndpoint, {
                params: {
                    search: (this.search === '' ? null : this.search),

                    page: this.options.page,
                    perPage: this.options.itemsPerPage,
                    sortBy: this.options.sortBy[0],

                    // TODO: Improve
                    sortDirection: this.options.sortBy[0] == null ? null : this.options.sortDesc[0] ? 'desc' : 'asc',
                }
            }).then(response => {
                this.items = response.data.data;
                this.pagination.total = response.data.total;

                this.loading = false;
            })
                .catch(error => {
                    if (error.response) {
                        // Сервер повернув помилку
                        this.snackError('Помилка завантаення ' + error.response.status)
                    } else if (error.request) {
                        // Сервер не повернув нічого
                        this.snackError('Не вдалось підключитися до сервера')
                    } else {
                        // Сталася помилка при створенні запиту
                        this.snackError('Сталася помилка при створенні запиту')
                    }

                    this.loading = false;
                });
        },

        // Редагування полей
        save (updatedItem) {
            axios.patch(this.crudApiEndpoint + updatedItem.id, updatedItem).then(response => {
                this.snackSuccess('Збережено')
            })
                .catch(error => {
                    if (error.response) {
                        // Сервер повернув помилку
                        this.snackError('Помилка ' + error.response.status)
                    } else if (error.request) {
                        // Сервер не повернув нічого
                        this.snackError('Не вдалось підключитися до сервера')
                    } else {
                        // Сталася помилка при створенні запиту
                        this.snackError('Сталася помилка при створенні запиту')
                    }
                });
        },
        cancel () {
            this.snackError('Відмінено')
        },

        // Створення снеків
        snackError(message) {
            this.snack.visible = true
            this.snack.color = 'error'
            this.snack.text = message
        },
        snackSuccess(message) {
            this.snack.visible = true
            this.snack.color = 'success'
            this.snack.text = message
        },
    },
}
