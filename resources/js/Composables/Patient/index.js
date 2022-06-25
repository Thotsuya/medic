import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import toasts from "@/Composables/Toasts";

export default function usePatient() {

    const patientForm = reactive({
        name: '',
        tutor: '',
        document: '',
        phone: '',
        address: '',
        observations: '',
        gender: '',
        birthdate: ''
    })

    const {success, prompt} = toasts();

    function storePatient() {
        return Inertia.post(route('patients.store'), patientForm, {
            onSuccess: () => {
            }
        })
    }

    const deletePatient = async (patient) => {
        await prompt('Dar de baja al paciente?', 'Esta acción no se puede deshacer')
            .then((result) => {
                if(result.isConfirmed){
                    Inertia.delete(route('patients.destroy', patient), {
                        preserveScroll: true,
                        onSuccess: () => {
                            success('Paciente dado de baja correctamente')
                        }
                    })
                }
            });
    }

    return {
        patientForm,
        storePatient,
        deletePatient
    }

}
