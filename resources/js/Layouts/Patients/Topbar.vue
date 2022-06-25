<template>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <Link :href="route('dashboard')" class="nav-link">Home</Link>
            </li>
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ currencyLabel }}</a>
                <ul aria-labelledby="dropdownSubMenu1" class="border-0 shadow dropdown-menu">
                    <li v-for="(currency,index) in currencies" :key="index">
                        <button @click="changeCurrency(currency)" class="dropdown-item">{{ currency }}</button>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

        </ul>
    </nav>
    <!-- /.navbar -->
</template>

<script>
import {Link, usePage} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import Swal from "sweetalert2";

export default {
    components: {
        Link
    },
    setup(props){

        const currencyLabel = computed(() => {
            return usePage().props.value.currency.currency
                ? `Moneda: ${usePage().props.value.currency.currency}`
                : 'Seleccionar Moneda'
        })

        const currencies = computed(() => {
            return usePage().props.value.currency.currencies
        })

        const changeCurrency = (currency) => {
            Inertia.post(route('currency.set',currency),{},{
                onSuccess: () => {
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).fire({
                        icon: 'success',
                        title: `Moneda cambiada a ${currency}`
                    })
                }
            })
        }

        return {
            currencyLabel,
            currencies,
            changeCurrency
        }
    }
}
</script>

