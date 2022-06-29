<article>
<img src="<?php the_post_thumbnail_url('thumbnail'); /* The parameter is the size defined in the wordpress settings */ ?>" alt="">
<!-- TODO Recreate the card of dalat and get the alternative texte save -->
<div>
  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <p><?php the_date(); ?></p>
  <p>
    <?php 
      the_excerpt();
    ?>
  </p>
</div>
</article>
  