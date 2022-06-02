<template>
    <div class="tab-pane fade" id="attentions" role="tabpanel" aria-labelledby="attentions-tab">
        <div class="col-12">
            <div class="table-responsive">
                <table id="appointments_table" class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID°</th>
                        <th class="text-center">Asunto</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" v-if="!attentions.length" colspan="7">No hay Atenciones registradas para este paciente</td>
                        </tr>
                        <tr v-for="(attention,index) in attentions" :key="attention.id">
                            <td class="text-center">{{ attention.code }}</td>
                            <td class="text-center">{{ attention.description ?? 'Sin descripcion' }}</td>
                            <td class="text-center">{{ attention.start_date_formatted }}</td>
                            <td class="text-center"><span :class="`badge ${attention.status_badge.badge}`">{{ attention.status_badge.label }}</span></td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Detalles de Plan de tratamiento"><i class="fas fa-credit-card"></i></button>
                                    <button type="button" class="btn btn-warning"  data-bs-toggle="tooltip" title="Editar plan de tratamiento"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-primary"  data-bs-toggle="tooltip" title="Exportar a PDF"><i class="fas fa-file-pdf"></i></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar plan de tratamiento"><i class="fas fa-times"></i></button>
                                </div>
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

        const attentions = computed(() => {
            return store.getters.getAttentions
        })


        return {
            store,
            attentions
        }
    },

}
</script>
