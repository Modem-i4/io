import DeleteSelectedButtonComponent from "../DataTable/DeleteSelectedButtonComponent";

export const DataTableCore = {
    components: {
        'delete-selected-button': DeleteSelectedButtonComponent,
    },
    data () {
        return {
            //singleSelect: false,
            selected: [],
            snack:{
                visible: false,
                color: '',
                text: '',
            },
            pagination: {},
            search: '',
            items: [],
            newItem: {},

            loading: true,
            options: {
                itemsPerPage: 10,
            },

            crudApiEndpoint: '',
            headers: [],
        }
    },
    computed: {
        sortBy: function() {    // TODO: Rename to sortField?
            if(this.options.sortBy.length === 0) {
                return null;
            }
            return (this.headers.filter(obj => {
                return obj.value === this.options.sortBy[0]
            })[0]).fieldNameForSort ?? this.options.sortBy[0];
        },
        sortDirection: function () {
            return this.sortBy == null ? null : this.options.sortDesc[0] ? 'desc' : 'asc';
        },
    },
    watch: {
        options: {
            handler() {
                this.fetch()
            },
            deep: true,
        },
        search: _.debounce(function(){
            this.options.page = 1;
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

                    sortBy: this.sortBy,
                    sortDirection: this.sortDirection,
                }
            }).then(response => {
                this.items = response.data.data;
                this.pagination.total = response.data.total;

                this.loading = false;
            })
                .catch(error => {
                    if (error.response) {
                        // Сервер повернув помилку
                        this.snackError('Помилка завантаження ' + error.response.status)
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
        update (item) {
            if (typeof this.prepareItemForUpdate === 'function') {
                item = this.prepareItemForUpdate(item);
            }

            axios.patch(this.crudApiEndpoint + '/' + item.id, item)
                .then(response => {
                    this.snackSuccess('Збережено');
                    this.fetch();
                }).catch(error => {
                    if (error.response) {
                        // Сервер повернув помилку
                        let errorText;

                        switch (error.response.status) {
                            case 422:
                                errorText = 'Помилка валідації!';
                                console.log(error.response.data);
                                break;
                            default:
                                errorText = 'Помилка ' + error.response.status;
                                break;
                        }
                        this.snackError(errorText);
                    } else if (error.request) {
                        // Сервер не повернув нічого
                        this.snackError('Не вдалось підключитися до сервера')
                    } else {
                        // Сталася помилка при створенні запиту
                        this.snackError('Сталася помилка при створенні запиту')
                    }
                });
        },
        // Створення
        create () {
            var item = this.newItem;

            if (typeof this.prepareItemForCreate === 'function') {
                item = this.prepareItemForCreate(item);
            }

            axios.post(this.crudApiEndpoint, item)
                .then(response => {
                    this.snackSuccess('Створено');
                    this.fetch();
                }).catch(error => {    //TODO: Винести перевірку помилок
                if (error.response) {
                    // Сервер повернув помилку
                    let errorText;

                    switch (error.response.status) {
                        case 422:
                            errorText = 'Помилка валідації!';
                            console.log(error.response.data);
                            break;
                        default:
                            errorText = 'Помилка ' + error.response.status;
                            break;
                    }
                    this.snackError(errorText);
                } else if (error.request) {
                    // Сервер не повернув нічого
                    this.snackError('Не вдалось підключитися до сервера')
                } else {
                    // Сталася помилка при створенні запиту
                    this.snackError('Сталася помилка при створенні запиту')
                }
            });
        },
        cancel() {
            this.snackError('Відмінено')
        },

        deleteSelectedItems() {
            //console.log(this.selected.map(obj => obj.id));
            if(this.selected.length === 0) {
                return this.snackError('Виберіть елементи для видалення');
            }

            axios.delete(this.crudApiEndpoint, {
                params: {
                    idList: this.selected.map(item => item.id),
                },
            })
            .then(response => {
                this.fetch();
                this.snackSuccess('Видалено елементів - ' + this.selected.length);

                this.selected = [];
            })
            .catch(error => {
                if (error.response) {
                    // Сервер повернув помилку
                    this.snackError('Помилка ' + error.response.status);
                } else if (error.request) {
                    // Сервер не повернув нічого
                    this.snackError('Не вдалось підключитися до сервера')
                } else {
                    // Сталася помилка при створенні запиту
                    this.snackError('Сталася помилка при створенні запиту')
                }
            });
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
