<template>
    <div class="p-0 pt-1 card-header border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                   href="#datos-generales" role="tab" aria-controls="datos-generales"
                   aria-selected="false">
                    <i class="mr-2 fas fa-user-alt"></i>
                    Datos del Paciente
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#archivos"
                   role="tab" aria-controls="archivos" aria-selected="false">
                    <i class="mr-2 fas fa-x-ray"></i>
                    Archivos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-notes-tab" data-toggle="pill"
                   href="#notes" role="tab" aria-controls="notes" aria-selected="true"><i
                    class="mr-2 fas fa-notes-medical"></i>Notas</a>
            </li>

<!--            <li class="nav-item">-->
<!--                <a class="nav-link" id="custom-tabs-three-notes-tab" data-toggle="pill" href="#history"-->
<!--                   role="tab" aria-controls="history" aria-selected="false"><i-->
<!--                    class="mr-2 fas fa-user-md"></i>Historia Clínica</a>-->
<!--            </li>-->

            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-timeline-tab" data-toggle="pill" href="#timeline"
                   role="tab" aria-controls="timeline" aria-selected="false"><i
                    class="mr-2 far fa-clock"></i>Historial</a>
            </li>

        </ul>
    </div>
</template>

<script>
export default {
    name: "PatientTabs"
}
</script>
