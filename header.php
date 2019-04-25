<!DOCTYPE html>
<html <?php language_attributes(); $lang = explode("lang=",get_language_attributes()); ?>>
  <head>
    <title><?php echo (is_single() ? get_bloginfo('title')." - ".get_the_title() : get_bloginfo('title').' - '.get_the_title()); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="<?php echo str_replace('"','',$lang[1]); ?>" />
    <meta name="language" content="<?php echo str_replace('"','',$lang[1]); ?>" />
    <meta property="og:locale" content="<?php echo str_replace('"','',$lang[1]); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo (is_single() ? get_bloginfo('title')." - ".get_the_title() : get_bloginfo('title')); ?>" />
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
    <meta property="og:url" content="<?php echo site_url(); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo('title'); ?>" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="true">
    <?php wp_meta(); ?>
    <link rel="canonical" href="<?php echo site_url(); ?>" />
    <?php
        wp_head();
        global $post;
        $current_user = wp_get_current_user();
        $page_name = $post->ID;
    ?>
  </head>
  <body
    <?php
    if (is_front_page()) {
    echo 'class="pg-home"';
    } else if(is_author()){
    echo 'class="pg-author pg-profile pg-interna"';
    } else if(is_archive()){
    echo 'class="pg-archive pg-interna pg-'.get_queried_object()->slug.'"';
    } else if(is_category()){
    echo 'class="pg-category pg-interna pg-'.get_queried_object()->slug.'"';
    } else if(is_search()){
    echo 'class="pg-search pg-interna"';
    } else if(is_single()){
    echo 'class="pg-single pg-interna"';
    } else if(is_404()){
    echo 'class="pg-404 pg-interna"';
    } else {
    echo 'class="pg-interna pg-'.$post->post_name.' page_id_'.$post->ID.'"';
    }
    ?>>
    <div id="wrap">
    	<header>
            <?php if(get_theme_mod('endereco')||get_theme_mod('telefone')||get_theme_mod('email')||get_theme_mod('facebook')||get_theme_mod('instagram')) : ?>
            <div class="topbar">
                <div class="container">
                    <?php if(get_theme_mod('endereco')) : ?>
                        <p class="endereco"><img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/pin.png" alt="<?php echo get_theme_mod('endereco'); ?>"><?php echo get_theme_mod('endereco'); ?></p>
                    <?php endif; ?>
                    <?php if(get_theme_mod('email')) : ?>
                        <p><a href="mailto:<?php echo get_theme_mod('email'); ?>"><?php echo get_theme_mod('email'); ?></a></p>
                    <?php endif; ?>
                    <?php if(get_theme_mod('telefone')) : ?>
                        <p><?php echo get_theme_mod('telefone'); ?></p>
                    <?php endif; ?>
                    <?php if(get_theme_mod('instagram')||get_theme_mod('facebook')) : ?>
                        <ul class="socialnetworks">
                            <?php if(get_theme_mod('instagram')) : ?>
                                <li><a href="<?php echo get_theme_mod('instagram'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/instagram.png" alt="<?php echo get_theme_mod('instagram'); ?>"></a></li>
                            <?php endif; ?>
                            <?php if(get_theme_mod('facebook')) : ?>
                                <li><a href="<?php echo get_theme_mod('facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/facebook.png" alt="<?php echo get_theme_mod('facebook'); ?>" alt=""></a></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?> 
                </div>
            </div>
            <?php endif; ?>
            <div class="header">
                <div class="container">
                    <h1 class="logo">
                        <?php get_template_part('template-parts/logo'); ?>
                    </h1>
                    <form role="search" method="get" id="searchform" class="searchbar" action="<?php echo site_url(); ?>">
                      <input placeholder="O que você procura?" type="text" value="" name="s" id="s" />
                      <button id="buscar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/lupa.png" />
                      </button>
                      <input type="hidden" name="post_type" value="produtos" />
                      <input id="cat" type="hidden" name="cat" value="">
                    </form>
                </div>
            </div>
            <?php if(wp_get_nav_menu_items('header')) : ?>
                <nav class="navigation">
                        <ul>
                            <?php 
                                foreach (wp_get_nav_menu_items('header') as $key => $value) {
                                    echo '<li><a href="'.$value->url.'" title="'.$value->title.'">'.$value->title.'</a>'.( ($value->url == '#') ? '<i class="fal fa-angle-down"></i>' : '' );

                                        if($value->title == 'Nossas Marcas') : 
                                            ?>
                                            
                                            <div class="nossas-marcas">
                                                <div>
                                                    <?php 
                                                        $terms = get_terms( array( 
                                                            'taxonomy' => 'produtos_categories',
                                                            'hide_empty' => 0,
                                                            'order' => 'ASC',
                                                            'parent'   => 0
                                                        ));
                                                        if($terms) :
                                                    ?>
                                                        <ul>
                                                            <?php foreach ($terms as $term) : ?>
                                                                <li>
                                                                    <a class="ajax" data-object="<?php print_r($term); ?>" data-id="<?php echo $term->term_id; ?>" href="javascript:void(0)"><?php echo $term->name; ?></a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </div>
                                                <div id="marcas_result">
                                                    <ul>
                                                        <!--  -->
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php
                                        
                                        endif;

                                        echo '</li>';
                                }
                            ?> 
                            <li>
                                <button onclick="mobileNavigation(this)" class="hamburger hamburger--collapse" type="button">
                                  <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                  </span>
                                </button>   
                            </li>      
                        </ul>
                </nav>      
            <?php endif; ?>            
    	</header>
    	<main class="main">