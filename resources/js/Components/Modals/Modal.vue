<template>
        <!-- Modal -->
        <div v-if="OpenClose" class="modal fade show"
             tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog"
             style="display:block">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" @click="Toggle()" class="btn-close" ></button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  @click="Toggle()" :class="'btn btn-success'" >Close</button>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
export default {
    props: {
        visible: Boolean,
    },
    data(){
        return{
            OpenClose:this.visible
        }
    },
    methods:{
        Toggle(){
            this.OpenClose =false;
        },
    },
    watch: {
        visible: function(newVal, oldVal) { // watch it
            this.OpenClose =newVal;
            console.log('new' +newVal+ '==' +oldVal)
        }
    }

}
</script>
