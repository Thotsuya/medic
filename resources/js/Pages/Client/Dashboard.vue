<template>
    <Head title="Dashboard"/>

    <Layout>

        <template #header>
            Dashboard
        </template>

        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ appointments.filter((appointment) => appointment.is_today).length }}</h3>
                        <p>Citas de Hoy</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Ver Citas <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ appointments.length }}</h3>
                        <p>Citas Registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Ver Citas <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ attentions.length }}</h3>

                        <p>Planes de Tratamiento</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Ver Todos <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <!--                       <h3>{{ dashboard.pending_contacts }}</h3>-->
                        <h3>{{ valuations.length }}</h3>

                        <p>Cotizaciones</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Ver Cotizaciones <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt"></i>
                            Mis Citas
                        </h3>
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#AppointmentsModal">
                            Solicitar una cita
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="appointments_table" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-center">Agendada Por</th>
                                    <th class="text-center">Motivo</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Hora</th>
                                    <th class="text-center">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center" v-if="!appointments.length" colspan="7">No hay citas registradas para este paciente</td>
                                </tr>
                                <tr v-for="(appointment,index) in appointments" :key="appointment.id">
                                    <td class="text-center">{{ index + 1 }}</td>
                                    <td class="text-center">{{ appointment.user.name }}</td>
                                    <td class="text-center">{{ appointment.description ?? 'Sin descripcion' }}</td>
                                    <td class="text-center">{{ appointment.formatted_date }}</td>
                                    <td class="text-center">{{ appointment.formatted_time }}</td>
                                    <td class="text-center" v-html="appointment.status_badge"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mis Planes de Tratamiento</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Asunto</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-if="attentions.length" v-for="(attention,index) in attentions"
                                    :key="attention.id">
                                    <td class="text-center">{{ attention.code }}</td>
                                    <td class="text-center">{{ attention.description }}</td>
                                    <td class="text-center"><span :class="`badge ${attention.status_badge.badge}`">{{
                                            attention.status_badge.label
                                        }}</span></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <Link :href="route('client.attentions.show',attention)" type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Detalles de Plan de tratamiento"><i class="fas fa-credit-card"></i></Link>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="5" class="text-center">No hay tratamientos registrados | No se
                                        encontraron registros
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                    </div>


                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mis cotizaciones</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Asunto</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-if="valuations.length" v-for="(valuation,index) in valuations" :key="valuation.id">
                                    <td class="text-center">{{ valuation.code }}</td>
                                    <td>{{ valuation.description }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <Link :href="route('client.valuations.show',valuation.uuid)" type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Detalles de Plan de tratamiento"><i class="fas fa-credit-card"></i></Link>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="5" class="text-center">No hay tratamientos registrados | No se encontraron registros</td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <AppointmentsModal :patient="patient"/>

    </Layout>
</template>

<script>
import Layout from "@/Layouts/Patients/Layout";
import {Head} from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import AppointmentsModal from "@/Pages/Client/AppointmentsModal";
import {onMounted} from "vue";
import { Modal } from 'bootstrap'

export default {
    props: {
        patient: {
            type: Object,
            required: true
        },
        attentions: {
            type: Array,
            required: true
        },
        valuations: {
            type: Array,
            required: true
        },
        appointments: {
            type: Array,
            required: true
        }
    },
    components: {Layout, Head, Link,AppointmentsModal},

    setup(props){
        onMounted(()=> {
            new Modal(document.getElementById('AppointmentsModal'));
        })
    }
}

</script>
