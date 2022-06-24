import {useForm, usePage} from "@inertiajs/inertia-vue3";
import {useStore} from "vuex";
import toasts from "@/Composables/Toasts";

export default function useNotes() {

    const page = usePage();
    const {success, error, prompt} = toasts();

    const notesForm = useForm({
        'patient_id': useStore().getters.getPatient.id,
        'content': '<p>Hello World!</p>'
    })

    const storeNote = () => {
        notesForm.post(route('notes.store'), {
            onSuccess: () => {
                success('Nota creada correctamente')
            },
        })
    }

    const deleteNote = () => {

    }

    return {
        notesForm,
        storeNote,
        deleteNote
    }

}

