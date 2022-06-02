$(document).ready(function() {



    window.onload = (function() {
        try {
            $(".anotaciones").on('keyup', function() {

            }).keyup();
        } catch (e) {}
    });





    function changeColor() {

        location.reload();
    }




    $('.agregar2').click(function() {


        //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
        var obtener = $("#form_conte").serialize();

        $.ajax({
            type: "POST",
            url: "/admin/odontograma/addrule",
            data: obtener,
            success: function(msg) {

                $idpa = $("#idpa").val();

                $('.estilos').load("stylebtn.php?id=" + $idpa);

                $('#myModal').modal('toggle');
                /* setInterval(changeColor, 1000);*/
                location.reload();




            }
        }); //Terminamos la Funcion Ajax
        return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario
    }); //Terminamos la Funcion Click



    $('.btnenviar').click(function() {


        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
        var obtener = $("#form_conte").serialize();

        $.ajax({
            type: "POST",
            url: "/admin/odontograma",
            data: obtener,
            success: function(msg) {

                Toast.fire({
                    icon: 'success',
                    title: msg.success
                })
            },

            error: function(msg) {
                console.log(msg);
                Toast.fire({
                    icon: 'error',
                    title: 'Hubo un error al procesar la solicitud'
                })
            }
        }); //Terminamos la Funcion Ajax
        return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario
    }); //Terminamos la Funcion Click






}); //Terminamos la Funcion Ready