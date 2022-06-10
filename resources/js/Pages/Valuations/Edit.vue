<template>
    <Head :title="'Editar Presupuesto'"/>

    <Layout>
        <template #header>
            Editar Presupuesto
        </template>

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div v-if="valuationForm.hasErrors" class="alert alert-danger">
                        <ul>
                            <li v-for="error in valuationForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="header-title">Plan de tratamiento</div>
                        </div>

                        <div class="card-body">

                            <div class="clearfix row">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Paciente</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <select name="" id="name" class="select2 form-control">
                                        <option v-for="patient in patients" :key="patient.id" :value="patient.id">
                                            {{ patient.name }}
                                        </option>
                                    </select>
                                    <span v-if="valuationForm.errors.patient_id"
                                          class="text-danger text-sm">{{ valuationForm.errors.patient_id }}</span>
                                </div>
                            </div>

                            <div class="clearfix row mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Asunto</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <input v-model="valuationForm.description" type="text" class="form-control"
                                           :class="{ 'is-invalid' : valuationForm.errors.description }" id="description"
                                           placeholder="Asunto del plan de tratamiento">
                                    <span v-if="valuationForm.errors.description"
                                          class="text-danger text-sm">{{ valuationForm.errors.description }}</span>
                                </div>
                            </div>

                            <div class="clearfix row mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Precio <span class="text-danger">{{ currencyLabel }}</span>
                                    </label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <input v-model="valuationForm.price" type="number" step="any" class="form-control"
                                           :class="{ 'is-invalid' : valuationForm.errors.price }">
                                    <span v-if="valuationForm.errors.price"
                                          class="text-danger text-sm">{{ valuationForm.errors.price }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="description">Observaciones</label>
                                    <textarea v-model="valuationForm.observations" class="form-control"
                                              id="observations" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="clearfix row mt-4 table-responsive text-center">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-dark">
                                        <tr>
                                            <th>Tratamiento</th>
                                            <th>Cantidad</th>
                                            <th>Descuento</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(procedure,index) in proceduresList" :key="procedure.id">
                                            <td>{{ procedure.name }}</td>
                                            <td>
                                                <input v-model="procedure.amount" type="number" step="any"
                                                       class="form-control">
                                            </td>
                                            <td>
                                                <input v-model="procedure.discount" type="number" step="any"
                                                       class="form-control">
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm"
                                                        @click="removeProcedure(procedure)"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" @click="updateValuation"><i
                                class="fas fa-save mr-2"></i> Actualizar
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="header-title">Servicios</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>Servicio</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="procedure in procedures.data" :key="procedure.id">
                                        <td>{{ procedure.name }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" @click="addProcedure(procedure)">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <Pagination :links="procedures.links"></Pagination>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </Layout>


</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {onMounted, onBeforeMount} from "vue";
import {Head} from '@inertiajs/inertia-vue3'
import Pagination from "@/Components/Pagination";

import useCurrency from "@/Composables/Currency";
import useValuation from "@/Composables/Valuation";

export default {
    components: {
        Layout,
        Head,
        Pagination
    },

    props: {
        patients: {
            type: Array,
            default: [],
            required: true
        },
        procedures: {
            type: Object,
            default: [],
            required: true
        },
        valuation: {
            type: Object,
            default: {},
            required: true
        },
    },

    setup(props) {


        const {currencyLabel} = useCurrency();
        const {
            fillValuation,
            updateValuation,
            proceduresList,
            valuationForm,
            addProcedure,
            removeProcedure
        } = useValuation();

        onBeforeMount(() => {
            fillValuation(props.valuation);
        })

        onMounted(() => {

            props.valuation.procedures.forEach(procedure => {
                proceduresList.push({
                    id: procedure.id,
                    name: procedure.name,
                    price: procedure.price,
                    price_USD: procedure.price_USD,
                    amount: procedure.pivot.amount,
                    discount: procedure.pivot.discount
                })
            })

            $('.select2').select2({
                width: '100%'
            });
            $('.select2').val(`${props.valuation.patient_id}`);
            $('.select2').trigger('change');

            $('.select2').on('change', (event) => {
                valuationForm.patient_id = event.target.value
            });
        })

        return {
            currencyLabel,
            proceduresList,
            valuationForm,
            addProcedure,
            removeProcedure,
            updateValuation
        }

    }
}
</script>
