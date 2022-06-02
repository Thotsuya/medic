<template>

    <Head :title="'Presupuestos'"></Head>

    <Layout>
        <template #header>
            Presupuestos
        </template>

        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <input v-model="search" type="text" class="form-control mb-2" placeholder="Buscar un plan de tratamiento">
                    <Link :href="route('valuations.create')" class="btn btn-block btn-primary">Nuevo Presupuesto</Link>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Paciente</th>
                                <th class="text-center">Asunto</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-if="valuations.data.length" v-for="(valuation,index) in valuations.data" :key="valuation.id">
                                <td class="text-center">{{ valuation.code }}</td>
                                <td>{{ valuation.patient.name }}</td>
                                <td>{{ valuation.description }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <Link :href="route('valuations.show',valuation.uuid)" type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Detalles de Plan de tratamiento"><i class="fas fa-credit-card"></i></Link>
                                        <Link :href="route('valuations.edit',valuation.uuid)" type="button" class="btn btn-warning"  data-bs-toggle="tooltip" title="Editar plan de tratamiento"><i class="fas fa-edit"></i></Link>
<!--                                        <a :href="route('valuations.report',valuation)" type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Exportar a PDF">-->
<!--                                            <i class="fas fa-file-pdf"></i>-->
<!--                                        </a>-->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar plan de tratamiento"><i class="fas fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="5" class="text-center">No hay tratamientos registrados | No se encontraron registros</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <Pagination :links="valuations.links"></Pagination>
                </div>


            </div>
        </div>

    </Layout>


</template>

<script>
import {Head,Link} from "@inertiajs/inertia-vue3"
import Layout from "@/Layouts/Admin/Layout";
import Pagination from "@/Components/Pagination";
import {Tooltip} from 'bootstrap'
import {onMounted, watch, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

export default {

    props: {
        valuations: {
            type: Object,
            required: true
        },
        search: {
            type: String,
            required: false
        }
    },

    components: {
        Layout,
        Head,
        Link,
        Pagination
    },

    setup(props){

        const search = ref(props.search);
        const loading = ref(false);

        watch(search, (value) => {

            _.debounce(() => {
                Inertia.get(route('valuations.index'),{
                    search: value
                },{
                    preserveState: true,
                    preserveScroll: true,
                    replace: true
                })
            }, 500)();


        })

        onMounted(() => {
            $('[data-bs-toggle="tooltip"]').tooltip()
        })

        return {
            search,
            loading
        }
    }

}
</script>
