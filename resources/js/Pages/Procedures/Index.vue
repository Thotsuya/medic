<template>
    <Head :title="'Servicios'"/>

    <Layout>
        <template #header>
            Servicios
        </template>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <input v-model="search" type="text" class="form-control w-50 mb-2" placeholder="Buscar un servicio">
                            <button data-bs-toggle="modal" data-bs-target="#proceduresModal" class="btn btn-primary btn-block waves-effect">Añadir nuevo servicio</button>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Servicio</th>
                                    <th class="text-center">Precio {{ currencyLabel }}</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="procedures.data.length" v-for="procedure in procedures.data" :key="procedure.id">
                                        <td>{{ procedure.name }}</td>
                                        <td>{{ procedure.formatted_price }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button @click="openEditModal(procedure)" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                                <button @click="destroyProcedure(procedure)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="3" class="text-center">No hay servicios registrados | No se encontraron resultados</td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th class="text-center">Servicio</th>
                                    <th class="text-center">Precio {{ currencyLabel }}</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            <Pagination :links="procedures.links"></Pagination>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <ProcedureCreateModal/>
        <ProcedureEditModal/>

    </Layout>

</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Modal} from "bootstrap"
import { Head } from "@inertiajs/inertia-vue3"
import { useStore } from 'vuex'
import { watch,ref } from "vue";
import ProcedureCreateModal from "@/Components/Modals/ProcedureCreateModal";
import ProcedureEditModal from "@/Components/Modals/ProcedureEditModal";
import Pagination from '@/Components/Pagination';
import {Inertia} from "@inertiajs/inertia";

import useCurrency from "@/Composables/Currency";
import useProcedures from "@/Composables/Procedure";

export default {

    props: {
        procedures: {
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
        Pagination,
        ProcedureCreateModal,
        ProcedureEditModal
    },

    setup(props){

        const search = ref(props.search);
        const store = useStore();

        const { currencyLabel } = useCurrency();
        const { destroyProcedure } = useProcedures();

        const openEditModal = (procedure) => {
            store.commit('SET_PROCEDURE', procedure);
            $('#proceduresEditModal').modal('show')
        }

        watch(() => search.value, () => {
            _.debounce(() => {
                Inertia.get(route('procedures.index'),{
                    search: search.value
                },{
                    preserveState: true,
                    preserveScroll: true,
                    replace: true
                })
            },500)();
        });



        window.Echo
            .channel('messages')
            .listen('.new-message', async () => {
                console.log('new message received')
            })


        return {
            currencyLabel,
            openEditModal,
            destroyProcedure,
            search
        }
    }

}
</script>
