<template>
    <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="archivos-tab">
        <div class="row">
            <div class="form-group col-lg-4">
                <div class="input-group">
                    <div class="custom-file">
                        <input @input="patientFile.file = $event.target.files[0]" type="file" class="custom-file-input"
                               id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar archivo</label>
                    </div>
                    <progress v-if="patientFile.progress" :value="patientFile.progress.percentage" max="100">
                        {{ patientFile.progress.percentage }}%
                    </progress>
                </div>
            </div>
            <div class="col-lg-6 form-group">
                <input v-model="patientFile.name" type="text" name="name" class="form-control"
                       placeholder="Escribe un título para este archivo">
            </div>
            <div class="form-group col-lg-2">
                <div class="input-group">
                    <button @click="uploadFile" type="submit" class="btn btn-primary btn-block">Guardar</button>
                    <div v-if="patientFile.processing" class="text-sm italic text-gray-500">Subiendo...</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">

                    <div v-if="patientFiles.length" v-for="document in patientFiles" :key="document.id"
                         class="col-lg-3 col-md-4 col-6">

                        <a v-if="document.type === 'Image'" :href="document.original_url"
                           :class="`mb-4 text-center d-block h-100`" data-toggle="lightbox" data-gallery="gallery"
                           :data-footer="document.title">
                            <img :class="`img-fluid img-thumbnail ${document.size}`" :src="document.thumbnail_url"
                                 :alt="document.title">
                            <p>{{ document.subtitle }}</p>
                        </a>


                    </div>

                    <blockquote v-else class="quote-info">
                        <h5>Información</h5>
                        <p>Aún no se han subido documents para este paciente.
                            Haz click en el recuadro de la parte superior para subir un documento para este paciente.
                            Puede ser un documento (pdf) o una imágen en formato jpg,jpeg,bmp,gif o png</p>
                    </blockquote>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import 'ekko-lightbox/dist/ekko-lightbox.min';
import 'ekko-lightbox/dist/ekko-lightbox.css';

export default {

    setup(props, {emit}) {

        const store = useStore();

        const patientFile = useForm({
            name: '',
            file: '',
            patient_id: store.getters.getPatient.id,
        })

        onMounted(() => {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        })

        const patientFiles = computed(() => {
            return store.getters.getDocuments
        })

        const uploadFile = () => {
            patientFile.post(route('patients.files'))
        }

        return {
            patientFile,
            uploadFile,
            patientFiles
        }

    }

}
</script>
