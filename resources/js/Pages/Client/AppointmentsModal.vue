<template>
    <!-- Modal -->
    <div class="modal fade" id="AppointmentsModal" tabindex="-1" aria-labelledby="AppointmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AppointmentsModalLabel">Nueva Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group col-12">
                                <label for="">Paciente</label>
                                <input type="text" disabled class="form-control" :value="patient.name">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="storeAppointment" type="button" class="btn btn-primary">Agendar Cita</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {useForm} from "@inertiajs/inertia-vue3";
import {computed} from "vue";
import toasts from "@/Composables/Toasts";

export default {

    props: {
        patient: {
            type: Object,
            required: true
        }
    },
    components: {
        Datepicker
    },

    setup(props){

        const AppointmentForm = useForm({
            'patient_id': props.patient.id,
            'start_date': null,
            'description': null,
            'color': '#3c8dbc'
        })

        const { success } = toasts()

        const isActive = computed(() => {
            return AppointmentForm.patient_id != null && AppointmentForm.start_date != null
        })

        const storeAppointment = () => {
            AppointmentForm.post(route('client.appointments.store'),{
                onSuccess: () => {
                    //Dismiss the modal
                    $('#AppointmentsModal').modal('hide')
                    success('Cita creada correctamente')
                },
            })
        }

        return {
            AppointmentForm,
            storeAppointment,
            isActive
        }
    }

}
</script>
