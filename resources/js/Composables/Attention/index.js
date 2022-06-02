import Swal from "sweetalert2";
import {useForm} from "@inertiajs/inertia-vue3";
import {reactive} from "vue";

export default function useAttention() {

    const attentionForm = useForm({
        patient_id: 1,
        description: "",
        start_date: "",
        price: "",
        observations: "",
        procedures: [],
        uuid: "",
    });

    const proceduresList = reactive([]);

    const fillAttention = (attention) => {
        (attentionForm.patient_id = attention.patient_id),
            (attentionForm.description = attention.description),
            (attentionForm.start_date = attention.start_date),
            (attentionForm.price = attention.unformatted_price),
            (attentionForm.observations = attention.observations),
            (attentionForm.procedures = attention.procedures),
            (attentionForm.uuid = attention.uuid);
    };

    const storeAttention = () => {
        attentionForm.procedures = proceduresList;
        Swal.fire({
            title: "¿Estas seguro?",
            text: "Revisa que toda la información este correcta",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Si, guardar!",
        }).then((result) => {
            if (result.value) {
                attentionForm.post(route("attentions.store"));
            }
        });
    };

    const updateAttention = () => {
        attentionForm.procedures = proceduresList;
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Verifica que los datos sean correctos",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, actualizar",
        }).then((result) => {
            if (result.value) {
                attentionForm.put(
                    route("attentions.update", attentionForm.uuid)
                );
            }
        });
    };

    const addProcedure = (procedure) => {
        proceduresList.push({...procedure, amount: 1, discount: 0});
    };

    const removeProcedure = (procedure) => {
        proceduresList.splice(proceduresList.indexOf(procedure), 1);
    };

    return {
        attentionForm,
        proceduresList,
        addProcedure,
        removeProcedure,
        fillAttention,
        updateAttention,
        storeAttention,
    };
}
