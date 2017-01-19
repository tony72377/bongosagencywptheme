<?php get_header(); ?>
<?php while ( have_posts() ) : the_post();?>
	<div class="bngs-singleImage valign-wrapper center" style="background-image:url('<?php the_post_thumbnail_url(); ?>');">
		<div class="container bngs-singleMeta">
			<h1 class="bngs-title"><?php the_title(); ?></h1>
			<div class="bngs-authorAvatar"><?php echo get_avatar(get_the_author_meta('ID'), 100); ?></div>
			<div class="bngs-postAuthor">Written by: <?php the_author(); ?></div>
		</div>
		<div class="overlay"></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="bngs-singleContent">
				<!-- Renders Content -->
				<?php the_content(); ?>
				<!-- Comment Section -->
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>
