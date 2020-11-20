function send_data() {
  $(document).ready(function () {
    $('#btnguardar').click(function () {
      var parameters = new FormData($("#form"[0]))
      $.ajax({
        type: "POST",
        url: "frm_data.php",
        data: parameters,
        contentType: false,
        processData: false,
        success: function (reply_query) {
          if (reply_query == 1) {
            alert("agregado con exito");
          } else {
            alert("Fallo el server.");
          }
        }
      });

      return false;
    });
  });
}