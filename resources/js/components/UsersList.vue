<template>
    <div class="container mt-4">

        <div class="row mb-3">
            <div class="col-12">
                <form class="d-flex justify-content-around">
                    <div class="form-group">
                        <input v-model="globalSearch" type="text" class="form-control" placeholder="Глобальний пошук">
                    </div>

                    <div class="form-group">
                        <select v-model="role" class="form-control" id="exampleFormControlSelect1">
                            <option value="user">Користувач</option>
                            <option value="manager">Менеджер</option>
                            <option value="admin">Адміністратор</option>
                        </select>
                    </div>

                    <div class="submit">
                        <button type="submit" @click.prevent="fetch" class="btn btn-primary" :disabled="busy">
                            <i v-if="busy" class="fa fa-spin fa-spinner"></i>
                            Пошук
                        </button>
                    </div>

                    <div class="submit">
                        <button type="submit" @click.prevent="reset" class="btn btn-default"  :disabled="busy">
                            Стерти
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Ім'я</th>
                        <th scope="col">Email</th>
                        <th scope="col">Роль</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                    </tr>
                    </tbody>
                </table>

                <v-pagination
                    v-model="page"
                    class="my-4"
                    :length="15"
                    :disabled="busy"
                ></v-pagination>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            pagination: {
                current_page: 1,
            },
            page: null,
            globalSearch: null,
            role: null,

            users: [],

            busy: false,
        }
    },

    methods: {
        reset() {
            this.globalSearch = null;
            this.role = null;

            this.fetch();
        },
        fetch() {
            this.busy = true;

            axios.get('/api/users', {
                params: {
                    page: this.page,
                    globalSearch: this.globalSearch,
                    role: this.role,
                }
            })
            .then(response => {
                this.pagination = response.data;
                this.users = this.pagination.data;

                console.log(response.data);

                this.busy = false;
            })
        }
    },

    mounted() {
        this.fetch();
    }
}
</script>
