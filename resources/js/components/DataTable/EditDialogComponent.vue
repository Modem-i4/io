<template>
    <v-menu
        content-class="v-small-dialog__menu-content"
        v-model="isActive"
        :close-on-content-click="false"
        :close-on-click="!persistent"
    >
        <template v-slot:activator="{ on, attrs }">
            <div class="v-small-dialog__activator" @click="show">
                <slot></slot>
            </div>
        </template>

        <div
            class="v-small-dialog__content"
            @keydown.enter="save"
            @keydown.esc="cancel"
        >
            <slot name="input"></slot>
        </div>
        <div class="v-small-dialog__actions">
            <v-spacer></v-spacer>

            <v-btn
                text
                light
                @click="cancel"
            >
                {{ this.cancelText }}
            </v-btn>
            <v-btn
                color="primary"
                text
                light
                @click="save"
            >
                {{ this.saveText }}
            </v-btn>
        </div>
    </v-menu>
</template>

<script>
export default {
    name: "EditDialogComponent",
    data() {
        return {
            isActive: false,
            originalValue: null,
        }
    },
    props: {
        cancelText: {
            default: 'Відмінити',
        },
        saveText: {
            default: 'Зберегти',
        },
        persistent: Boolean,
        returnValue: {
            default: null,
        },
        validator: {
            type: Object,
            default: null,
        }
/*
TODO
        large: Boolean,
        eager: Boolean,
        transition: {
            type: String,
            default: 'slide-x-reverse-transition',
        },

*/
    },
    watch: {
        isActive (val) {
            if (val) {
                this.originalValue = this.returnValue
                this.$emit('open')
                setTimeout(this.focus, 50) // Give DOM time to paint
            } else {
                this.$emit('update:return-value', this.originalValue)
                this.$emit('close')
            }
        },
    },
    methods: {
        cancel () {
            this.isActive = false
            this.$emit('cancel')
        },
        save() {
            this.checkIsCanBeSaved().then(result => {
                if(result) {
                    if (this.originalValue === this.returnValue) {
                        this.isActive = false
                        this.$emit('changeless-save')
                    }
                    else {
                        this.isActive = false
                        this.originalValue = this.returnValue
                        this.$emit('save')
                    }
                }
                else {
                    this.$emit('save-forbidden')
                }
            });
        },
        show() {
            this.isActive = true
        },
        async checkIsCanBeSaved() {    //TODO: Add exception handling, delete debug messages
            //console.log(this.validator)
            if (this.validator) {
                //console.log('validating');
                return await this.validator.validate()
                    .then(result => {
                        console.log('Fn-checkIsCanBeSaved', 'Validation result', result)
                        return result;
                    })
                    .catch(error => {
                        console.error('ItemUpdateValidationError - ', error)
                        return false;
                    });
            }
            console.warn('validator disabled')
            return true;
        },
    },
}
</script>
