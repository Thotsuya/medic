<template>
    <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
        <div class="col-12">
            <div class="table-responsive">
                <table id="appointments_table" class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th class="text-center">Monto</th>
                        <th class="text-center">Método de Pago</th>
                        <th class="text-center">Tratamiento</th>
                        <th class="text-center">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" v-if="!payments.length" colspan="7">No hay pagos registrados para este paciente</td>
                        </tr>
                        <tr v-for="(payment,index) in payments" :key="payment.id">
                            <td class="text-center">{{ payment.formatted_amount }}</td>
                            <td class="text-center">
                                <span :class="payment.method[0]">{{ payment.method[1] }}</span>
                            </td>
                            <td class="text-center">{{ payment.description }}</td>
                            <td class="text-center">{{ payment.formatted_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { useStore } from 'vuex'
import { computed } from "vue";
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2';

export default {

    setup(){
        const store = useStore()

        const payments = computed(() => {
            return store.getters.getPayments
        })


        return {
            store,
            payments
        }
    },

}
</script>
