<script>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import AuthLayout from "@/Layouts/Auth/AuthLayout";

export default {
    props: {
        canResetPassword: Boolean,
        status: String,
    },

    components: {
        AuthLayout,
        Head,
        Link,
    },

    setup(props) {
        const form = useForm({
            email: '',
            password: '',
            remember: false
        });

        const submit = () => {
            form.post(route('login'), {
                onFinish: () => form.reset('password'),
            });
        };

        return {
            form,
            submit,
        };
    }
}
</script>

<style scoped>
@import "../../Layouts/Auth/css/util.css";
@import "../../Layouts/Auth/css/main.css";

.bg-login {
    background-image: url('../../Layouts/Auth/images/bg-04.jpg');
}


</style>


<template>
    <AuthLayout>
        <Head title="Log in"/>

<!--        <BreezeValidationErrors class="mb-4"/>-->

<!--        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">-->
<!--            {{ status }}-->
<!--        </div>-->

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form @submit.prevent="submit" class="login100-form validate-form">
                    <span class="login100-form-title p-b-43">
                    Iniciar Sesión para continuar
                </span>


                        <div class="wrap-input100 validate-input" data-validate="Emáil valido requerido: ex@abc.xyz">
                            <input class="input100 form-control" id="email" type="email" name="email"
                                   v-model="form.email" required autofocus autocomplete="email" >
                            <span class="focus-input100"></span>
                            <span class="label-input100">Email</span>
                        </div>


                        <div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
                            <input class="input100 form-control" id="password" type="password" name="password" required  v-model="form.password"
                                   autocomplete="current-password">


                            <span class="focus-input100"></span>
                            <span class="label-input100">Contraseña</span>
                        </div>

                        <div class="w-full flex-sb-m p-t-3 p-b-32">
                            <div class="contact100-form-checkbox">
                                <input id="ckb1" class="input-checkbox100" type="checkbox" name="remember" v-model="form.remember">
                                <label class="label-checkbox100" for="ckb1">
                                    Recordarme
                                </label>
                            </div>

                            <div>

                            </div>
                        </div>


                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Iniciar Sesión
                            </button>
                        </div>


                    </form>

                    <div class="login100-more bg-login">
                    </div>
                </div>
            </div>
        </div>



    </AuthLayout>
</template>
