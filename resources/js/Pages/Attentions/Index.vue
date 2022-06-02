<template>

    <Head :title="'Atenciones'"></Head>

    <Layout>
        <template #header>
            Planes de tratamiento
        </template>

        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <input v-model="search" type="text" class="form-control mb-2" placeholder="Buscar un plan de tratamiento">
                    <Link :href="route('attentions.create')" class="btn btn-block btn-primary">Nuevo Plan de Tratamiento</Link>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Paciente</th>
                                    <th class="text-center">Asunto</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-if="attentions.data.length" v-for="(attention,index) in attentions.data" :key="attention.id">
                                    <td class="text-center">{{ attention.code }}</td>
                                    <td>{{ attention.patient.name }}</td>
                                    <td>{{ attention.description }}</td>
                                    <td class="text-center"><span :class="`badge ${attention.status.badge}`">{{ attention.status.label }}</span></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <Link :href="route('attentions.show',attention)" type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Detalles de Plan de tratamiento"><i class="fas fa-credit-card"></i></Link>
                                            <Link :href="route('attentions.edit',attention)" type="button" class="btn btn-warning"  data-bs-toggle="tooltip" title="Editar plan de tratamiento"><i class="fas fa-edit"></i></Link>
                                            <a :href="route('attentions.report',attention)" type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Exportar a PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
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
                    <Pagination :links="attentions.links"></Pagination>
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
      attentions: {
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
                Inertia.get(route('attentions.index'),{
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
