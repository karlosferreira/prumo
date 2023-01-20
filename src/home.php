<?php 
  include_once('src/header.php');
  include_once('src/form.php');
  include_once('src/footer.php');
?>

<?php the_header(); ?>

<div class="row m-5">
  <div class="col-md-6">
    <?php the_form(); ?>
    <div id="result" class="m-0 result-box"></div>
  </div>
</div>

<?php the_footer(); ?>