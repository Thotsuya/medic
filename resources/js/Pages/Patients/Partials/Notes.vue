<template>
    <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
        <div class="row">
            <div class="form-group col-12 h-100">
                <label>Notas Clínicas</label>
                <QuillEditor v-model:content="notesForm.content" contentType="html" theme="snow" />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="float-right">
                    <button type="button" class="btn btn-block btn-primary"><i class="mr-2 fas fa-save"></i>Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {QuillEditor} from '@vueup/vue-quill'
import {useForm} from "@inertiajs/inertia-vue3";
import {useStore} from 'vuex'

export default {

    components: {
        QuillEditor
    },

    setup() {
        const notesForm = useForm({
            'patient_id': useStore().getters.getPatient.id,
            'content': '<p>Hello World!</p>'
        })

        const storeNote = () => {
            // notesForm.post(route('patients.notes'))
        }

        const deleteNote = () => {
            // notesForm.delete(route('patients.notes'))
        }


        return {
            notesForm
        }
    }
}
</script>
