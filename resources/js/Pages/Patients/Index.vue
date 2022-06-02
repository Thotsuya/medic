<template>

    <Head title="Pacientes" />

    <Layout>
        <template #header>
            Pacientes
        </template>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <input type="text" class="form-control col-lg-6 mb-2" placeholder="Buscar un paciente" v-model="search">
                        <Link :href="route('patients.create')" class="btn btn-primary btn-block">
                            <i class="fas fa-user"></i>
                            Crear nuevo paciente
                        </Link>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Código</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Cédula</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr v-if="patients.data.length" v-for="patient in patients.data" :key="patient.id">
                                    <td class="text-center">{{ patient.code }}</td>
                                    <td>{{ patient.name }}</td>
                                    <td>{{ patient.document }}</td>
                                    <td>{{ patient.phone }}</td>
                                    <td class="text-center" v-html="patient.badge"></td>
                                    <td class="text-center">
                                        <Link :href="route('patients.show',patient)" class="btn btn-primary waves-effect"><i class="fas fa-id-card-alt"></i></Link>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="6" class="text-center">No hay pacientes registrados | No se encontraron pacientes</td>
                                </tr>
                            </tbody>

                            <tfoot>
                            <tr>
                                <th class="text-center">Código</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Cédula</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="card-footer">
                        <Pagination :links="patients.links"/>
                    </div>

                </div>
            </div>
        </div>

    </Layout>
</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import Pagination from "@/Components/Pagination";
import { Inertia } from "@inertiajs/inertia";
import { Head,Link } from '@inertiajs/inertia-vue3'
import {ref,watch} from "vue";

export default {
    props: {
        patients: {
            type: Object,
            required: true
        },
        search: {
            type: String,
            required: false
        }
    },
    components: {Layout, Head,Link,Pagination},

    setup(props) {

        const search = ref(props.search);

        watch(() => search.value, () => {
            _.debounce(() => {
                Inertia.get(route('patients.index'), {
                    search: search.value,
                },{
                    preserveScroll: true,
                    preserveState: true,
                    replace: true
                });
            }, 500)();

        });

        return {
            search
        }

    }
}
</script>
