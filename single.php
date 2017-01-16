<?php get_header(); ?>
<?php while ( have_posts() ) : the_post();?>
	<div class="featuredImage valign-wrapper center" style="background-image:url('<?php the_post_thumbnail_url(); ?>');">
		<div class="container makeItPop">
			<h1 class="pageTitle"><?php the_title(); ?></h1>
			<div class="postAuthor">Written by: <?php the_author(); ?></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col m8 s12">
				<?php the_content(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>
			<div class="col m4 s12">
				<?php dynamic_sidebar('Blog'); ?>
			</div>
		</div>




<?php endwhile; ?>


  </div>
<?php get_footer(); ?>
