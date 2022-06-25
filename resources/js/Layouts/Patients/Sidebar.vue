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
                    <img src="https://ui-avatars.com/api/?name=Barbara+Gaines&color=7F9CF5&background=EBF4FF" class="img-circle elevation-2" alt="User Image">
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
                        <Link :href="route('client.dashboard')" class="nav-link" :class="{ active : route().current('client.dashboard') }">
                            <img src="../Admin/icons/increase.svg" alt="" class="nav-icon">
                            <p>Dashboard</p>
                        </Link>
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
    },
}
</script>
