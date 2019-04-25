<?php get_header(); ?>
	<?php if ( have_posts () ) : while (have_posts()) : the_post(); ?>
		<section class="banner" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_page_by_path('noticias')->ID), 'full'); ?>)">
			<div class="container">
				<h2><?php the_title(); ?></h2>
				<ul class="breadcrumbs">
					<li><a title="Início" href="<?php echo site_url(); ?>">Início</a></li>
					<li><a href="<?php echo get_page_by_path('noticias')->guid; ?>">Notícias</a></li>
					<li><a href="javascript:void(0)" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></li>
				</ul>
			</div>
		</section>
		<section class="content">
			<div class="container">
				<?php
					the_content();
				?>
			</div>
		</section>		
	<?php endwhile;
	endif; ?>
<?php get_footer(); ?>