<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white p-4 my-5 rounded">
                    <h3 class="mb-3">Register</h3>                    
                    <form @submit.prevent="handleSubmit">
                        <div class="form-group">
                            <label for="register-name">Name</label>
                            <input 
                                type="text" 
                                id="register-name" 
                                class="form-control" 
                                required
                                v-model="name"
                            >
                        </div>
                        <div class="form-group">
                            <label for="register-email">E-mail</label>
                            <input 
                                type="email" 
                                id="register-email" 
                                class="form-control" 
                                required
                                v-model="email"
                            >
                        </div>
                        <div class="form-group">
                            <label for="register-password">Password</label>
                            <input 
                                type="password" 
                                id="register-password" 
                                class="form-control" 
                                required
                                v-model="password"
                            >
                        </div>
                        <div class="form-group">
                            <label for="register-password-confirmation">Confirm your password</label>
                            <input 
                                type="password" 
                                id="register-password-confirmation" 
                                class="form-control" 
                                required
                                v-model="password_confirmation"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary" :disabled="isLoading">
                            Register
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
        name: "RegisterForm",
        mixins: [toasts],
        props: {
            loginUrl: {
                type: String,
                required: true,
            },
            saveUrl: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                isLoading: false,
            }
        },
        methods: {
            handleSubmit() {
                this.isLoading = true;

                this.$http.post(this.saveUrl, {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                }).then(response => {
                    this.addToastSuccess('User registered successfully! redirecting...');
                    setTimeout(() => {
                        document.location.href = this.loginUrl;
                    }, 3000);
                }).catch(error => {
                    this.addToastError(error, 'Error registering user.');
                }).finally(() => {
                    this.isLoading = false
                });
            }
        }
    }
</script>