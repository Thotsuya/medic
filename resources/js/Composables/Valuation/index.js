import Swal from "sweetalert2";
import {useForm} from "@inertiajs/inertia-vue3";
import {reactive} from "vue";

export default function useValuation() {

    const valuationForm = useForm({
        patient_id: 1,
        description: "",
        start_date: "",
        price: "",
        observations: "",
        procedures: [],
        uuid: "",
    });

    const proceduresList = reactive([]);

    const fillValuation = (attention) => {
            (valuationForm.patient_id = attention.patient_id),
            (valuationForm.description = attention.description),
            (valuationForm.start_date = attention.start_date),
            (valuationForm.price = attention.unformatted_price),
            (valuationForm.observations = attention.observations),
            (valuationForm.procedures = attention.procedures),
            (valuationForm.uuid = attention.uuid);
    };

    const storeValuation = () => {
        valuationForm.procedures = proceduresList;

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
                valuationForm.post(route("valuations.store"));
            }
        });


    };

    const updateValuation = () => {
        valuationForm.procedures = proceduresList;
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
                valuationForm.put(
                    route("valuations.update", valuationForm.uuid)
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
        valuationForm,
        proceduresList,
        addProcedure,
        removeProcedure,
        fillValuation,
        updateValuation,
        storeValuation,
    };
}
