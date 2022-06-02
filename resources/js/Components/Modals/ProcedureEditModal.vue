<template>
    <!-- Modal -->
    <div class="modal fade" id="proceduresEditModal" tabindex="-1" aria-labelledby="proceduresEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proceduresEditModalLabel">Editar Servicio</h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Servicio</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid' : procedureForm.errors.name }" id="name" v-model="procedureForm.name">
                                <span class="text-danger text-sm" v-if="procedureForm.errors.name">{{ procedureForm.errors.name }}</span>
                            </div>
                            <div class="form-group">
                                <label for="price">Precio {{ currencyLabel }}</label>
                                <input type="number" step="any" id="price" class="form-control" v-model="procedureForm.price" :class="{ 'is-invalid' : procedureForm.errors.price }">
                                <span class="text-danger text-sm" v-if="procedureForm.errors.price">{{ procedureForm.errors.price }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateProcedure">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {onMounted} from "vue";
import {useStore} from 'vuex';

import useCurrency from "@/Composables/Currency";
import useProcedures from "@/Composables/Procedure";

export default {

    setup(){

        const store = useStore();

        const { currencyLabel } = useCurrency();
        const { procedureForm,updateProcedure } = useProcedures();



        onMounted(() => {
            $('#proceduresEditModal').on('show.bs.modal', function (event) {
                procedureForm.reset();
                procedureForm.id = store.getters.getProcedure.id;
                procedureForm.name = store.getters.getProcedure.name;
                procedureForm.price = store.getters.getProcedure.unformatted_price;
            })
        })
        


        return {
            procedureForm,
            currencyLabel,
            updateProcedure
        }
    }

}
</script>
