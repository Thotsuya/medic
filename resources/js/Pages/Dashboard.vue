<template>
    <Head title="Dashboard" />

    <Layout>

        <template #header>
            Dashboard
        </template>

       <div class="row">
           <div class="col-lg-3 col-6">
               <!-- small card -->
               <div class="small-box bg-warning">
                   <div class="inner">
                       <h3>{{ dashboard.patients_count }}</h3>
                       <p>Pacientes registrados</p>
                   </div>
                   <div class="icon">
                       <i class="fas fa-users"></i>
                   </div>
                   <Link :href="route('patients.index')" class="small-box-footer">
                       Ver Todos <i class="fas fa-arrow-circle-right"></i>
                   </Link>
               </div>
           </div>

           <div class="col-lg-3 col-6">
               <!-- small card -->
               <div class="small-box bg-info">
                   <div class="inner">
                       <h3>{{ dashboard.today_appointments_count }}</h3>
                       <p>Citas de Hoy</p>
                   </div>
                   <div class="icon">
                       <i class="fas fa-calendar"></i>
                   </div>
                   <Link :href="route('appointments.index')" class="small-box-footer">
                       Ver Citas <i class="fas fa-arrow-circle-right"></i>
                   </Link>
               </div>
           </div>

           <div class="col-lg-3 col-6">
               <!-- small card -->
               <div class="small-box bg-danger">
                   <div class="inner">
                       <h3>{{ dashboard.attentions }}</h3>

                       <p>Planes de Tratamiento</p>
                   </div>
                   <div class="icon">
                       <i class="fas fa-user-md"></i>
                   </div>
                   <Link :href="route('attentions.index')" class="small-box-footer">
                       Ver Todos <i class="fas fa-arrow-circle-right"></i>
                   </Link>
               </div>
           </div>

           <div class="col-lg-3 col-6">
               <!-- small card -->
               <div class="small-box bg-success">
                   <div class="inner">
<!--                       <h3>{{ dashboard.pending_contacts }}</h3>-->
                       <h3>0</h3>

                       <p>Solicitudes de Contacto</p>
                   </div>
                   <div class="icon">
                       <i class="fas fa-address-book"></i>
                   </div>
                   <Link :href="route('patients.index')" class="small-box-footer">
                       Ver Solicitudes <i class="fas fa-arrow-circle-right"></i>
                   </Link>
               </div>
           </div>

       </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h5 class="card-title">Citas de Hoy</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm">
                                <thead class="table-dark">
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-center">Paciente</th>
                                    <th class="text-center">Motivo</th>
                                    <th class="text-center">Hora</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="dashboard.today_appointments.length" v-for="(appointment,index) in dashboard.today_appointments" :key="appointment.id">
                                    <td class="text-center">{{ index + 1 }}</td>
                                    <td class="text-center">
                                        <Link v-if="appointment.patient" :href="route('patients.show',appointment.patient.uuid)" class="text-dark">
                                            {{ appointment.patient.name }}
                                        </Link>
                                        <span class="text-dark">
                                            {{ appointment.title }}
                                        </span>
                                    </td>
                                    <td>{{ appointment.description }}</td>
                                    <td class="text-center">{{ appointment.time }}</td>
                                </tr>
                                <tr v-else>
                                    <td class="text-center" colspan="4">No hay citas pendientes para hoy</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import { Link,Head } from '@inertiajs/inertia-vue3'

export default {

    props: {
      dashboard: {
        type: Object,
        required: true
      }
    },

    components: {Layout, Head,Link}
}

</script>
