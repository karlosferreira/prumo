<?php
  include('db.php');
?>

<html>
  <head>
    <title>Prumo Tecnologia</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8-mb4">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/jquery.mask.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  </head>
 
  <style>
    #result {
      padding: 0!important;
      margin: 0!important;
    }
    #result p {
      margin: 0;
      padding: 7px 14px;
    }
    .warning {
      background: yellow;
      color: #000;
    }
    .error {
      background: red;
      color: #fff;
    }
    .info {
      background: blue;
      color: #fff;
    }
  </style>

  <body>
    <div class="row m-5">
      <div class="col-md-6">
        <form action="" method="POST">
          <h4>Consulte seu CNPJ</h4>
          <p>by <a href="https://www.cluemediator.com" target="_blank">https://www.cnpj.ws/</a></p>
          <input type="text" id="cnpj" class="p-1" name="cnpj" placeholder="Infomre seu CNPJ" />
          <button type="submit" class="btn btn-primary mb-1" id="datasubmit">Consultar</button>
        </form>
        <div id="result" class="m-0" style="width: 100%; padding: 7"></div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        $('#cnpj').mask('00.000.000/0000-00');

        $("#datasubmit").on("click", function (e) {
          e.preventDefault();
          
          $("#result").html('');
          $(this).html('Aguarde...');

          var cnpj = $("#cnpj").val();
          
          $.ajax({
            url: "ajax.php",
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