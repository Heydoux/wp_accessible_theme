<!-- When there is no specific template for a page this one will be used -->
<?php 
  get_header();
?>
  <article>
  <?php 
    if(have_posts()) {
      while(have_post()) {
       the_post();
       get_template_part("template-parts/content", "archive"); 
      }
    }
    ?>
  </article>

<?php 
  get_footer();
?>