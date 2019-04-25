<?php
	require_once("../../../../wp-load.php");

	$term_object = get_term($_POST['id'], 'produtos_categories');

	$menu = array();

	if(get_field('categoria_relacionada', $term_object)){
		foreach (get_field('categoria_relacionada', $term_object) as $key => $value) {
			array_push($menu, '<li><a style="background-image:url('.get_field('thumbnail', $value).')" href="'.get_term_link($value->term_id).'">'.$value->name.'</a></li>');
		}
		print_r(
			json_encode( 
				array(
					'Term Object'=>$term_object,
					'Marcas'=>(get_field('categoria_relacionada', $term_object)) ? get_field('categoria_relacionada', $term_object) : '',
					'Menu'=>(!empty($menu)) ? $menu : ''
				) 
			)
		);		
	} else {
		print_r(
			json_encode( 
				array(
					'Empty'=>1
				) 
			)
		);	
	}

    


