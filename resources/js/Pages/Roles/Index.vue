<template>
<Layout>
    <Head title="Roles"></Head>

    <template #header>Roles de Usuarios</template>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <Link :href="route('roles.create')" class="btn btn-primary btn-block">
                        <i class="fas fa-user"></i>
                        Crear nuevo rol
                    </Link>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-for="role in roles" :key="role.id">
                                <td>{{ role.id }}</td>
                                <td>{{ role.name }}</td>
                                <td class="text-center">
                                    <Link :href="route('roles.edit',role)" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></Link>
                                </td>
                            </tr>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>


            </div>
        </div>
    </div>

</Layout>
</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Head, Link} from "@inertiajs/inertia-vue3";

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
}
</script>
