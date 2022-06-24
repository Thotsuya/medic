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
                    <button @click="storeNote" type="button" class="btn btn-block btn-primary"><i class="mr-2 fas fa-save"></i>Guardar
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" v-if="notes.length" v-for="note in notes" :key="note.id">
                <blockquote>
                    <p v-html="note.content"></p>
                    <small v-html="note.footer_text"></small>
                </blockquote>

            </div>
            <blockquote v-else class="quote-info">
                <h5>Información</h5>
                <p>Aún no se guardado notas para este paciente
                    Puedes escribir una nota para este paciente en el cuadro de texto de la parte superior</p>
            </blockquote>
        </div>

    </div>
</template>

<script>
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {QuillEditor} from '@vueup/vue-quill'
import useNotes from "@/Composables/Notes";
import {computed} from "vue";
import {useStore} from "vuex";

export default {

    components: {
        QuillEditor
    },

    setup() {

        const store = useStore();
        const { notesForm,storeNote } = useNotes()

        const notes = computed(() => {
            return store.getters.getPatient.notes
        })

        return {
            notesForm,
            notes,
            storeNote
        }

    }
}
</script>
