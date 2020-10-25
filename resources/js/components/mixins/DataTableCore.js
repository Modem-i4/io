import DeleteSelectedButtonComponent from "../DataTable/DeleteSelectedButtonComponent";
import DeleteSingleButtonComponent from "../DataTable/DeleteSingleButtonComponent";
import EditDialogComponent from "../DataTable/EditDialogComponent";
import FormValidate from "./FormValidate";
import SnackbarControl from "./SnackbarControl";
import { EventBus } from "../EventBus";

export const DataTableCore = {
    mixins: [FormValidate, SnackbarControl],
    components: {
        'dt-delete-selected': DeleteSelectedButtonComponent,
        'dt-delete-single': DeleteSingleButtonComponent,
        'dt-edit-dialog': EditDialogComponent,
    },
    data () {
        return {
            //singleSelect: false,
            isSelectableByDefault: true,
            selected: [],

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
        sortDirection: function() {
            return this.sortBy == null ? null : this.options.sortDesc[0] ? 'desc' : 'asc';
        },
        isSelectedAny: function() {
          return (this.selected.length !== 0);
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
        // Обробка подій від dt-edit-dialog

        // @cancel
        cancel() {
            this.snackError('Відмінено')
        },
        //@changeless-save
        changeless() {
            this.snackShow('Дані не оновлено', 'warning')
        },

        // Взаємодія з даними

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

                if(this.isSelectableByDefault)
                    this.items.forEach(item => {item.isSelectable = true;})

                EventBus.$emit('dt-fetched');
            }).catch(error => this.handleRequestError(error));
        },

        // Створення нових об'єктів
        create () {
            this.$refs.itemCreateObserver.validate().then(result => {
                if (result) {
                    let item = this.newItem;

                    if (typeof this.prepareItemForCreate === 'function') {
                        item = this.prepareItemForCreate(item);
                    }

                    axios.post(this.crudApiEndpoint, item)
                        .then(response => {
                            this.snackSuccess('Створено');
                            this.fetch();

                            this.newItem = {};    //Очищуємо поля в формі додавання
                            this.$refs.itemCreateObserver.reset();

                            EventBus.$emit('dt-item-created');
                        }).catch(error => this.handleRequestError(error));
                }
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

                    EventBus.$emit('dt-item-updated');
                }).catch(error => {
                    this.handleRequestError(error);
                }).finally(result => {
                    this.fetch();
                });
        },

        // Видалення вибраних
        deleteSelectedItems() {
            if(!this.isSelectedAny)
                return this.snackError('Виберіть елементи для видалення');

            this.massDelete(this.selected.map(item => item.id));
        },
        // Видалення одного об'єкту
        deleteSingleItem (id) {    //TODO: Add custom messages
            this.massDelete([id]);
        },
        // Видалення за массивом ідентифікаторів
        massDelete(itemsIdArray) {
            axios.delete(this.crudApiEndpoint + '/destroy', {
                params: {
                    idList: itemsIdArray,
                },
            })
                .then(response => {
                    this.fetch();
                    this.snackSuccess('Успішно видалено');

                    EventBus.$emit('dt-item-deleted');

                    this.selected = [];

                })
                .catch(error => this.handleRequestError(error));
        },


        //Генерує назву для посилання на валідатор
        getValidatorRef(itemFieldName, itemId) {    //TODO: Review
            return 'itemsValidator.' + itemFieldName + '.' + itemId;
        },

        //Функція обробки помилок для запитів на сервер через axios
        handleRequestError(error) {
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
        },
    },
}
