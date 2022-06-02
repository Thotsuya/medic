<template>
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Pago</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Monto <span class="text-danger">{{ currencyLabel }}</span></label>
                                <input v-model="paymentForm.amount" type="number" step="any" class="form-control" :class="{ 'is-invalid' : $page.props.errors.amount }" >
                                <span class="text-danger text-sm" v-if="$page.props.errors.amount">{{ $page.props.errors.amount }}</span>
                            </div>
                            <div class="form-group">
                                <label>Metodo de pago</label>
                                <select v-model="paymentForm.payment_method" class="form-control">
                                    <option value="0">Efectivo</option>
                                    <option value="1">Tarjeta de credito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button @click="storePayment" type="button" class="btn btn-primary">Guardar Pago</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useForm, usePage} from '@inertiajs/inertia-vue3'
import {computed, onMounted } from "vue";
import { useStore } from 'vuex';

export default {

    emits:['store-payment'],

    setup(props,context) {

        const store = useStore();

        const paymentForm = useForm({
            attention_id: null,
            description: '',
            amount: 0,
            payment_method: 0,
        })

        const currencyLabel = computed(() => {
            return usePage().props.value.currency.currency
                ? `(${usePage().props.value.currency.currency})` : '';
        })


        const storePayment = () => {
            context.emit('store-payment', paymentForm)
        }

        onMounted(() => {
            paymentForm.attention_id = store.getters.getAttention.id
            paymentForm.description = store.getters.getAttention.description
        })

        return {
            paymentForm,
            currencyLabel,
            storePayment
        }
    }
}
</script>

