<?php get_header(); ?>
<?php while ( have_posts() ) : the_post();?>
	<div class="bngs-singleImage valign-wrapper center" style="background-image:url('<?php the_post_thumbnail_url(); ?>');">
		<div class="container bngs-singleMeta">
			<h1 class="bngs-title"><?php the_title(); ?></h1>
		</div>
		<div class="overlay"></div>
	</div>
	<div class="row">
		<div class="container">
			<h4>Their Problem</h4>
			<?php $clientName = get_post_meta($post->ID, "_client_name", false); echo $clientName[0];  ?>
	</div>	
		<div class="row">
		<div class="container">
			<h4>About the Project</h4>
			<?php $description = get_post_meta($post->ID, "_description", false); echo $description[0];  ?>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<h4>Their Problem</h4>
			<?php echo get_post_meta($post->ID, "_problem", true); ?>			</div>
	</div>
	<div class="row">
		<div class="container">
			<h4>How we Helped</h4>
			<?php echo get_post_meta($post->ID, "_solution", true); ?>			</div>
	</div>

<?php endwhile; ?>
<?php get_footer(); ?>
