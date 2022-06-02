<template>
    <Head title="Nuevo Pacientes" />

    <Layout>
        <template #header>
            Nuevo Paciente
        </template>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline h-100">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="http://clinic.test/assets/backend/default.jpg" alt="User profile picture">
                        </div>

                        <h3 class="text-center profile-username">Nombre: {{ patientForm.name }}</h3>

                        <ul class="mb-3 list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Cédula</b> <a id="txtcedula" class="float-right">{{ patientForm.document }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Teléfono</b> <a id="txttelefono" class="float-right">{{ patientForm.phone }}</a>
                            </li>
                        </ul>

                    </div>
                    <div class="pt-3 card-footer"></div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-primary h-100">
                    <div class="card-header"><h3 class="card-title">Ficha de Paciente</h3></div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-4 col-sm-12">
                                <label>Nombre del Paciente</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid' : $page.props.errors.name }" v-model="patientForm.name" placeholder="Escriba el nombre del paciente">
                                <span class="text-danger text-sm" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</span>
                            </div>

                            <div class="form-group col-lg-4 col-sm-12">
                                <label>Nombre del Padre o Tutor</label>
                                <input v-model="patientForm.tutor" type="text" class="form-control">
                            </div>

                            <div class="form-group col-lg-4 col-sm-12">
                                <label>Cédula de Identidad</label>
                                <input type="text" class="form-control" v-model="patientForm.document" placeholder="Cedula del paciente" :class="{ 'is-invalid' : $page.props.errors.document }">
                                <span class="text-danger text-sm" v-if="$page.props.errors.document">{{ $page.props.errors.document }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label>Dirección (Opcional)</label>
                                <textarea class="form-control" rows="3" placeholder="Escribe la dirección del paciente ..." v-model="patientForm.address" :class="{ 'is-invalid' : $page.props.errors.address }"></textarea>
                                <span class="text-danger text-sm" v-if="$page.props.errors.address">{{ $page.props.errors.address }}</span>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label>Observaciones (Opcional)</label>
                                <textarea class="form-control" rows="3" placeholder="Escribe las observaciones que encuentres sobre el paciente ..." v-model="patientForm.observations"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Numero de Teléfono</label>
                                <input type="text" class="form-control" v-model="patientForm.phone" placeholder="Telefono del paciente" :class="{ 'is-invalid' : $page.props.errors.phone }">
                                <span class="text-danger text-sm" v-if="$page.props.errors.phone">{{ $page.props.errors.phone }}</span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Fecha de Nacimiento:</label>
                                <div class="col-md-12">
                                    <Datepicker v-model="patientForm.birthdate" utc></Datepicker>
                                    <span class="text-danger text-sm" v-if="$page.props.errors.birthdate">{{ $page.props.errors.birthdate }}</span>
                                </div>
                            </div>

                            <div class="form-group col-lg-5">
                                <label>Sexo</label>
                                <select v-model="patientForm.gender" class="form-control select2" :class="{ 'is-invalid' : $page.props.errors.gender }">
                                    <option value="0">Hombre</option>
                                    <option value="1">Mujer</option>
                                </select>
                                <span class="text-danger text-sm" v-if="$page.props.errors.gender">{{ $page.props.errors.gender }}</span>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button @click="storePatient" class="float-right btn btn-primary">Guardar
                            <i class="ml-2 fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </Layout>

</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import { Head } from '@inertiajs/inertia-vue3'
import { DatePicker } from 'admin-lte/plugins/daterangepicker'
import { onMounted } from "vue";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import usePatient from "@/Composables/Patient";

export default {

    components: {
        Layout,
        Head,
        Datepicker
    },

    setup() {

        const { patientForm, storePatient } = usePatient();

        onMounted(() => {

            $('.select2').select2({
                width: '100%'
            });
            $('.select2').on('change',(event) => {
                patientForm.gender = event.target.value
            });
            
        });


        return {
            patientForm,
            storePatient
        }
    }
}
</script>
