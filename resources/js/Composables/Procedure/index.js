import Swal from "sweetalert2";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";

export default function useProcedures() {

    const procedureForm = useForm({
        'id': '',
        'name': '',
        'price': 0.0,
    })

    const storeProcedure = () => {
        procedureForm.post(route('procedures.store'),{
            onSuccess: () => {
                $('#proceduresModal').modal('hide');
                procedureForm.reset();
            }
        })
    }

    const updateProcedure = () => {
        procedureForm.put(route('procedures.update',procedureForm.id),{
            onSuccess: () => {
                $('#proceduresEditModal').modal('hide');
                procedureForm.reset();
            }
        })
    }


    const destroyProcedure = (procedure) => {

        Swal.fire({
            title: '¿Deseas eliminar este servicio?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'

        }).then((result) => {

            if (result.value) {
                Inertia.delete(route('procedures.destroy',procedure.id),{
                    preserveScroll: true,
                    onSuccess: () => {
                        Swal.fire(
                            '¡Eliminado!',
                            'El servicio ha sido eliminado.',
                            'success'
                        )
                    },
                    onError: (error) => {
                        Swal.fire(
                            '¡Error!',
                            error.message,
                            'error'
                        )
                    }
                })
            }
        })
    }

    return {
        procedureForm,
        storeProcedure,
        updateProcedure,
        destroyProcedure
    }

}
