<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white p-4 my-5 rounded">
                    <h3 class="mb-3">Login</h3>
                    <form @submit.prevent="handleSubmit">
                        <div class="form-group">
                            <label for="login-email">E-mail</label>
                            <input 
                                type="email" 
                                id="login-email" 
                                class="form-control" 
                                required
                                v-model="email"
                            >
                        </div>
                        <div class="form-group">
                            <label for="login-password">Password</label>
                            <input 
                                type="password" 
                                id="login-password" 
                                class="form-control" 
                                required
                                v-model="password"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary" :disabled="isLoading">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // global appVar

    import toasts from '../mixins/toasts';

    export default {
        name: "LoginForm",
        mixins: [toasts],
        props: {
            postUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                email: '',
                password: '',
                isLoading: false,
            }
        },
        methods: {
            handleSubmit() {
                this.isLoading = true;

                this.$http.post(this.postUrl, {
                    email: this.email,
                    password: this.password,
                }).then(response => {
                    this.addToastSuccess('Logged in successfully! redirecting...');
                    setTimeout(() => {
                        document.location.href = appVar.baseURL;
                    }, 3000);
                }).catch(error => {
                    this.addToastError({message: 'Error logging in, please check your credentials.'});
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>