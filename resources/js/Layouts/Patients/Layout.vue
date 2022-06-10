<template>
    <div class="wrapper">
        <Topbar></Topbar>
        <Sidebar></Sidebar>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><slot name="header"/></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <slot name="breadcrumb"/>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <section class="content">
                    <slot/>
                </section>


            </div>

    </div>
</template>

<script>

import 'admin-lte/dist/css/adminlte.css';
import "admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
import "admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
import "admin-lte/plugins/summernote/summernote-bs4.min.css"
import "admin-lte/plugins/daterangepicker/daterangepicker.css"
import "admin-lte/plugins/jqvmap/jqvmap.min.css"

import 'admin-lte/dist/js/adminlte.min.js'
import '@fortawesome/fontawesome-free/js/all.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'
import "admin-lte/plugins/jquery/jquery.min.js"
import "admin-lte/plugins/jquery-ui/jquery-ui.min.js"


import Sidebar from "@/Layouts/Patients/Sidebar";
import Topbar from "@/Layouts/Patients/Topbar";

export default {

    components:{
        Sidebar,
        Topbar
    },

}
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback");
</style>
