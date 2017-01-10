<?php get_header(); ?>

<div id="mainContent">
  <div class="pageTitle"><?php echo the_title(); ?></div>
  <div class="pageContent">
    <?php the_content(); ?>
  </div>
</div>
<div id="sidebar">
  I am a sidebar
</div>

<?php get_footer(); ?>
