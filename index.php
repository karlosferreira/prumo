<?php
  include('db.php');
  $query = "SELECT * FROM `enterprises`";
  $result = mysqli_query($db, $query);
  $customerData = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<html>
  <head>
    <title>Prumo Tecnologia</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  </head>
 
  <body>
    <div class="row m-5">
      <div class="col-md-6">
        <form action="" method="POST">
          <h5>Consulte seu CNPJ</h5>
          <p>by <a href="https://www.cluemediator.com" target="_blank">https://www.cnpj.ws/</a></p>
          <input type="text" id="cnpj" class="p-1" name="cnpj" placeholder="Infomre seu CNPJ" />
          <button type="submit" class="btn btn-primary mb-1" id="datasubmit">Submit</button>
        </form>
        <div id="result" class="m-0" style="width: 100%; padding: 7">
        </div>
      </div>
    </div>
  </body>

  <script>
    $(document).ready(function () {
      $("#datasubmit").on("click", function (e) {
        e.preventDefault();
        var cnpj = $("#cnpj").val();
        $.ajax({
          url: "ajax.php",
          type: "POST",
          data: { cnpj: cnpj },
          success: function (data) {
            $("#result").html(data);
          }
        });
      });
    })
  </script>

</html>