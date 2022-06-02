<template>

    <Head :title="'Citas'"></Head>

    <Layout>
        <template #header>
            Citas
        </template>


        <div class="container-fluid">
            <div class="row">

                <div class="col-xl-3">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            Crear Cita
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group col-12">
                                        <label for="">Paciente</label>
                                        <select class="form-control select2" v-model="AppointmentForm.patient_id">
                                            <option value="">Seleccione un paciente</option>
                                            <option v-for="patient in patients" :value="patient.id">{{ patient.name }}</option>
                                        </select>
                                        <span v-if="$page.props.errors.patient_id" class="text-danger text-sm">El paciente es obligatorio</span>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="">Fecha de la Cita</label>
                                        <Datepicker v-model="AppointmentForm.start_date" utc :is24="false"></Datepicker>
                                        <span v-if="$page.props.errors.start_date" class="text-danger text-sm">La fecha de la cita es obligatoria</span>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="">Descripcion</label>
                                        <textarea class="form-control" v-model="AppointmentForm.description" rows="3" placeholder="Descripcion de la cita"/>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="">Color</label>
                                        <input type="color" class="form-control" v-model="AppointmentForm.color" />
                                    </div>

                                    <div class="col-12">
                                        <button :disabled="!isActive || AppointmentForm.processing" class="btn btn-primary btn-block" @click="storeAppointment"><i class="fas fa-save mr-2"></i> Crear Cita</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-9">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <FullCalendar ref="calendar" :options="calendarOptions" />
                        </div>
                    </div>

                </div>



            </div>
        </div>

    </Layout>

    <div ref="exampleModal" class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de la Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Paciente:</dt>
                                    <dd class="col-sm-8">{{ patientForm.patient.name }}</dd>
                                    <dt class="col-sm-4">Fecha de la Cita:</dt>
                                    <dd  class="col-sm-8">{{ patientForm.date }}</dd>
                                    <dt class="col-sm-4">Hora de la Cita:</dt>
                                    <dd  class="col-sm-8">{{ patientForm.time }}</dd>
                                    <dt class="col-sm-4">Agendada por:</dt>
                                    <dd  class="col-sm-8">{{ patientForm.user.name }}</dd>
                                    <dt class="col-sm-4">Motivo:</dt>
                                    <dd  class="col-sm-8">{{ patientForm.description }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="cancelAppointment" class="btn btn-danger">Cancelar Cita</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import { Head } from '@inertiajs/inertia-vue3'
import { onMounted } from 'vue'

import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'

import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import { computed,ref } from "vue";
import { Modal } from 'bootstrap'

import useAppointment from "@/Composables/Appointment";

export default {

    components: {
        Layout,
        FullCalendar,
        Head,
        Datepicker,
    },

    props: {
        patients: {
            type: Array,
            default: () => []
        },
        appointments: {
            type: Array,
            default: () => []
        }
    },

    setup(props) {

        const exampleModal = ref(null)
        const { patientForm,AppointmentForm,cancelAppointment,storeAppointment } = useAppointment();

        const isActive = computed(() => {
            return AppointmentForm.patient_id != null && AppointmentForm.start_date != null
        })

        const calendarOptions = computed(() => {
            return {
                plugins: [ dayGridPlugin, interactionPlugin,timeGridPlugin ],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: props.appointments,
                eventClick: (info) => {
                    patientForm.id = info.event._def.publicId
                    patientForm.patient = info.event._def.extendedProps.patient
                    patientForm.date = info.event._def.extendedProps.formatted_date
                    patientForm.time = info.event._def.extendedProps.formatted_time
                    patientForm.description = info.event._def.extendedProps.description
                    patientForm.user = info.event._def.extendedProps.user
                    $('#exampleModal').modal('show')
                }
            }
        })

        onMounted(() => {


            $('.select2').select2({
                width: '100%'
            });

            $('.select2').on('change',(event) => {
                AppointmentForm.patient_id = event.target.value
            });


        })

        return {
            calendarOptions,
            AppointmentForm,
            isActive,
            storeAppointment,
            exampleModal,
            patientForm,
            cancelAppointment
        }
    }


}
</script>
