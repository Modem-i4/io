import { required, max, min } from 'vee-validate/dist/rules'
import { extend, setInteractionMode } from 'vee-validate'

import { ValidationObserver, ValidationProvider } from 'vee-validate'

setInteractionMode('eager')

extend('required', {
    ...required,
    message: 'Поле "{_field_}" не може бути порожнє',
    computesRequired: true,

    validate(value) {
        return {
            required: true,
            valid: ['', null, undefined].indexOf(value) === -1,
        }
    }
})

extend('max', {
    ...max,
    message: 'Поле "{_field_}" має містити не більше {length} символів',
})

extend('min', {
    ...min,
    message: 'Поле "{_field_}" має містити не менше {length} символів',
})

export default {
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    data () {
        return {
            errors: null,
        }
    },
}

