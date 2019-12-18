$('#calculoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var datos = recipient.split(':');//Separo los datos por los :
    document.getElementById('cedula').value=recipient;
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text(datos[0])
    //modal.find('.modal-body input').val(recipient)
})

$('#editarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    //var recipient = button.data('whatever') // Extract info from data-* attributes
    //var datos = recipient.split(':');//Separo los datos por los :
    //document.getElementById('cedula').value=recipient;
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    //modal.find('.modal-title').text(datos[0])
    //modal.find('.modal-body input').val(recipient)
})

$('#resultadoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tcal = button.data('whatever')
    var recipient = document.getElementById('cedula').value;
    var datos = recipient.split(':');//Separo los datos por los :  
    if (tcal=="percentiles"){
        var perc=document.getElementById('percentil').value;
        var recipient = document.getElementById('cedulap').value;
        var datos = recipient.split(':');//Separo los datos por los : 
        dat = {calculo:tcal,ci:datos[1],percentil:perc};
    }else{
        dat = {calculo:tcal,ci:datos[1]};
    }             
    //$("#resultadoCalculo").html("respuesta");                           
    $.ajax({
        url: "view/calculos/calculos.php",
        type: "POST",
        data: dat
    }).done(function(respuesta){
        $("#resultadoCalculo").html(respuesta);
    });
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text(datos[0])
    //modal.find('.modal-body input').val(recipient)
})

$('#percentilModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var recipient = document.getElementById('cedula').value;
    var datos = recipient.split(':');//Separo los datos por los :  
    document.getElementById('cedulap').value=recipient;
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text(datos[0])
    //modal.find('.modal-body input').val(recipient)
})