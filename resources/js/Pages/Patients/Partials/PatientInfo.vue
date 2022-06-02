<template>
    <div class="card card-primary card-outline h-100">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" :src="patient.profile_photo_url"
                     alt="User profile picture">
            </div>

            <h3 class="text-center profile-username">{{ patient.name }}</h3>
            <p class="text-center text-muted">{{ patient.document }}</p>

            <ul class="mb-3 list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Codigo</b> <a class="float-right">{{ patient.code }}</a>
                </li>
                <li class="list-group-item">
                    <b>Fecha de Registro</b> <a
                    class="float-right">{{ patient.registration_date_formatted }}</a>
                </li>
                <li class="list-group-item">
                    <b>Edad</b> <a class="float-right"><span class="badge badge-info">{{ patient.age }} años</span></a>
                </li>
            </ul>

        </div>
    </div>
</template>

<script>
import { useStore } from 'vuex'
import {onMounted} from "vue";

export default {
    setup(){

        const store = useStore()
        const patient = store.state.patient

        onMounted(() => {
            console.log('Hi')
        })

        return {
            patient
        }
    }
}
</script>
