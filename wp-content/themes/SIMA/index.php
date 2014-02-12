<?php get_header(); ?>
<body>
<div id=pagecontainer>
		<div id=header>
			<div id=logo><a href="<?php echo home_url(); ?>"><img src="<?bloginfo('template_url')?>/images/logo.png"/ border=0px;></a></div>
			<div id=search>
				<?php get_search_form(); ?>
			</div>
		</div>
		<div id=navigation_wrapper>
			<div id="navigation" class="clearfix">
	            <?php
	            wp_nav_menu( array(
	                'theme_location'	=> 'menu',
	                'sort_column'		=> 'menu_order',
	                'menu_class'		=> 'sf-menu',
	                'fallback_cb'		=> 'default_menu'
	            ) ); ?>
	        </div>
        </div>
        <?if (is_home()){?>
			<div id=content_features>
				<? include_once 'features.php';?>
			</div>
		<?}?>
		<div id=container>
			<div id=main>
			<? if (is_home()){
					if ( $last_news->have_posts() ) {?>
							<? 
							while ( $last_news->have_posts() ) {
								$last_news->the_post();?>
								<li class=post_content>
									<? if ( has_post_thumbnail() ) {?>
										<div class=thumb>
											<?the_post_thumbnail('post');?>
											<div class=clear></div>
										</div>
									<?} ?>
									<a href="<?the_permalink()?>">
										<div class=post_title><? the_title() ?><br><span class=post_date>Pubblicato il <?echo get_the_date('d F Y');?></span></div>
										<div  class=post_excerpt>
											<?php
											  $excerpt = get_the_excerpt();
											  echo cut($excerpt,30);
											?>
										</div>
										<?//if( function_exists( do_sociable() ) ){ do_sociable(); } ?>
										
									</a>
								</li>
							<? }
					}
				}
				elseif (is_page()) {
					get_template_part( 'content', 'page' );
				}
				elseif (is_single()){
					get_template_part( 'content', 'single' );
				}
				elseif (is_search()){
					get_template_part( 'content', 'search' );
				}
				elseif (is_category()){
					get_template_part( 'content', 'category' );
				}
				elseif (is_archive()){
					get_template_part( 'content', 'archive' );
				}
				?>
			</div>
			<div id=sidebar_container>
				<?dynamic_sidebar( 'Sidebar' );?>
			</div>
		</div>
	<?php get_footer(); ?>
</div>
</body>