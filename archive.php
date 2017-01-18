<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col m9 sm12">
    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
       <!-- Display the Title as a link to the Post's permalink. -->
      <div class="card">
      <div class="card-image waves-effect waves-block waves-light">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'full', array( 'class' => 'responsive-img') ); ?>
        </a>
      </div>
      <div class="card-content">
        <div class="card-title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </div>
        <div>
          <small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>
          <small class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></small>
        </div>
        <div><?php the_excerpt(); ?></div>
        <div>
          <a class="waves-effect waves-light btn blogBtn" href="<?php the_permalink(); ?>">Read More</a>
        </div>
      </div>
      </div>
     	<!-- Stop The Loop (but note the "else:" - see next line). -->
    <?php endwhile; else : ?>
 	    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
 	    <!-- REALLY stop The Loop. -->
    <?php endif; ?>
  </div>
  <div class="sidebar col m3 sm12">
    <?php dynamic_sidebar('Blog'); ?>
  </div>
  </div>
  <?php materialize_pagination(); ?>
</div>

<?php get_footer(); ?>
