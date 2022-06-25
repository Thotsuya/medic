<template>

    <Head :title="'Detalles del Plan de tratamiento'"></Head>

    <Layout>
        <template #header>
            Detalles del plan de tratamiento
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
                                    <i class="fas fa-tooth"></i> Clínica Dental Guerrero
                                    <small class="float-right">Fecha: {{ attention.data.start_date_formatted }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="mt-2 row invoice-info">
                            <div class="col-sm-12 invoice-col">

                                <address>
                                    <strong>Paciente:</strong> {{ attention.data.patient.name }}<br>
                                    <b>Atendido Por:</b> {{ attention.data.user.name }}<br>
                                    <b>Código Atención:</b> {{ attention.data.code }}<br>
                                    <b>Tratamiento</b>:{{ attention.data.description }}<br>
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
                                        <th class="text-center" style="width: 20%">Precio <span class="text-danger q">{{ currencyLabel }}</span></th>
                                        <th class="text-center">Descuento</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr v-if="proceduresList.length" v-for="procedure in proceduresList" :key="procedure.id">
                                        <td>{{ procedure.name }}</td>
                                        <td>{{ procedure.unformatted_price }}</td>
                                        <td class="text-center">{{ procedure.discount }}</td>
                                        <td class="text-center">{{ procedure.amount }}</td>
                                        <td class="text-center">{{ procedure.subtotal }}</td>
                                    </tr>
                                    <tr v-else>
                                        <td class="text-center" colspan="5">No hay procedimientos o servicios registrados</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-12">
                                <p class="lead">Pagos Registrados:</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Método de Pago</th>
                                        <th class="text-center">Tratamiento</th>
                                        <th class="text-center">Fecha</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-if="attention.data.has_payments" v-for="payment in attention.payments" :key="payment.id">
                                        <td class="text-center">{{ payment.formatted_amount }}</td>
                                        <td class="text-center">
                                            <span :class="payment.method[0]">{{ payment.method[1] }}</span>
                                        </td>
                                        <td class="text-center">{{ attention.data.short_description }}</td>
                                        <td class="text-center">{{ payment.formatted_date }}</td>
                                    </tr>
                                    <tr v-else>
                                        <td class="text-center" colspan="5">Aún no se han registrado pagos para este plan de tratamiento</td>
                                    </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-lg-6">
                                <p class="lead">Observaciones:</p>

                                <p class="shadow-none text-muted well well-sm" style="margin-top: 10px;" v-html="attention.data.observations">

                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-lg-6">
                                <p class="lead">Monto a cobrar</p>

                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <th>Estado</th>
                                            <td class="text-right">
                                                <span :class="`badge ${attention.data.status_badge.badge}`">{{ attention.data.status_badge.label }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width:50%">Precio consulta:</th>
                                            <td class="text-right">{{ attention.data.price_formatted }}</td>
                                        </tr>
                                        <tr>
                                            <th>Precio Servicios</th>
                                            <td class="text-right">{{ attention.servicesSubtotal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td class="text-right"><b>{{ attention.total }}</b></td>
                                        </tr>
                                        <tr>
                                            <th>Pagado:</th>
                                            <td class="text-right">{{ attention.data.total_paid }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pendiente:</th>
                                            <td class="text-right">{{ attention.data.pending }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
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
import {usePage,Link, Head} from "@inertiajs/inertia-vue3";
import { useStore } from 'vuex';
import {Inertia} from '@inertiajs/inertia';
import Swal from 'sweetalert2';

import { Modal } from 'bootstrap'

export default {

    props: {
        attention: {
            type: Object,
            required: true
        }
    },

    components: {
        Layout,
        Link,
        Head
    },

    setup(props){

        const proceduresList = reactive([])
        const store = useStore()

        const currencyLabel = computed(() => {
            return usePage().props.value.currency.currency
                ? `(${usePage().props.value.currency.currency})` : '';
        })

        const updateAttention = () => {
            Inertia.put(route('attentions.procedures.update', props.attention.data.uuid), {
                procedures: proceduresList
            },{

            })
        }

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
            props.attention.procedures.forEach(procedure => {
                proceduresList.push(procedure)
            })
        }

        const storePayment = (payment) => {
            payment.post(route('payments.store'),{
                preserveScroll: true,
                onSuccess: () => {
                    $('#paymentModal').modal('hide')
                }
            })
        }

        const deletePayment = (payment) => {
            Swal.fire({
                title: '¿Estás seguro de eliminar este pago?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.value) {
                    Inertia.delete(route('payments.destroy',payment),{
                        preserveScroll: true,
                        onSuccess: () => {
                            Swal.fire(
                                '¡Eliminado!',
                                'El pago ha sido eliminado.',
                                'success'
                            )
                        }
                    })
                }
            })
        }

        return {
            currencyLabel,
            proceduresList,
            updateAttention,
            deletePayment,
            storePayment
        }
    }

}
</script>
