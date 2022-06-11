import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import Swal from "sweetalert2";

export default function useUsers() {

    const userForm = useForm({
        uuid: '',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role_id: 2,
    })

    const createUser = () => {
        userForm.post(route('users.store'))
    }

    const fillUserForm = (user) => {
        userForm.uuid = user.uuid
        userForm.name = user.name
        userForm.email = user.email
        userForm.role_id = user.roles[0].id
    }

    const updateUser = () => {
        userForm.put(route('users.update', userForm.uuid))
    }

    const deleteUser = (user) => {
        Swal.fire({
            title: 'Estas seguro?',
            text: "No podras revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminarlo!'
        }).then(result => {
            if(result.isConfirmed){
                Inertia.delete(route('users.destroy',user))
            }
        })
    }

    return {
        userForm,
        fillUserForm,
        updateUser,
        createUser,
        deleteUser
    }
}

