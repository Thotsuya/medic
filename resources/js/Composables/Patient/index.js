import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

export default function usePatient(){

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

    function storePatient() {
        return Inertia.post(route('patients.store'),patientForm,{
            onSuccess: () => {}
        })
    }

    return {
        patientForm,
        storePatient
    }

}
