<template>

    <Layout>

        <Head :title="'Nuevo Usuario'"/>

        <template #header>Nuevo Usuario</template>

        <div class="card card-outline card-primary">

            <div class="card-header"/>

            <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Usuario:</label>
                            <input v-model="userForm.name" type="text" class="form-control" :class="{ 'is-invalid' : userForm.errors.name }" placeholder="Nombre del Usuario">
                            <span v-if="userForm.errors.name" class="text-sm text-danger">{{ userForm.errors.name }}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input v-model="userForm.email" type="email" class="form-control" :class="{ 'is-invalid' : userForm.errors.email }" placeholder="Email del Usuario">
                            <span v-if="userForm.errors.email" class="text-sm text-danger">{{ userForm.errors.email }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Contraseña:</label>
                            <input v-model="userForm.password" type="password" class="form-control" :class="{ 'is-invalid' : userForm.errors.password }" placeholder="Contraseña">
                            <span v-if="userForm.errors.password" class="text-sm text-danger">{{ userForm.errors.password }}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Confirmar Contraseña:</label>
                            <input v-model="userForm.password_confirmation" type="password" class="form-control" placeholder="Confirmar Contraseña">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Roles</label>

                        <select class="form-control select2" style="width: 100%">
                            <option v-for="role in roles" :key="role.id" :value="role.id" >{{ role.name }}</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <button @click="createUser" type="button" class="btn btn-primary btn-block">Guardar</button>
                    </div>

            </div>
        </div>


    </Layout>

</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Head, Link} from '@inertiajs/inertia-vue3';
import useUsers from "@/Composables/User";
import {onMounted} from "vue";

export default {

    props: {
        roles: {
            type: Array,
            required: true,
            default: []
        },
    },

    components: {
        Layout,
        Link,
        Head
    },

    setup(){
        const {userForm, createUser} = useUsers();


        onMounted(() => {
            $('.select2').select2({
                width: '100%'
            });
            $('.select2').on('change',(event) => {
                userForm.role_id = event.target.value
            });

            $('.select2').val(userForm.role_id).trigger('change');
        })

        return {
            userForm,
            createUser
        }


    }

}
</script>
