$('#btnEnviar').click(function() {
    var ObjEvento = ObtenerMensaje("POST");
    EnviarMensaje('', ObjEvento);
});

function ObtenerMensaje(method) {
    Mensaje = {

        name: $('#name').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        subject: $('#subject').val(),
        message: $('#message').val(),
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': method
    }
    return (Mensaje);
}

function EnviarMensaje(accion, ObjHist) {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    $.ajax({
        type: "POST",
        url: "/Contacto/EnviarMensaje" + accion,
        data: ObjHist,
        success: function(data) {
            if (data.errors) {
                for (var count = 0; count < data.errors.length; count++) {
                    console.log(data.errors[count]);
                    toastr["error"](data.errors[count])
                }
            }

            if (data.success) {
                toastr["success"](data.success)
            }

            if (data.antispam) {
                toastr["success"](data.antispam)
            }

        },
        error: function(msg) {
            console.log(msg);
            toastr["error"]("Hubo un error al procesar la solicitud")

        }
    })


}