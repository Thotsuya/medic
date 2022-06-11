<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="text-center brand-link">
            <span class="brand-text font-weight-light">Clinica</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="$page.props.auth.user.user_image" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $page.props.auth.user.name }}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <Link :href="route('dashboard')" class="nav-link" :class="{ active : route().current('dashboard') }">
                            <img src="./icons/increase.svg" alt="" class="nav-icon">
                            <p>Dashboard</p>
                        </Link>
                    </li>

                    <li class="nav-item" :class="{ 'menu-open' : route().current('users.*') || route().current('roles.*') }">
                        <a href="#" class="nav-link" :class="{ 'active' : route().current('users.*') || route().current('roles.*') }">
                            <img src="./icons/team.svg" alt="" class="nav-icon">
                            <p>
                                Gestión de Usuarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <Link :href="route('users.index')" class="nav-link" :class="{ 'active' : route().current('users.*') }">
                                    <img src="./icons/team2.svg" alt="" class="nav-icon">
                                    <p>
                                        Usuarios
                                    </p>
                                </Link>
                            </li>

                            <li class="nav-item">
                                <Link :href="route('roles.index')" class="nav-link" :class="{ 'active' : route().current('roles.*') }">
                                    <img src="./icons/user.svg" alt="" class="nav-icon">
                                    <p>
                                        Roles
                                    </p>
                                </Link>
                            </li>


                        </ul>
                    </li>

                    <li class="nav-item">
                        <Link :href="route('patients.index')"  class="nav-link" :class="{ active : route().current('patients.*') }">
                            <img src="./icons/patient.svg" alt="" class="nav-icon">
                            <p>Pacientes</p>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link :href="route('appointments.index')"  class="nav-link" :class="{ active : route().current('appointments.*') }">
                            <img src="./icons/appointment.svg" alt="" class="nav-icon">
                            <p>Citas</p>
                        </Link>
                    </li>

                    <li class="nav-item" :class="{ 'menu-open' : route().current('procedures.*') || route().current('attentions.*') || route().current('valuations.*') }">
                        <a href="#" class="nav-link" :class="{ 'active' : route().current('procedures.*') || route().current('attentions.*') || route().current('valuations.*') }">
                            <img src="./icons/dentist-chair.svg" alt="" class="nav-icon">
                            <p>
                                Clínica
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <Link :href="route('procedures.index')" class="nav-link" :class="{ 'active' : route().current('procedures.*') }">
                                    <img src="./icons/dentistry.svg" alt="" class="nav-icon">
                                    <p>
                                        Servicios
                                    </p>
                                </Link>
                            </li>

                            <li class="nav-item">
                                <Link :href="route('attentions.index')" class="nav-link" :class="{ 'active' : route().current('attentions.*') }">
                                    <img src="./icons/dentist-chair2.svg" alt="" class="nav-icon">
                                    <p>
                                        Atenciones
                                    </p>
                                </Link>
                            </li>

                            <li class="nav-item">
                                <Link :href="route('valuations.index')" class="nav-link" :class="{ 'active' : route().current('valuations.*') }">
                                    <img src="./icons/braces.svg" alt="" class="nav-icon">
                                    <p>
                                        Presupuestos
                                    </p>
                                </Link>
                            </li>




                        </ul>
                    </li>



                    <li class="nav-item">
                        <Link :href="route('logout')" method="post" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>Cerrar Sesion</p>
                        </Link>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'

export default {
    components:{
        Link
    }

}
</script>
