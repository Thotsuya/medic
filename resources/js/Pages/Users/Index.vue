<template>

    <Head title="Usuarios"/>

    <Layout>
        <template #header>
            Usuarios
        </template>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-12 col-md-4 col-sm-4">
                            <Link :href="route('users.create')" class="btn btn-primary btn-block"><i
                                class="nav-icon fas fa-users"></i>&nbsp; Nuevo Usuario
                            </Link>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_table" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users.data" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.name }}</td>
                                        <td class="text-center">{{ user.email }}</td>
                                        <td class="text-center"><span class="badge badge-info">{{ user.roles[0].name }}</span></td>
                                        <td class="text-center">
                                            <Link :href="route('users.edit',user.uuid)" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </Link>
                                            <button @click="deleteUser(user.uuid)" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <Pagination :links="users.links"></Pagination>
                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>


    </Layout>
</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Head, Link} from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination";
import useUsers from "@/Composables/User";

export default {

    props: {
        users: {
            type: Object,
            required: true
        }
    },

    components: {
        Layout,
        Link,
        Head,
        Pagination
    },

    setup(){
        const { deleteUser } = useUsers()

        return {
            deleteUser
        }
    }

}
</script>
