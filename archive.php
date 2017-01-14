<?php
/*
Template Name: Archives
*/
get_header(); ?>

<div class="container">

		<?php the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php get_search_form(); ?>

		<h2>Archives by Month:</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>

		<h2>Archives by Subject:</h2>
		<ul>
			 <?php wp_list_categories(); ?>
		</ul>


</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
