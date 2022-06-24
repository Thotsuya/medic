<template>
    <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">

        <div class="row bg-light">
            <div class="col-12">
                <div class="timeline">

                    <template v-for="(day,index) in Object.keys(timelines.data)" :key="index">
                        <div class="time-label">
                            <span class="bg-red">{{ day }}</span>
                        </div>

                        <div v-for="(timeline,index) in timelines.data[day]" :key="index" v-html="timeline.content">
                        </div>

                    </template>

                    <div>
                        <i class="fas fa-clock bg-gray fa-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="pt-4 col-12 d-flex justify-content-center">
                <Pagination :links="timelines.links"></Pagination>
            </div>
        </div>

    </div>
</template>

<script>
import Pagination from "@/Components/Pagination";

export default {
    props: {
        timelines: {
            type: Object,
            required: true,
            default: {}
        }
    },

    components: {
        Pagination
    },



}
</script>

<style>
.timeline-item{
    margin-left: 72px !important;
}
</style>
