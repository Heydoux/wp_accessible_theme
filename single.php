<!-- Responsible to display single page post -->
<?php
  get_header();
?>

  <div class="container">
    <div class="row">
      <div class="offset-md-3 col-md-6">
      <?php
        if (have_posts()) {
          while (have_posts()) {
            the_post();

            /* 1st param: is the file path, 2nd param: is the type */
            get_template_part('template-parts/content', 'article');
            //the_content();
          }
        }
      ?>
      </div>
      <div class="col-md-3">
        <?php 
          /* TODO Customize this sidebar register in Function*/
          dynamic_sidebar('sidebar-1');
        ?>
      </div>
    </div>
  </div>

<?php
  get_footer();
?>