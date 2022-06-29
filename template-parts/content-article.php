<div>
  <nav aria-label="breadcrumb" class="">
    
  </nav>

  <!-- TAGS --> 
  <div class="d-flex">
    <?php the_tags(); /* TODO can contain 3 parameters, what come before the tags / between each tags / at the end of the tags */?>
  </div>

  <!-- TITLE -->
  <h1></h1>

  <!-- Author picture - Author Name | date | reading time -->
  <div class="d-flex">
    <?php the_author_posts_link(); ?>
    <span>|</span>
    <?php the_date(''); /* TODO find the parameter to format the date as we want dd month year*/?>
    <span>|</span>
    <span><?php /* TODO Temps de lecture */?></span>
  </div>

  <?php 
    the_content();
  ?>

  <!-- Add -->
  <div id="comments">
    <?php comments_template(); /* TODO Display this section if comment allow and there is more than one */ ?>
  </div>
</div>