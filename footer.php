	</main>
	<footer>
		<div class="shortcuts">
			<div class="container">
				<div>
					<h2>Linha Infantil</h2>
					<?php 
					    $query = new WP_Query( array(
							'post_type'              => array( 'produtos' ),
							'posts_per_page' => 4,  
							'order' => 'ASC',
							'orderby' => 'name',
							'tax_query' => array(
							array(
							    'taxonomy' => 'produtos_categories',
							    'terms' => 'linha-infantil',
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
					    if($query) :
					    	?>
					    	<ul>
					    	<?php 
					    	while ( $query->have_posts() ) : $query->the_post();
					    		?>
					    		<li><a title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
					    		<?php 
					    	endwhile;
					    	?>
					    	</ul>
					    	<?php
					    endif;
	                    wp_reset_query();
	                    wp_reset_postdata(); 
					?>					
				</div>
				<div>
					<h2>Linha Adulto</h2>
					<?php 
					    $query = new WP_Query( array(
							'post_type'              => array( 'produtos' ),
							'posts_per_page' => 4,  
							'order' => 'ASC',
							'orderby' => 'name',
							'tax_query' => array(
							array(
							    'taxonomy' => 'produtos_categories',
							    'terms' => 'linha-adulto',
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
					    if($query) :
					    	?>
					    	<ul>
					    	<?php 
					    	while ( $query->have_posts() ) : $query->the_post();
					    		?>
					    		<li><a title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
					    		<?php 
					    	endwhile;
					    	?>
					    	</ul>
					    	<?php
					    endif;
	                    wp_reset_query();
	                    wp_reset_postdata(); 
					?>							
				</div>
				<div>
					<h2>Newsletter</h2>
					<p>Cadastre-se para novidades e ofertas especiais da LABATE COSMÉTICOS</p>
					<?php 
					    echo do_shortcode('[wpshout_frontend_post]');
					?>					
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
	          <p><?php echo "&#x24B8; Copyright ".date('Y')." - Labate - Todos os direitos reservados."; ?></p>
	          <p>
	            <a class="stamps" href="http://www.system-dreams.com.br" target="_blank" title="System Dreams - Criação e Otimização de Sites">Developed by SD</a>
	            <a class="stamps" href="javascript:void(0)" title="W3C | HTML5">W3C | HTML5</a>
	          </p>				
			</div>
		</div>		
	</footer>
</div>
<?php wp_footer(); ?>
<script>
	$(document).ready(function () {
	    $( ".ajax" ).click(function() {
	        $.ajax({
	            type: 'POST',
	            async: true,
	            url: '<?php echo get_template_directory_uri(); ?>/functions/marcas.php',
	            data: { 'id' : $(this).attr('data-id') },
	            datatype: 'json',
	            cache: true,
	            global: false,
	            beforeSend: function() { 
	                $('#marcas_result').children('ul').addClass('loading').empty();
	            },
	            success: function(data) {
	                if(!$.parseJSON(data).Empty){
	                	$('#marcas_result').children('ul').append($.parseJSON(data).Menu),
	                	$('#marcas_result').children('ul');
	                } else {
	                	console.log($.parseJSON(data));
	                }
	            },
	            complete: function() { 
	                $('#marcas_result').children('ul').removeClass('loading');                
	            }
	        });           
	    }); 
    });	
</script>
</body>
</html>