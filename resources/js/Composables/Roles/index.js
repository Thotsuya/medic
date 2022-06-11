import {useForm} from "@inertiajs/inertia-vue3";

export default function useRoles(){

    const roleForm = useForm({
        id: null,
        name: '',
        permissions: []
    })

    const fillRoleForm = (role) => {
        roleForm.id = role.id
        roleForm.name = role.name
        roleForm.permissions = role.permissions.map(permission => permission.id)
    }

    const storeRole = () => {
        roleForm.post(route('roles.store'))
    }

    const updateRole = () => {
        roleForm.put(route('roles.update',roleForm.id))
    }

    return {
        roleForm,
        fillRoleForm,
        storeRole,
        updateRole
    }



}
