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
                                    <i class="fas fa-tooth"></i> Clínica Dental Guerrero
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
                                        <td><input v-model="procedure.unformatted_price" type="number" step="any"
                                                   class="form-control"></td>
                                        <td class="text-center">
                                            <input v-model="procedure.discount" type="number" step="any"
                                                   class="form-control"
                                                   :class="{ 'is-invalid' : $page.props.errors[`procedures.${index}.discount`] }">
                                            <span class="text-danger text-sm"
                                                  v-if="$page.props.errors[`procedures.${index}.discount`]">{{
                                                    $page.props.errors[`procedures.${index}.discount`]
                                                }}</span>
                                        </td>
                                        <td class="text-center">
                                            <input v-model="procedure.amount" type="number"
                                                   class="form-control"
                                                   :class="{ 'is-invalid' : $page.props.errors[`procedures.${index}.amount`] }">
                                            <span class="text-danger text-sm"
                                                  v-if="$page.props.errors[`procedures.${index}.amount`]">{{
                                                    $page.props.errors[`procedures.${index}.amount`]
                                                }}</span>
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
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="button" @click="updateValuation" class=" float-right btn btn-success"><i
                                    class="fas fa-save mr-2"></i>Guardar Cambios
                                </button>
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


                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">

                                <!--                                <a href="{{ route('admin.attention.report',$attention) }}" class="float-right btn btn-primary mr-2">-->
                                <!--                                    <i class="fas fa-download"></i> Exportar a PDF-->
                                <!--                                </a>-->

                                <Link :href="route('valuations.edit',valuation.data.uuid)"
                                      class="float-right btn btn-warning mr-2">
                                    <i class="fas fa-edit"></i> Editar Tratamiento
                                </Link>

                            </div>
                        </div>

                        <PaymentModal
                            @store-payment="storePayment"
                        />

                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>


    </Layout>


</template>

<script>
import Layout from "@/Layouts/Admin/Layout"
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

        const updateValuation = () => {
            Inertia.put(route('valuations.procedures.update', props.valuation.data.uuid), {
                procedures: proceduresList
            }, {
                preserveScroll: true,
                onError: (errors) => {
                    console.log(errors)
                    Swal.fire({
                        title: 'Error',
                        text: errors.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
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
            props.valuation.procedures.forEach(procedure => {
                proceduresList.push(procedure)
            })
        }

        const storePayment = (payment) => {
            payment.post(route('payments.store'), {
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
                    Inertia.delete(route('payments.destroy', payment), {
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
            updateValuation,
            deletePayment,
            storePayment
        }
    }

}
</script>
