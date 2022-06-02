$(document).on('click','.view',function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "/admin/contacts/" + id,
        dataType: "json",
        success: function(response) {
            $('#name').html(response.data.name)
            $('#phone').html(response.data.phone)
            $('#email').html(response.data.email)
            $('#date').html(response.data.date)
            $('#message').html(response.data.message)
            $('#infoEvent').modal('show')
        }
    })
})