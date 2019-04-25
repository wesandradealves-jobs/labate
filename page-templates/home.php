<?php
    /**
    * Template Name: Home
    */
?>
<?php get_header(); ?>
	<?php if ( have_posts () ) : while (have_posts()) : the_post(); ?>
		<section class="destaque" style="background-image:url(<?php echo get_field('destaque')['background']; ?>)">
			<div class="container">
				<div class="filtros">
					<div class="filtro-header">
						<p>
							<strong>Faça sua busca online agora!</strong>
							<br><br>
							Produtos que atendem às necessidades específicas.
						</p>
					</div>
					<div class="filtro-footer">
						<?php 
                            $terms = get_terms( array( 
                                'taxonomy' => 'produtos_categories',
                                'hide_empty' => 0,
                                'order' => 'ASC',
                                'parent'   => 0
                            ));
                            foreach ($terms as $term) {
                            	if(get_field('filtro', $term)) :
                            	?>
                            	<span class="custom-checkbox">
                            		<input type="radio" name="produtos_categories" value="<?php echo $term->slug; ?>">
                            		<label for="<?php echo $term->slug; ?>">
                            			<?php echo $term->name; ?>
                            		</label>
                            	</span>
                            	<?php
                            	endif;
                            }
						?>
						<button id="filtrar" class="btn btn-1">Filtrar</button>
					</div>
				</div>
				<div class="mosaico">
					<?php 
						for ($i = 0; $i < 5; $i++) {
							?>
							<div class="flip-container">
								<div class="flipper">
									<?php 
										foreach (get_field('destaque')['mosaico'] as $key => $value) {
											if($key == $i){
												echo '<a class="front" href="'.$value['url'].'" style="background-image:url('.$value['imagem'].')"></a>';
												echo '<span class="back">' 
													?>
													<h3><?php echo $value['titulo']; ?></h3>
													<p><?php echo $value['descricao']; ?></p>
													<a href="<?php echo $value['url']; ?>">Saiba Mais</a>
													<?php 
												echo '</span>';
											}
										}
									?>	
								</div>
							</div>
							<?php 
						}
					?>
				</div>
			</div>
		</section>
		<section class="produtos">
			<div class="container">
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
			</div>
		</section>
	<?php endwhile;
	endif; ?>
<?php get_footer(); ?>