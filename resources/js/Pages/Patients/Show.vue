<template>
    <Head title="Detalles de Paciente"/>

    <Layout>
        <template #header>
            Detalles Paciente
        </template>

        <div class="row">
            <div class="col-md-3">
                <PatientInfo/>
            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline card-tabs h-100">
                    <PatientTabs/>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <General ref="generalTab"/>
                            <Archivos/>
                            <Notes/>
                            <Timeline :timelines="timelines" />
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button @click="updatePatient" class="float-right btn btn-primary">Guardar
                            <i class="ml-2 fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <InfoTabs/>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <AppointmentsTable/>
                            <AttentionsTable/>
                            <PaymentsTable/>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </Layout>

</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Head} from '@inertiajs/inertia-vue3'
import {onUpdated,onBeforeMount,ref} from "vue";
import { useStore } from 'vuex'

import AppointmentsTable from "@/Components/Patients/AppointmentsTable";
import General from "@/Pages/Patients/Partials/General";
import Archivos from "@/Pages/Patients/Partials/Archivos";
import Notes from "@/Pages/Patients/Partials/Notes";
import Timeline from "@/Pages/Patients/Partials/Timeline";
import PatientTabs from "@/Pages/Patients/Partials/PatientTabs";
import PatientInfo from "@/Pages/Patients/Partials/PatientInfo";
import InfoTabs from "@/Pages/Patients/Partials/InfoTabs";
import AttentionsTable from "@/Components/Patients/AttentionsTable";
import PaymentsTable from "@/Components/Patients/PaymentsTable";


export default {

    props: {
        patient: {
            type: Object,
            required: true
        },
        timelines: {
            type: Object,
            required: true
        },
    },

    components: {
        PaymentsTable,
        InfoTabs,
        PatientInfo,
        PatientTabs,
        General,
        Archivos,
        Timeline,
        Notes,
        Layout,
        Head,
        AppointmentsTable,
        AttentionsTable,
    },

    setup(props) {

        const store = useStore();
        const generalTab = ref(null)

        onBeforeMount(() => {
            refetchPatient()
        });

        onUpdated(() =>{
            refetchPatient();
        })

        const refetchPatient = () => {
            store.commit('SET_PATIENT', props.patient.data);
            store.commit('SET_PAYMENTS', props.patient.payments)
        }

        const updatePatient = () => {
            generalTab.value.updatePatient()
        }

        return {
            updatePatient,
            generalTab
        }
    }
}
</script>

<style>
.select2-container .select2-selection--single {
    height: calc(2.25rem + 2px);
}
</style>
