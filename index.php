<?php
  include('db.php');
  include_once('src/form.php');
?>

<html>
  <head>
    <title>Prumo Tecnologia</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8-mb4">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/assets/css/style.css">
  </head>

  <body>
    <div class="row m-5">
      <div class="col-md-6">
        <?php the_form(); ?>
        <div id="result" class="m-0 result-box"></div>
      </div>
    </div>

    <script src="src/assets/js/jquery.min.js"></script>
    <script src="src/assets/js/jquery.mask.min.js"></script> 

    <script>
      $(document).ready(function () {
        $('#cnpj').mask('00.000.000/0000-00');

        $("#datasubmit").on("click", function (e) {
          e.preventDefault();
          
          $("#result").html('');
          $(this).html('Aguarde...');

          var cnpj = $("#cnpj").val();
          
          $.ajax({
            url: "src/ajax.php",
            type: "POST",
            data: { cnpj: cnpj },
            success: function (data) {
              $("#datasubmit").html('Consultar');
              $("#result").html(data);
            }
          });
        });
      });
    </script>
    
  </body>
</html>