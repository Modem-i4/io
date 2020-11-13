import SnackbarControl from "./SnackbarControl";

export default {
    mixins: [SnackbarControl],
    methods: {
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
