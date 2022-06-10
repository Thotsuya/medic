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

    const fillValuation = (valuation) => {
            (valuationForm.patient_id = valuation.patient_id),
            (valuationForm.description = valuation.description),
            (valuationForm.start_date = valuation.start_date),
            (valuationForm.price = valuation.unformatted_price),
            (valuationForm.observations = valuation.observations),
            (valuationForm.procedures = valuation.procedures),
            (valuationForm.uuid = valuation.uuid);
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
