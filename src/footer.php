<?php function the_footer(){ ?>

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
<?php } ?>