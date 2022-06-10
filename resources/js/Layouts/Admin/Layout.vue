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
                    <AlertSuccess v-if="$page.props.flash.message"/>
                    <slot/>
                </section>


            </div>

    </div>
</template>

<script>

import 'admin-lte/dist/css/adminlte.min.css';
import "admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
import "admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
import "admin-lte/plugins/summernote/summernote-bs4.min.css"
import "admin-lte/plugins/daterangepicker/daterangepicker.css"
import "admin-lte/plugins/jqvmap/jqvmap.min.css"
import "admin-lte/plugins/select2/css/select2.min.css"

import 'admin-lte/dist/js/adminlte.min.js'
import '@fortawesome/fontawesome-free/js/all.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'
import "admin-lte/plugins/jquery/jquery.min.js"
import "admin-lte/plugins/jquery-ui/jquery-ui.min.js"
import "admin-lte/plugins/daterangepicker/daterangepicker.js"
import "admin-lte/plugins/select2/js/select2.full.min.js"
import $ from 'jquery'


import Sidebar from "@/Layouts/Admin/Sidebar";
import Topbar from "@/Layouts/Admin/Topbar";
import AlertSuccess from "@/Components/Alert/AlertSuccess";
import {onMounted} from "vue";

export default {

    components:{
        Sidebar,
        Topbar,
        AlertSuccess,
    },

    setup(){
        onMounted(() => {
            $('[data-widget="pushmenu"]').click(function () {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $("body").removeClass("sidebar-toggled");
                    $(".sidebar").removeClass("toggled");
                } else {
                    $(this).addClass("active");
                    $("body").addClass("sidebar-toggled");
                    $(".sidebar").addClass("toggled");
                }
            });
        })
    }


}
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback");
.select2-container .select2-selection--single {
    height: calc(2.25rem + 2px);
}
</style>
