<template>
    <Head :title="'Nuevo Tratamiento'"/>

    <Layout>
        <template #header>
            Nuevo Plan de Tratamiento
        </template>

        <div class="container-fluid">

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
                                    <span v-if="attentionForm.errors.patient_id"
                                          class="text-danger text-sm">{{ attentionForm.errors.patient_id }}</span>
                                </div>
                            </div>

                            <div class="clearfix row mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Asunto</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <input v-model="attentionForm.description" type="text" class="form-control"
                                           :class="{ 'is-invalid' : attentionForm.errors.description }" id="description"
                                           placeholder="Asunto del plan de tratamiento">
                                    <span v-if="attentionForm.errors.description"
                                          class="text-danger text-sm">{{ attentionForm.errors.description }}</span>
                                </div>
                            </div>

                            <div class="clearfix row mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Fecha de inicio</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <Datepicker v-model="attentionForm.start_date" utc></Datepicker>
                                    <span v-if="attentionForm.errors.start_date"
                                          class="text-danger text-sm">{{ attentionForm.errors.start_date }}</span>
                                </div>
                            </div>

                            <div class="clearfix row mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Precio <span class="text-danger">{{ currencyLabel }}</span>
                                    </label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <input v-model="attentionForm.price" type="number" step="any" class="form-control"
                                           :class="{ 'is-invalid' : attentionForm.errors.price }">
                                    <span v-if="attentionForm.errors.price"
                                          class="text-danger text-sm">{{ attentionForm.errors.price }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="description">Observaciones</label>
                                    <textarea v-model="attentionForm.observations" class="form-control"
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
                                        <tr v-if="proceduresList.length" v-for="(procedure,index) in proceduresList"
                                            :key="procedure.id">
                                            <td>{{ procedure.name }}</td>
                                            <td>
                                                <input v-model="procedure.amount" type="number" step="any"
                                                       class="form-control"
                                                       :class="{ 'is-invalid' : attentionForm.errors[`procedures.${index}.amount`] }">
                                                <span class="text-danger text-sm"
                                                      v-if="attentionForm.errors[`procedures.${index}.amount`]">{{
                                                        attentionForm.errors[`procedures.${index}.amount`]
                                                    }}</span>
                                            </td>
                                            <td>
                                                <input v-model="procedure.discount" type="number" step="any"
                                                       class="form-control"
                                                       :class="{ 'is-invalid' : attentionForm.errors[`procedures.${index}.discount`] }">
                                                <span class="text-danger text-sm"
                                                      v-if="attentionForm.errors[`procedures.${index}.discount`]">{{
                                                        attentionForm.errors[`procedures.${index}.discount`]
                                                    }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm"
                                                        @click="removeProcedure(procedure)"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td colspan="4" class="text-center">Añade servicios o tratamientos
                                                seleccionandolos con el botón + en el listado de la derecha
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" @click="storeAttention"><i
                                class="fas fa-save mr-2"></i> Guardar
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
                                        <th>Accion</th>
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
import {onMounted} from "vue";
import {Head} from '@inertiajs/inertia-vue3'
import Pagination from "@/Components/Pagination";

import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import useCurrency from "@/Composables/Currency";
import useAttention from "@/Composables/Attention";

export default {
    components: {
        Layout,
        Head,
        Pagination,
        Datepicker
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
    },

    setup(props) {


        const {attentionForm, proceduresList, storeAttention, addProcedure, removeProcedure} = useAttention()
        const {currencyLabel} = useCurrency()


        onMounted(() => {

            $('.select2').select2({
                width: '100%'
            });
            $('.select2').on('change', (event) => {
                attentionForm.patient_id = event.target.value
            });
            
        })

        return {
            currencyLabel,
            proceduresList,
            attentionForm,
            addProcedure,
            storeAttention,
            removeProcedure
        }

    }
}
</script>
