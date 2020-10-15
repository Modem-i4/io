import {EventBus} from "../EventBus";

export default  {
    methods: {
        snackError(msg) {
            this.snackShow(msg, 'error')
        },
        snackSuccess(msg) {
            this.snackShow(msg, 'success')
        },
        snackShow(message, color) {
            EventBus.$emit('snackbar-show', {
                message: message,
                color: color,
            })
        }
    },
}
