<?php 
  get_header();
?>
  
  <?php 
    if(have_posts()) {
      while(have_post()) {
       the_post();
       get_template_part("template-parts/content", "archive"); 
      }
    }
    ?>
  

  <?php 
    ths_posts_pagination();
  ?>
<?php 
  get_footer();
?>