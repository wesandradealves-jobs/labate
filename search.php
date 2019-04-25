<?php get_header(); ?>
		<section class="content">
			<div class="container">
				<h2 class="title"><span>Nossos Produtos</span></h2>
				<ul class="produtos">
					<?php if($_GET['cat']) : 
					    $query = new WP_Query( array(
							'post_type'              => array( 'produtos' ),
							'posts_per_page' => 4,  
							'order' => 'ASC',
							'orderby' => 'name',
							'tax_query' => array(
							array(
							    'taxonomy' => 'produtos_categories',
							    'terms' => $_GET['cat'],
							    'field' => 'slug',
							    'include_children' => true,
							    'operator' => 'IN'
							)),					      
					     //  'meta_query' => array(array(
						    //     'key'     => 'mais_vendido',
						    //     'value'   => '1',
						    //     'compare' => '=',
						    //     'type'    => 'CHAR',
						    // )),
					    ) );
					    if($query->post_count) :
					        while ( $query->have_posts() ) : 
					        	$query->the_post();
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
				        endif;					    
					?>

					<?php else : ?>
					<?php if ( have_posts () ) : 
						while (have_posts()) : 
							the_post(); 
						?>
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
					<?php endwhile; 
					?>
						</ul>				
					<?php 
						else : 
							?>
							<center>
								<p>Nenhum produto encontrado.</p>
							</center>
							<?php 
					endif; ?>					
				<?php endif; ?>
				<?php if(isset($query) && !$query->post_count) : ?>
					<center>
						<p>Nenhum produto encontrado.</p>
					</center>					
				<?php endif; ?>
			</div>
		</section>
<?php get_footer(); ?>