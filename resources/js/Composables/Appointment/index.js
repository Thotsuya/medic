import {useForm} from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

export default function useAppointment(){

    const patientForm = useForm({
        'id': '',
        'patient': [],
        'date': null,
        'time': null,
        'doctor': null,
        'description': null,
        'user': []
    })

    const AppointmentForm = useForm({
        'patient_id': null,
        'start_date': null,
        'description': null,
        'color': '#3c8dbc'
    })

    const storeAppointment = () => {
        AppointmentForm.post(route('appointments.store'),{
            preserveScroll: true,
            onSuccess: () => { AppointmentForm.reset() },
        })
    }

    const cancelAppointment = async () => {
        Swal.fire({
            title: '¿Estás seguro que deseas cancelar esta cita?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar!'
        }).then((result) => {
            if(result.value){
                patientForm.delete(route('appointments.destroy',patientForm.id),{
                    onSuccess: () => {
                        Swal.fire(
                            'Cancelado!',
                            'La cita ha sido cancelada.',
                            'success'
                        )
                    },
                    preserveScroll: true
                })
            }
        })
    }

    return {
        AppointmentForm,
        patientForm,
        storeAppointment,
        cancelAppointment
    }

}
