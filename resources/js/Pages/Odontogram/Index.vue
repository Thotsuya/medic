<template>
    <Layout>
        <Head :title="'Odontograma'"></Head>

        <template #header>Odontograma</template>

        <div class="row" id="content">

            <div class="col-12">
                <div class="card-body">
                    <div class="sbox table-responsive" v-html="odontograma.canvar">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <textarea class="form-control anotaciones" rows="12" placeholder="Anotaciones"
                                  name="anotaciones" v-model="tratamientoodontoform.anotaciones">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-6 table-responsive" >
                <div class="card card-primary card-outline">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="reglas" v-html="tratamientoodonto.boton">
                        </div>

                        <div class="col-md-6">
                            <div class="btn btn-success" data-toggle="modal" data-target="#myModal" id="propiedades">Propiedades</div>
                            <div class="diente btn btn-info" id="borrar">Borrar</div><br><br>
                        </div>

<!--                        <div class="col-md-12">-->
<!--                            <div class="btn btn-danger" id="cero">X</div>-->
<!--                            <div class="btn btn-primary" id="cero3" >X</div>-->
<!--                            <div class="btn btn-danger" id="cero5">⌂</div>-->
<!--                            <div class="btn btn-primary" id="cero7">⌂</div>-->
<!--                            <div class="btn btn-danger" id="cero9">○</div>-->
<!--                            <div class="btn btn-primary" id="cero11">○</div>-->
<!--                            <div class="btn btn-default" id="cero13">○</div>-->
<!--                            <div class="btn btn-default" id="cero15">=</div>-->
<!--                            <div class="btn btn-primary" id="cero17">=</div>-->
<!--                            <div class="btn btn-default" id="cero19">│</div>-->
<!--                            <div class="btn btn-primary" id="cero21">│</div>-->
<!--                            <div class="btn btn-danger" id="cero23">S</div>-->
<!--                            <div class="btn btn-primary" id="cero25">S</div>-->
<!--                            <div class="btn btn-default" id="cero27">S</div>-->

<!--                            <div style="visibility: hidden;" class="clasecero diente" id="cero2"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero3 diente" id="cero4"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero5 diente" id="cero6"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero7 diente" id="cero8"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero9 diente" id="cero10"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero11 diente" id="cero12"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero13 diente" id="cero14"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero15 diente" id="cero16"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero17 diente" id="cero18"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero19 diente" id="cero20"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero21 diente" id="cero22"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero23 diente" id="cero24"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero25 diente" id="cero26"></div>-->
<!--                            <div style="visibility: hidden;" class="clasecero27 diente" id="cero28"></div>-->
<!--                        </div>-->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>


        </div>

        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <button @click="updateOdontogram" type="button" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Propiedades</h4>
                    </div>

                    <div class="row">
                        <div class="modal-body col-md-4" >

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext1">
                            <input v-model="tratamientoodontoform.classbtn1" name="classb1" class="jscolor {onFineChange:'update1(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext2">
                            <input v-model="tratamientoodontoform.classbtn2" name="classb2" class="jscolor {onFineChange:'update2(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext3">
                            <input v-model="tratamientoodontoform.classbtn3" name="classb3" class="jscolor {onFineChange:'update3(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext4">
                            <input v-model="tratamientoodontoform.classbtn4" name="classb4" class="jscolor {onFineChange:'update4(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext5">
                            <input v-model="tratamientoodontoform.classbtn5" name="classb5" class="jscolor {onFineChange:'update5(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext6">
                            <input v-model="tratamientoodontoform.classbtn6" name="classb6" class="jscolor {onFineChange:'update6(this)'}" style="width: 70px;" >

                        </div>
                        <div class="modal-body col-md-4">

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext7">
                            <input v-model="tratamientoodontoform.classbtn7" name="classb7" class="jscolor {onFineChange:'update7(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext8">
                            <input v-model="tratamientoodontoform.classbtn8" name="classb8" class="jscolor {onFineChange:'update8(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext9">
                            <input v-model="tratamientoodontoform.classbtn9" name="classb9" class="jscolor {onFineChange:'update9(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext10">
                            <input v-model="tratamientoodontoform.classbtn10" name="classb10" class="jscolor {onFineChange:'update10(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext11">
                            <input v-model="tratamientoodontoform.classbtn11" name="classb11" class="jscolor {onFineChange:'update11(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext12">
                            <input v-model="tratamientoodontoform.classbtn12" name="classb12" class="jscolor {onFineChange:'update12(this)'}" style="width: 70px;" >


                        </div>
                        <div class="modal-body col-md-4">


                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext13">
                            <input v-model="tratamientoodontoform.classbtn13" name="classb13" class="jscolor {onFineChange:'update13(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext14">
                            <input v-model="tratamientoodontoform.classbtn14" name="classb14" class="jscolor {onFineChange:'update14(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext15">
                            <input v-model="tratamientoodontoform.classbtn15" name="classb15" class="jscolor {onFineChange:'update15(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext16">
                            <input v-model="tratamientoodontoform.classbtn16" name="classb16" class="jscolor {onFineChange:'update16(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext17">
                            <input v-model="tratamientoodontoform.classbtn17" name="classb17" class="jscolor {onFineChange:'update17(this)'}" style="width: 70px;" >

                            <br>
                            <br>

                            <input type="text" name="" class="form-control" placeholder="Tratamiento" id="ctext18">
                            <input v-model="tratamientoodontoform.classbtn18" name="classb18" class="jscolor {onFineChange:'update18(this)'}" style="width: 70px;" >



                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary agregar2" data-dismiss="modal" id="cerrar">Guardar Cambios</button>
                    </div>
                </div>

            </div>
        </div>



    </Layout>
</template>

<script>
import Layout from "@/Layouts/Admin/Layout";
import {Head, Link} from '@inertiajs/inertia-vue3';
import {onMounted} from "vue";
import {Modal} from 'bootstrap'

import './assets/jscolor.js'
import './odontogram.js'
import useOdontogram from "@/Pages/Odontogram/odontogramInitialize";

export default {

    components: {
        Layout,
        Link,
        Head
    },

    props: {
        patient: {
            type: Object,
            required: true
        },
        odontograma: {
            type: Object,
            required: true
        },
        tratamientoodonto: {
            type: Object,
            required: true
        },

    },

    setup(props){

        const { initialize,tratamientoodontoform,teethmap,updateOdontogram } = useOdontogram(props.patient.uuid);

        onMounted(() => {

            initialize();
            if(props.patient.is_adult){
                document.getElementById('child-1').style.display = 'none';
                document.getElementById('child-2').style.display = 'none';
                document.getElementById('child-3').style.display = 'none';
                document.getElementById('child-4').style.display = 'none';
            }else{
                console.log('es niño');
                document.getElementById('adult-1').style.display = 'none';
                document.getElementById('adult-2').style.display = 'none';
                document.getElementById('adult-3').style.display = 'none';
                document.getElementById('adult-4').style.display = 'none';
            }


            new Modal(document.getElementById('myModal'));
            // remove # from classbtn prop value
            console.log('Mounted')
            tratamientoodontoform.anotaciones = props.tratamientoodonto.nombtrata
            tratamientoodontoform.classbtn1 = props.tratamientoodonto.classbtn1.replace('#', '');
            tratamientoodontoform.classbtn2 = props.tratamientoodonto.classbtn2.replace('#', '');
            tratamientoodontoform.classbtn3 = props.tratamientoodonto.classbtn3.replace('#', '');
            tratamientoodontoform.classbtn4 = props.tratamientoodonto.classbtn4.replace('#', '');
            tratamientoodontoform.classbtn5 = props.tratamientoodonto.classbtn5.replace('#', '');
            tratamientoodontoform.classbtn6 = props.tratamientoodonto.classbtn6.replace('#', '');
            tratamientoodontoform.classbtn7 = props.tratamientoodonto.classbtn7.replace('#', '');
            tratamientoodontoform.classbtn8 = props.tratamientoodonto.classbtn8.replace('#', '');
            tratamientoodontoform.classbtn9 = props.tratamientoodonto.classbtn9.replace('#', '');
            tratamientoodontoform.classbtn10 = props.tratamientoodonto.classbtn10.replace('#', '');
            tratamientoodontoform.classbtn11 = props.tratamientoodonto.classbtn11.replace('#', '');
            tratamientoodontoform.classbtn12 = props.tratamientoodonto.classbtn12.replace('#', '');
            tratamientoodontoform.classbtn13 = props.tratamientoodonto.classbtn13.replace('#', '');
            tratamientoodontoform.classbtn14 = props.tratamientoodonto.classbtn14.replace('#', '');
            tratamientoodontoform.classbtn15 = props.tratamientoodonto.classbtn15.replace('#', '');
            tratamientoodontoform.classbtn16 = props.tratamientoodonto.classbtn16.replace('#', '');
            tratamientoodontoform.classbtn17 = props.tratamientoodonto.classbtn17.replace('#', '');
            tratamientoodontoform.classbtn18 = props.tratamientoodonto.classbtn18.replace('#', '');
            tratamientoodontoform.idpaciente = props.patient.uuid

            teethmap.canvar = props.odontograma.canvar
            teethmap.uuid = props.patient.uuid
            teethmap.patient_id = props.odontograma.patient_id

        })

        return {
            tratamientoodontoform,
            updateOdontogram,
        }
    }

}
</script>

<style>
.desabilitado {
    fill: black;
    stroke: black;
    stroke-width: 1px;
    opacity: 0.3;
}

.marcadoAzul {
    fill: none;
    stroke: blue;
    stroke-width: 7px;
}

.marcadoVerde {
    fill: green;
    stroke: black;
    stroke-width: 1px;
}

.marcadoMorado {
    fill: #CC66CC;
    stroke: black;
    stroke-width: 1px;
}

.marcadoMarron {
    fill: #CC6600;
    stroke: black;
    stroke-width: 1px;
}

.marcadoAmarillo {
    fill: yellow;
    stroke: black;
    stroke-width: 1px;
}

.marcadoRojo {
    fill: red;
    stroke: black;
    stroke-width: 1px;
}

.marcadoNaranja {
    fill: orange;
    stroke: black;
    stroke-width: 1px;
}

.diente {
    fill-opacity: 0;
    stroke: black;
    stroke-width: 1px;

}

.marcadoTomate {
    fill: tomato;
    stroke: black;
    stroke-width: 1px;
}

.clasecero {
    background-image: url('./assets/x2.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;
}

.clasecero3 {
    background-image: url('./assets/x3.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;
}

.clasecero5 {
    background-image: url('./assets/x4.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;
}

.clasecero7 {
    background-image: url('./assets/x5.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}


.clasecero9 {
    background-image: url('./assets/x6.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}


.clasecero11 {
    background-image: url('./assets/x7.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}


.clasecero13 {
    background-image: url('./assets/x8.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}

.clasecero15 {
    background-image: url('./assets/x9.png');
    background-position: right bottom;
    background-repeat: no-repeat;

    background-size: 42px;

}


.clasecero17 {
    background-image: url('./assets/x10.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}

.clasecero19 {
    background-image: url('./assets/x11.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}


.clasecero21 {
    background-image: url('./assets/x12.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}

.clasecero23 {
    background-image: url('./assets/x13.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}


.clasecero25 {
    background-image: url('./assets/x14.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}


.clasecero27 {
    background-image: url('./assets/x15.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: 42px;

}

.btn0{
    background-color: v-bind(tratamientoodonto.classbtn1);
    fill: v-bind(tratamientoodonto.classbtn1);
}

.btn1{
    background-color: v-bind(tratamientoodonto.classbtn2);
    fill: v-bind(tratamientoodonto.classbtn2);
}

.btn2{
    background-color: v-bind(tratamientoodonto.classbtn3);
    fill: v-bind(tratamientoodonto.classbtn3);
}

.btn3{
    background-color: v-bind(tratamientoodonto.classbtn4);
    fill: v-bind(tratamientoodonto.classbtn4);
}

.btn4{
    background-color: v-bind(tratamientoodonto.classbtn5);
    fill: v-bind(tratamientoodonto.classbtn5);
}

.btn5 {
    background-color: v-bind(tratamientoodonto.classbtn6);
    fill: v-bind(tratamientoodonto.classbtn6);
}

.btn6{
    background-color: v-bind(tratamientoodonto.classbtn7);
    fill: v-bind(tratamientoodonto.classbtn7);
}

.btn7{
    background-color: v-bind(tratamientoodonto.classbtn8);
    fill: v-bind(tratamientoodonto.classbtn8);
}

.btn8{
    background-color: v-bind(tratamientoodonto.classbtn9);
    fill: v-bind(tratamientoodonto.classbtn9);
}

.btn9{
    background-color: v-bind(tratamientoodonto.classbtn10);
    fill: v-bind(tratamientoodonto.classbtn10);
}

.btn10{
    background-color: v-bind(tratamientoodonto.classbtn11);
    fill: v-bind(tratamientoodonto.classbtn11);
}

.btn11{
    background-color: v-bind(tratamientoodonto.classbtn12);
    fill: v-bind(tratamientoodonto.classbtn12);
}

.btn12{
    background-color: v-bind(tratamientoodonto.classbtn13);
    fill: v-bind(tratamientoodonto.classbtn13);
}

.btn13{
    background-color: v-bind(tratamientoodonto.classbtn14);
    fill: v-bind(tratamientoodonto.classbtn14);
}

.btn14{
    background-color: v-bind(tratamientoodonto.classbtn15);
    fill: v-bind(tratamientoodonto.classbtn15);
}

.btn15{
    background-color: v-bind(tratamientoodonto.classbtn16);
    fill: v-bind(tratamientoodonto.classbtn16);
}

.btn16{
    background-color: v-bind(tratamientoodonto.classbtn17);
    fill: v-bind(tratamientoodonto.classbtn17);
}

.btn17{
    background-color: v-bind(tratamientoodonto.classbtn18);
    fill: v-bind(tratamientoodonto.classbtn18);
}


</style>
