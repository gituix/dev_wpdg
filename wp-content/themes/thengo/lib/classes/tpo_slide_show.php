<?php
class tpo_display_slideshow{
	var $slideshowLoop;
	var $slideEffectsLoop;
	var $slidePerPage;
	var $postType = 'slideshow';
	var $welcomeMsg = "";
	var $height = "";
	var $width = "";
	var $defaults = array();
	
	function tpo_display_slideshow(){	
		$this->defaults[0] = array ( 
			'slideimage' => get_bloginfo('template_directory') . '/images/slide1.jpg' , 
			'caption' => 'Awesome design and Features', 
			'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac vehicula sapien. Phasellus bibendum iaculis orci et vehicula. Morbi in mattis elit.' );
		$this->defaults[1] = array ( 
			'slideimage' => get_bloginfo('template_directory') . '/images/slide2.jpg' , 
			'caption' => 'Easy to use featured enrich admin panel', 
			'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac vehicula sapien. Phasellus bibendum iaculis orci et vehicula. Morbi in mattis elit.' );
		$this->defaults[2] = array ( 
			'slideimage' => get_bloginfo('template_directory') . '/images/slide3.jpg' , 
			'caption' => 'Custom inbuilt widgets', 
			'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac vehicula sapien. Phasellus bibendum iaculis orci et vehicula. Morbi in mattis elit.' );
		$this->defaults[3] = array ( 
			'slideimage' => get_bloginfo('template_directory') . '/images/slide4.jpg' , 
			'caption' => 'Extensive support forum', 
			'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac vehicula sapien. Phasellus bibendum iaculis orci et vehicula. Morbi in mattis elit.' );
		$this->defaults[4] = array ( 
			'slideimage' => get_bloginfo('template_directory') . '/images/slide5.jpg' , 
			'caption' => 'Higly SEO optimized structure', 
			'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac vehicula sapien. Phasellus bibendum iaculis orci et vehicula. Morbi in mattis elit.' );
	}
	function setWelcome($arg)
	{
		$this->welcomeMsg .= $arg;
	}
	function setheight($height) {
		$this->height = $height;	
	}
	function setwidth($width) {
		$this->width = $width;	
	}
	function NivoCaptionCSS($style){
		echo '<style></style>';
	}
	function showCycleSlider()
	{
		$slides = array();
		$slidekey = 0;
		$this->postPerPage = get_settings('tpo_cycle_slide_count');
		$this->slideshowLoop = new WP_Query("post_type=".$this->postType."&posts_per_page=".$this->postPerPage);
		if($this->slideshowLoop->have_posts())
			{
				while ($this->slideshowLoop->have_posts())
				{ 
					$this->slideshowLoop->the_post();
					if($sliderEffects!='') {
						$sliderEffects .= ',' . get_post_meta($this->slideshowLoop->post->ID,'tpo_slider_effect', true);
					} else {
						$sliderEffects .=   get_post_meta($this->slideshowLoop->post->ID,'tpo_slider_effect', true);
					}
	
					$slides[$slidekey]['hide_title'] = get_post_meta($this->slideshowLoop->post->ID,'tpo_hide_slider_title', true);
					$slides[$slidekey]['caption'] = $this->slideshowLoop->post->post_title;
					$slides[$slidekey]['slideimage'] = get_post_meta($this->slideshowLoop->post->ID, 'tpo_slider_image', true);
					$slides[$slidekey]['slider_url'] = get_post_meta($this->slideshowLoop->post->ID, 'tpo_slider_url', true);
					
					$description =  get_post_meta($this->slideshowLoop->post->ID, "tpo_slider_description", true);
					if (strlen($description) > 230) {
						$myExcerpt = rtrim(substr($description,0,230));
						if ($myExcerpt != '') {
							$myExcerpt .= '...';
							$desexcept = str_replace('[...]','',$myExcerpt);
						}
					} else {
						$desexcept = rtrim($description);
					}
					
					$slides[$slidekey]['des'] = $desexcept;
					$slidekey++;
				}
			} else {
					$slides = $this->defaults;
					$sliderEffects = 'fade';
			}

			$cycleheight = DEF_SLIDER_CYCLE_HEIGHT;
			$cyclewidth = DEF_SLIDER_CYCLE_WIDTH;
			if ($cycleheight && $cycleheight =='') { $cycleheight = '360' ; }
			if ($cyclewidth && $cyclewidth=='') { $cyclewidth = '1000'; }
			$transitiondelay= (get_settings('tpo_cycle_trandelay')*1000);
			$transitionspeed= (get_settings('tpo_cycle_transpeed')*1000);
			if ($transitionspeed == '' ) { $transitionspeed = 1000; }
			if ($transitiondelay == '' ) { $transitiondelay = 5000; }
			$tpo_cycle_orientation = get_settings('tpo_cycle_orientation');
			$tpo_cycle_prev_next = get_settings('tpo_cycle_prev_next');
			$featureheight = '480';
			$featureheight = $cycleheight + 70;
			$floatstyle = '';
			$cyclewidthnet = $cyclewidth-20;
			$floatstyle = 'z-index:89;position:absolute;';

		$this->slider .= '<script type="text/javascript">
			var all = "'.$sliderEffects.'";
			jQuery(document).ready(function(){
			jQuery("#pause").click(function() { jQuery("#slides").cycle("pause"); return false; });
			jQuery("#play").click(function() { jQuery("#slides").cycle("resume"); return false; });   
			jQuery("#slides").cycle({
				fx:      all,
				speed:   '.$transitionspeed.',
				timeout: '.$transitiondelay.',
				next:   "#next",
				prev:   "#prev",
				before:   onBefore,
				after:   onAfter 
			});
	
		});
		</script>';

		$this->slider.= '<div id="slideshow"  style="width:'.$cyclewidth.'px;height:'.$cycleheight.'px" >';
		if($tpo_cycle_prev_next!='true'){
			$disvar = 'display:none;';
		}
		$this->slider.= '<div id="controls" >';
		$this->slider.= '<span><a href="" id="prev"><img src="' . get_bloginfo('template_url') .'/images/prev-bt.png" alt="" /></a></span>';
		$this->slider.= '<span class="bt2"><a href="" id="next"><img src="' . get_bloginfo('template_url') .'/images/next-bt.png"  alt=""  /></a></span>';
		$this->slider.= '</div>';
		$this->slider.= '<div id="slides" style="border:0px solid #ccc; width:'.($cyclewidth).'px;height:'.($cycleheight).'px">'; 
		if ( $slides ) {
			foreach ( $slides as $sk => $slide ) {
				$caption = $slide['caption'];
				$slideimage = $slide['slideimage'];
				$img = tpo_image_resize($cycleheight, $cyclewidth, $slideimage);
				$this->slider .= '<div class="slide">' ;
				if ( $slide['slider_url'] ) {
					$this->slider .= '<div class="slide-image"><a href="' . $slide['slider_url'] . '" target="_blank" ><img src="' . $img .'"  alt="' . $caption . '" /></a></div>';
				} else {
					$this->slider .= '<div class="slide-image"><img src="' . $img .'"  alt="' . $caption . '" /></div>';			
				}
				
				if ( !$slide['hide_title'] ) {
					if ( $caption ) {
						$this->slider .= '<div class="sliderheading">' . $caption . '</div>';
					}
					if ( $slide['des'] ) {
						$this->slider .= '<div class="slidercontent">'. $slide['des'] .'</div>';
					}
				}
				
				$this->slider .= '</div>';
				$loopCount ++;
			}
		}
		else
		{
			$this->slider.= "<ul><li class='featured'><span class='slideWelcome'>".$this->welcomeMsg."</span></li></ul>\n";
		}

		$this->slider.= '</div></div>';
		$this->slider.= "<!-- end .featured_inside --> \n";
		echo $this->slider;
		wp_reset_query();
	}
}	