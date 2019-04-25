<?php get_header(); ?>
	<?php if ( have_posts () ) : while (have_posts()) : the_post(); ?>
		<section class="banner" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full'); ?>)">
			<div class="container">
				<h2><?php the_title(); ?></h2>
				<ul class="breadcrumbs">
					<li><a title="Início" href="<?php echo site_url(); ?>">Início</a></li>
					<li><a href="javascript:void(0)" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></li>
				</ul>
			</div>
		</section>
		<section class="content">
			<div class="container">
				<?php
					if($post->post_name=='noticias') {
				?>
					<ul class="blog">
					<?php 
				        $query_args = array(
				            'post_type' => 'post',
				            'posts_per_page' => -1,
				            'order' => 'DESC',
				            'order_by' => 'name'
				        );
				        $query = new WP_Query( $query_args );
				        while ( $query->have_posts() ) : $query->the_post();
				        	?>
				        	<!--  -->
				        	<li onclick="document.location='<?php echo get_the_permalink(); ?>';return false;">
				        		<div>
				        			<small>
										<?php 
											echo ( (get_field('fonte')) ? '<a href="'.get_field('fonte')['url'].'">'.get_field('fonte')['titulo'].'</a>' : '' ).get_the_date();
										?>
				        			</small>
				        			<h3><?php echo get_the_title(); ?></h3>
				        			<p>
				        				<?php echo substr(get_the_content(), 0, 400).'...' ?>
				        			</p>
				        		</div>
				        	</li>
				        	<?php
				        endwhile;
				        wp_reset_query();
				        wp_reset_postdata();                     	
					?>
					</ul>
				<?php 
					} elseif($post->post_name=='produtos') {
				?>
					<h2 class="title"><span>Nossos Produtos</span></h2>
					<ul class="produtos">
					<?php 
				        $query_args = array(
				            'post_type' => 'produtos',
				            'posts_per_page' => -1,
				            'order' => 'ASC',
				            'order_by' => 'name'
				        );
				        $query = new WP_Query( $query_args );
				        while ( $query->have_posts() ) : $query->the_post();
				        	?>
				        	<!--  -->
				        	<li>
				        		<div class="thumbnail" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full'); ?>)"></div>
				        		<h3><?php echo get_the_title(); ?> <a  href="javascript:void(0)" class="btn btn-1">Saiba Mais +</a></h3>
				        		<!-- panel -->
				        		<div class="panel">
				        			<div class="thumbnail" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full'); ?>)"></div>
				        			<div>
				        				<a class="close" href="javascript:void(0)"><i class="fal fa-close"></i></a>
				        				<h4><?php echo get_the_title(); ?></h4>
				        				<h5><?php echo get_the_excerpt(); ?></h5>
				        				<?php if(get_field('onde_comprar')) : ?>
				            				<p><strong>Onde comprar:</strong><br/><br/></p>
				            				<p>
				                				<?php 
				                					foreach (get_field('onde_comprar') as $value) {
				                						?>
				                						<a href="<?php echo $value['url'] ?>">
				                							<?php if($value['imagem']): ?>
				                								<img src="<?php echo $value['imagem'] ?>" />
				                							<?php else : ?>
				                								<?php echo $value['texto']; ?>
				                							<?php endif; ?>
				                						</a>
				                						<br/>
				                						<?php 
				                					}
				                				?>
				            				</p>
				            				<br/>
				            			<?php endif; ?>
				        				<?php the_content(); ?>
				        			</div>
				        		</div>
				        	</li>
				        	<?php
				        endwhile;
				        wp_reset_query();
				        wp_reset_postdata();                     	
					?>
					</ul>
				<?php
					} else {
						the_content();
					}
				?>
			</div>
		</section>
	<?php endwhile;
	endif; ?>
<?php get_footer(); ?>