<template>
    <div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
        <div class="col-12">
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
                        <th class="text-center">Acciones</th>
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
                            <td class="text-center">
                                <div v-if="!appointment.deleted_at"  class="btn-group" role="group" aria-label="Basic example">
                                    <button @click="markAsCancelled(appointment)" class="btn btn-sm btn-outline-danger" :disabled="appointment.status === 1">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button @click="markAsAttended(appointment)"  :disabled="appointment.status === 1" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>

                                <button v-else @click="restoreAppointment(appointment)" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-undo"></i>
                                </button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { useStore } from 'vuex'
import { computed } from "vue";
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2';

export default {

    setup(){
        const store = useStore()

        const appointments = computed(() => {
            return store.getters.getAppointments
        })

        const restoreAppointment = (appointment) => {
            Swal.fire({
                title: '¿Deseas restaurar esta cita?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, restaurar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    Inertia.put(route('appointments.restore', appointment.id),{},{
                        onSuccess: () => {
                            Swal.fire(
                                'Restaurado!',
                                'La cita ha sido restaurada',
                                'success'
                            )
                        },
                        preserveScroll: true
                    })
                }
            })
        }

        const markAsCancelled = (appointment) => {
            Swal.fire({
                title: '¿Estas seguro que deseas cancelar esta cita?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, cancelar'
            }).then((result) => {
                if (result.value) {
                    Inertia.delete(route('appointments.destroy', appointment),{
                        onSuccess: () => {
                            Swal.fire(
                                'Cancelado',
                                'La cita ha sido cancelada',
                                'success'
                            )
                        },
                        preserveScroll: true
                    })
                }
            })
        }

        const markAsAttended = (appointment) => {
            Swal.fire({
                title: '¿Deseas marcar esta cita como atendida?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, marcar como atendida'
            }).then((result) => {
                if (result.value) {
                    Inertia.put(route('appointments.status', appointment),{},{
                        onSuccess: () => {
                            Swal.fire(
                                'Marcado como atendido',
                                'La cita ha sido marcada como atendida',
                                'success'
                            )
                        },
                        preserveScroll: true
                    })
                }
            })
        }

        return {
            store,
            appointments,
            markAsAttended,
            markAsCancelled,
            restoreAppointment
        }
    },

}
</script>
