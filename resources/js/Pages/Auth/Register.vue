<script>
import BreezeButton from '@/Components/Button.vue';
import AuthLayout from "@/Layouts/Auth/AuthLayout";
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

export default {

    components: {
        AuthLayout,
        BreezeButton,
        Head,
        Link,
    },

    setup(){
        const form = useForm({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            terms: false,
        });

        const submit = () => {
            form.post(route('register'), {
                onFinish: () => form.reset('password', 'password_confirmation'),
            });
        }

        return {
            form,
            submit,
        };
    }
};
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
        <Head title="Register" />

<!--        <BreezeValidationErrors class="mb-4" />-->

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form @submit.prevent="submit" class="login100-form validate-form">
                    <span class="login100-form-title p-b-43">
                    Registrarse como Paciente
                </span>


                        <div class="wrap-input100 validate-input" data-validate="Emáil valido requerido: ex@abc.xyz">
                            <input class="input100 form-control" id="email" type="text" name="name"
                                   v-model="form.name" required autofocus autocomplete="email" >
                            <span class="focus-input100"></span>
                            <span class="label-input100">Nombre</span>
                        </div>

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

                        <div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
                            <input class="input100 form-control" id="password_confirmation" type="password" name="password" required  v-model="form.password_confirmation"
                                   autocomplete="current-password">


                            <span class="focus-input100"></span>
                            <span class="label-input100">Confirmar Contraseña</span>
                        </div>



                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Registrarse
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
