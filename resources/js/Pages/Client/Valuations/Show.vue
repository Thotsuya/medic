<template>

    <Head :title="'Detalles del Presupuesto0'"></Head>

    <Layout>
        <template #header>
            Detalles del Presupuesto
        </template>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Main content -->
                    <div class="p-3 mb-3 invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-tooth"></i>
                                    <small class="float-right">Fecha: {{ valuation.data.start_date_formatted }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="mt-2 row invoice-info">
                            <div class="col-sm-12 invoice-col">

                                <address>
                                    <strong>Paciente:</strong> {{ valuation.data.patient.name }}<br>
                                    <b>Código Presupuesto:</b> {{ valuation.data.code }}<br>
                                    <b>Tratamiento</b>:{{ valuation.data.description }}<br>
                                </address>
                            </div>

                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">

                            <div class="col-12 table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Procedimiento / Servicio</th>
                                        <th class="text-center" style="width: 20%">Precio <span
                                            class="text-danger q">{{ currencyLabel }}</span></th>
                                        <th class="text-center">Descuento</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr v-if="proceduresList.length" v-for="(procedure,index) in proceduresList"
                                        :key="procedure.id">
                                        <td>{{ procedure.name }}</td>
                                        <td>{{ procedure.unformatted_price }}</td>
                                        <td class="text-center">
                                            {{ procedure.discount }}
                                        </td>
                                        <td class="text-center">
                                            {{ procedure.amount }}
                                        </td>
                                        <td class="text-center">{{ procedure.subtotal }}</td>
                                    </tr>
                                    <tr v-else>
                                        <td class="text-center" colspan="5">No hay procedimientos o servicios
                                            registrados
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!-- /.row -->


                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-lg-6">
                                <p class="lead">Observaciones:</p>

                                <p class="shadow-none text-muted well well-sm" style="margin-top: 10px;"
                                   v-html="valuation.data.observations">

                                </p>
                            </div>
                            <!-- /.col -->

                            <div class="col-lg-6">
                                <p class="lead">Monto a cobrar</p>

                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <th style="width:50%">Precio consulta:</th>
                                            <td class="text-right">{{ valuation.data.formatted_price }}</td>
                                        </tr>
                                        <tr>
                                            <th>Precio Servicios</th>
                                            <td class="text-right">{{ valuation.servicesSubtotal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td class="text-right"><b>{{ valuation.total }}</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>


    </Layout>


</template>

<script>
import Layout from "@/Layouts/Patients/Layout"
import {computed, onMounted, onBeforeMount, reactive, onUpdated} from "vue";
import {usePage, Link, Head} from "@inertiajs/inertia-vue3";
import {useStore} from 'vuex';
import {Inertia} from '@inertiajs/inertia';
import PaymentModal from "@/Components/Modals/PaymentModal";
import Swal from 'sweetalert2';

import {Modal} from 'bootstrap'

export default {

    props: {
        valuation: {
            type: Object,
            required: true
        }
    },

    components: {
        Layout,
        Link,
        Head,
        PaymentModal
    },

    setup(props) {

        const proceduresList = reactive([])
        const store = useStore()

        const currencyLabel = computed(() => {
            return usePage().props.value.currency.currency
                ? `(${usePage().props.value.currency.currency})` : '';
        })

        onBeforeMount(() => {
            store.commit('SET_ATTENTION', props.attention.data)
        })

        onMounted(() => {
            fetchProcedures()
        })

        onUpdated(() => {
            fetchProcedures()
        })

        const fetchProcedures = () => {
            proceduresList.splice(0, proceduresList.length)
            props.valuation.procedures.forEach(procedure => {
                proceduresList.push(procedure)
            })
        }

        return {
            currencyLabel,
            proceduresList,
        }
    }

}
</script>
