<template>
    <Head title="Editar Rol" />

    <Layout>
        <template #header>
            Editar Rol
        </template>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">

                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name">Nombre:</label>
                                <input v-model="roleForm.name" type="text" class="form-control" :class="{ 'is-invalid' : roleForm.errors.name }" placeholder="Nombre del Rol">
                                <span v-if="roleForm.errors.name" class="text-sm text-danger">{{ roleForm.errors.name }}</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="name">Permisos:</label>
                                <select class="form-control select2" multiple style="width: 100%">
                                    <option v-for="permission in permissions" :key="permission.id" :value="permission.id" >{{ permission.name }}</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <button @click="updateRole" class="btn btn-block btn-primary">Guardar <i class="fas fa-save ml-2"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </Layout>

</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Head, Link} from '@inertiajs/inertia-vue3';
import useRoles from "@/Composables/Roles";
import {onMounted} from "vue";

export default {

    props: {

        role:{
            type: Object,
            required: true
        },
        permissions: {
            type: Array,
            required: true,
            default: []
        }
    },

    components: {
        Layout,
        Link,
        Head
    },

    setup(props){
        const { roleForm,updateRole,fillRoleForm } = useRoles();

        onMounted(() => {

            fillRoleForm(props.role);

            $('.select2').select2({
                placeholder: 'Selecciona uno o varios permisos',
                allowClear: true,
                width: '100%'
            });

            $('.select2').on('select2:unselect',function(e){
                roleForm.permissions = roleForm.permissions.filter(permission => permission !== parseInt(e.params.data.id));
            })

            $('.select2').on('select2:select', function (e) {
                roleForm.permissions.push(parseInt(e.params.data.id));
            });

            $('.select2').val(roleForm.permissions).trigger('change');
        })

        return {
            roleForm,
            updateRole
        }
    }

}
</script>
