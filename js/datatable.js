$(document).ready(function () {

    console.log("DATATABLE OK");

    if (!$('#tablaPlatos').length) {
        console.log("No existe la tabla");
        return;
    }

    $('#tablaPlatos').DataTable({
        pageLength: 10,
        searching: true,
        paging: true,
        info: true
    });

});



