$(document).ready(function () {
  mostrarClientes();
});

// MOSTRAR CLIENTES
function mostrarClientes() {
  var mostrarclientes = "true";
  $.ajax({
    url: "./procesos/mostrarCli.php",
    type: "post",
    data: {
      mostrar: mostrarclientes,
    },
    success: function (data) {
      $("#registros").html(data);
    },
  });
}

// agregar clientes
function agregarCliente(e) {
  //limpiar modal
  $("#modalNewCliente").on("show.bs.modal", function (event) {
    $("#modalNewClient input").val("");
  });
  var dni = $("#dniCliente").val();
  var apellido = $("#apellidoCliente").val();
  var nombre = $("#nombreCliente").val();
  var plan = $("#planCliente").val();
  if (dni == "") {
    setTimeout(function () {
      $("#alertDniC")
        .html("<span style='color:red;'>* Debe ingresar un dni</span>")
        .fadeOut(6000);
    }, 1000);
    $("#alertDniC").focus();
    return false;
  } else if (apellido == "") {
    setTimeout(function () {
      $("#alertApellidoC")
        .html(
          "<span style='color:red;'>* Debe elegir ingresar un apellido</span>"
        )
        .fadeOut(6000);
    }, 1000);
    $("#alertApellidoC").focus();
    return false;
  } else if (nombre == "") {
    setTimeout(function () {
      $("#alertNombreC")
        .html("<span style='color:red;'>* Debe ingresar un nombre</span>")
        .fadeOut(6000);
    }, 1000);
    $("#alertNombreC").focus();
    return false;
  } else if (plan == "") {
    setTimeout(function () {
      $("#alertPlanC")
        .html("<span style='color:red;'>* Debe elegir un plan</span>")
        .fadeOut(6000);
    }, 1000);
    $("#alertPlanC").focus();
    return false;
  } else {
    $.ajax({
      url: "./procesos/subirCliente.php",
      type: "post",
      data: {
        dniC: dni,
        apellidoC: apellido,
        nombreC: nombre,
        planC: plan,
      },
      success: function (data) {
        console.log(data);
        $("#modalNewClient").modal("hide");
        mostrarClientes();
      },
    });
  }
}

function si_no_delete(id) {
  alertify.confirm(
    "Eliminar cliente",
    "¿Esta seguro que quiere eliminar este cliente? " + id,
    function () {
      eliminarCliente(id);
    },
    function () {
      alertify.error("Cancelado");
    }
  );
}

// eliminar producto
function eliminarCliente(idClienteD) {
  $("#idclienteDelete").val(idClienteD);
  $.post(
    "./procesos/eliminarCliente.php",
    { idClienteD: idClienteD },
    function (data, status) {
      // console.log(idProducto, data);
      mostrarClientes();
    }
  );
}
