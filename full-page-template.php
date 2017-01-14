<?php
/* Template Name: full-page-template */
?>

<?php get_header(); ?>


<?php
while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
 <div class="content">
     <?php the_content(); ?>
 </div>
<?php
endwhile;
?>
<?php get_footer(); ?>
