<template>
    <div class="tab-pane fade active show" id="datos-generales" role="tabpanel" aria-labelledby="datos-generales-tab">
        <div class="row">
            <div class="form-group col-lg-4 col-sm-12">
                <label>Nombre del Paciente</label>
                <input type="text" class="form-control"
                       :class="{ 'is-invalid' : $page.props.errors.name }" v-model="patientForm.name"
                       placeholder="Escriba el nombre del paciente">
                <span class="text-danger text-sm"
                      v-if="$page.props.errors.name">{{ $page.props.errors.name }}</span>
            </div>

            <div class="form-group col-lg-4 col-sm-12">
                <label>Nombre del Padre o Tutor</label>
                <input v-model="patientForm.tutor" type="text" class="form-control">
            </div>

            <div class="form-group col-lg-4 col-sm-12">
                <label>Cédula de Identidad</label>
                <input type="text" class="form-control" v-model="patientForm.document"
                       placeholder="Cedula del paciente"
                       :class="{ 'is-invalid' : $page.props.errors.document }">
                <span class="text-danger text-sm"
                      v-if="$page.props.errors.document">{{ $page.props.errors.document }}</span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label>Dirección (Opcional)</label>
                <textarea class="form-control" rows="3"
                          placeholder="Escribe la dirección del paciente ..."
                          v-model="patientForm.address"
                          :class="{ 'is-invalid' : $page.props.errors.address }"></textarea>
                <span class="text-danger text-sm"
                      v-if="$page.props.errors.address">{{ $page.props.errors.address }}</span>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label>Observaciones (Opcional)</label>
                <textarea class="form-control" rows="3"
                          placeholder="Escribe las observaciones que encuentres sobre el paciente ..."
                          v-model="patientForm.observations"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4">
                <label>Numero de Teléfono</label>
                <input type="text" class="form-control" v-model="patientForm.phone"
                       placeholder="Telefono del paciente"
                       :class="{ 'is-invalid' : $page.props.errors.phone }">
                <span class="text-danger text-sm"
                      v-if="$page.props.errors.phone">{{ $page.props.errors.phone }}</span>
            </div>

            <div class="form-group col-lg-3">
                <label>Fecha de Nacimiento:</label>
                <div class="col-md-12">
                    <Datepicker v-model="patientForm.birthdate" utc/>
                    <span class="text-danger text-sm"
                          v-if="$page.props.errors.birthdate">{{ $page.props.errors.birthdate }}
                                            </span>
                </div>
            </div>

            <div class="form-group col-lg-5">
                <label>Sexo</label>
                <select v-model="patientForm.gender" class="form-control select2"
                        :class="{ 'is-invalid' : $page.props.errors.gender }">
                    <option value="0">Hombre</option>
                    <option value="1">Mujer</option>
                </select>
                <span class="text-danger text-sm"
                      v-if="$page.props.errors.gender">{{ $page.props.errors.gender }}</span>
            </div>

        </div>
    </div>
</template>

<script>
import {onMounted} from "vue";
import {useForm} from '@inertiajs/inertia-vue3'
import {useStore} from 'vuex'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {

    components: {
        Datepicker
    },

    setup(){
        const patientForm = useForm({
            name: '',
            tutor: '',
            document: '',
            address: '',
            observations: '',
            phone: '',
            birthdate: '',
            gender: ''

        });

        const store = useStore();

        onMounted(() => {

            patientForm.name = store.getters.getPatient.name
            patientForm.tutor = store.getters.getPatient.tutor
            patientForm.document = store.getters.getPatient.document
            patientForm.address = store.getters.getPatient.address
            patientForm.observations = store.getters.getPatient.observations
            patientForm.phone = store.getters.getPatient.phone
            patientForm.birthdate = store.getters.getPatient.birthdate
            patientForm.gender = store.getters.getPatient.gender


            $('.select2').select2({
                width: '100%',
            });

            $('.select2').on('change', (event) => {
                patientForm.gender = event.target.value
            });

            $('.select2').select2("val", `${patientForm.gender}`);


        });

        const updatePatient = () => {
            patientForm.put(route('patients.update',store.state.patient.uuid))
        }

        return {
            patientForm,
            updatePatient
        }

    }
}
</script>
