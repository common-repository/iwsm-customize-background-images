<?php
/*
Plugin Name: IWSM Customize Background Images
Plugin URI: http://co.soft-master.eu/2018/05/25/customize-background-images-wordpress-plugin/
Description: Customize Background Images
Author: Ilias Gomatos
Version: 1.0
Author URI: http://co.soft-master.eu
License: GPLv2
 * 
*/





function iwsm_manage_bg_images() {

    global $post;
    		
	if (is_admin()) return;

	$page_iwsm_bckgrd_img_url = '';
        $page_iwsm_bckgrd_img_urlr = '';
        $iwsm_mypage_bckgrd_img_link  = '';
        $iwsm_mypage_bckgrd_img_linkr  = '';
        $iwsm_mypage_bckgrd_img_repeat_y = '';
        $iwsm_mypage_bckgrd_img_margin  = '600';
        $iwsm_mypage_bckgrd_img_smheight  = '3000';
        $iwsm_mypage_bckgrd_img_sticky = ''; 
        $iwsm_mypage_bckgrd_img_zziindx  = '0';
       

	$options = get_option( 'iwsm_bckgrd_img_options' );
	
       
       
      
         $iwsm_mypage_bckgrd_img_repeat_y = $options['iwsm_bckgrd_img_repeat_y'];
         $myrepeaty = 'no-repeat';
         if ($iwsm_mypage_bckgrd_img_repeat_y == 1) {
            $myrepeaty = 'repeat-y'; 
         }
         
                  $iwsm_mypage_bckgrd_img_sticky = $options['iwsm_bckgrd_img_sticky'];
         $mysticky = 'absolute';
         if ($iwsm_mypage_bckgrd_img_sticky == 1) {
            $mysticky = 'fixed'; 
         }
         
        $iwsm_mypage_bckgrd_img_margin = $options['iwsm_bckgrd_img_margin']    ;
                if  ($iwsm_mypage_bckgrd_img_margin == '') {
                     $iwsm_mypage_bckgrd_img_margin = '600';
                 }
                 
                 $iwsm_mypage_bckgrd_img_zziindx = $options['iwsm_bckgrd_img_zziindx']    ;
                if  ($iwsm_mypage_bckgrd_img_zziindx == '') {
                     $iwsm_mypage_bckgrd_img_zziindx = '0';
                 }
                  
                 
                 
                 
                 
         $iwsm_mypage_bckgrd_img_smheight = $options['iwsm_bckgrd_img_smheight']    ;
                if  ($iwsm_mypage_bckgrd_img_smheight == '') {
                     $iwsm_mypage_bckgrd_img_smheight = '3000';
                 }               
                
	// if front page only
	if ( $options['iwsm_bckgrd_img_homepage'] ) {
	
		// then only set if the front pgage
		if ( is_front_page() || is_home() ) {
			$page_iwsm_bckgrd_img_url = get_background_image();
                        
                        if (strlen($options['iwsm_bckgrd_img_url']) > 4)  {
                        $page_iwsm_bckgrd_img_url = $options['iwsm_bckgrd_img_url']  ;
                        $iwsm_mypage_bckgrd_img_link = $options['iwsm_bckgrd_img_link'] ;
                        
                        
                        }
                        
	
                
                     if (strlen($options['iwsm_bckgrd_img_urlr']) > 4)  {
                        $page_iwsm_bckgrd_img_urlr = $options['iwsm_bckgrd_img_urlr']    ;
                         $iwsm_mypage_bckgrd_img_linkr = $options['iwsm_bckgrd_img_linkr']    ;
                        
                     }
                        
		}
                
                
		
	} else {
	
		// make the global the default
		$page_iwsm_bckgrd_img_url = get_background_image();
                
	  if (strlen($options['iwsm_bckgrd_img_url']) > 4)  {
                 $page_iwsm_bckgrd_img_url = $options['iwsm_bckgrd_img_url']    ;
                  $iwsm_mypage_bckgrd_img_link = $options['iwsm_bckgrd_img_link']    ;
          }
          
            if (strlen($options['iwsm_bckgrd_img_urlr']) > 4)  {
                 $page_iwsm_bckgrd_img_urlr = $options['iwsm_bckgrd_img_urlr']    ;
                  $iwsm_mypage_bckgrd_img_linkr = $options['iwsm_bckgrd_img_linkr']    ;
          }
                 
		// if single and single active
		if ( is_singular() && $options['iwsm_bckgrd_img_single'] ) {

    		// check to see if the theme supports Featured Images, and one is set
    		if (current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID )) {
            
        		// specify desired image size in place of 'full'
        		$page_iwsm_bckgrd_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        		$page_iwsm_bckgrd_img_url = $page_iwsm_bckgrd_img[0]; // this returns just the URL of the image

    		} 
    		
		}
    	
    	// get background image for a category 
    	if ( is_archive() && $options['iwsm_bckgrd_img_category'] && function_exists('category_image_src') ) {

    		if ( category_image_src() != '' ) {
    			$page_iwsm_bckgrd_img_url = category_image_src();
    		}
    	} 
	
	}

            $mybckrdtxt = '';
        if ($page_iwsm_bckgrd_img_urlr == '' && $page_iwsm_bckgrd_img_url <> '') {
	// style css single image 
	    $mybckrdtxt = '
	<style type="text/css" id="custom-background-css-override">
        body.custom-background { ' .
        	( $page_iwsm_bckgrd_img_url == '' ? 'background-image: none;' : 'background: url(' . $page_iwsm_bckgrd_img_url . ') no-repeat center center fixed;' ) . 
        	( 1 ? ' 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                    background-size: cover;
                   background-repeat: no-repeat;
                   background-attachment: fixed;
                   background-position: center top; 
                  
                   
' : '' ) . '};
 

@media only screen and (min-width: 1020px)  
#iwsm-bg {
    top: 0;
    left: 0;
    position: fixed;
    display: inline;
    width: 100%;
    cursor: pointer;
    height: 100%;
}



#iwsm-bg img {
 position: fixed;
 display: inline;
  top: 0px important; 
  left: 0; 
  bottom: 0; 
  margin: auto; 
  min-width: 25%;
  min-height: 25%;
  width: 100%; 
  height: auto;
  z-index: -1;
} 

#iwsm-bg a {
  position: fixed; 
   display: inline;
   top: 0px important; 
  left: 0; 
  right: 0; 
  bottom: 0; 
  margin: auto; 
  min-width: 100%;
  min-height: 100%;
    width: 100%; 
  height:100%;
   z-index: 1;
}

#iwsm-bg a:link {
display: block;
height: 160%;
width: 100%;
}

</style>
        	
<div id="iwsm-bg">
<a id="mylink" href="' . $iwsm_mypage_bckgrd_img_link . '"  target="_blank">  </a>
</div>
   

';
        } elseif ($page_iwsm_bckgrd_img_urlr <> '' && $page_iwsm_bckgrd_img_url <> '') {
        // style css images left - right 
            $mybckrdtxt = '	<style type="text/css" id="custom-background-css-override">
        body.custom-background { ' .
                    '   

height: auto; ';
   $mybckrdtxt .= ' background-image:: none; ';          
 //$mybckrdtxt .= ' background-image: url(' . $page_iwsm_bckgrd_img_url . '), url(' . $page_iwsm_bckgrd_img_urlr . '); ' ;
//$mybckrdtxt .= ' background-position: left top, right top; ';
 //$mybckrdtxt .= ' background-repeat: repeat-y; ';


 $mybckrdtxt .= '

}
    



@media only screen and (min-width: 1020px)
#iwsm-bg {
    top: 0;
    left: 0;
    position: fixed;
    display: inline;
    width: 100%;
    cursor: pointer;
    height: 100%;
}

#iwsm-bgimgl {
  position: fixed; 
   display: none;
   top: 0px important; 
  left: -300px; 
  bottom: 0; 
  margin: auto; 
   z-index: -1;
}

#iwsm-bgimgr {
 position: fixed; 
   display: none;
   top: 0px important; 
  right: 0; 
  bottom: 0; 
  margin: auto; 
   z-index: -1;
}

#iwsm-bglinkl {
  position: fixed; 
   display: inline;
   top: 0px important; 
  left: 0; 
  bottom: 0; 
  margin: auto; 
  min-width: 2%;
  min-height: 40%;
    width: 10%; 
  height:200%;
   z-index: -1;
}
#iwsm-bglinkr {
  position: fixed; 
   display: inline;
   top: 0px important; 
  right: 0; 
  bottom: 0; 
  margin: auto; 
  min-width: 2%;
  min-height: 40%;
    width: 10%; 
  height:200%;
   z-index: -1;
}


#iwsm-content { 
display:none;
height: 216px;
margin: 0 auto;
text-align: left;
overflow:auto;
width:960px;
} 

.smcolumn { 
width: 50%; 
position: ' . $mysticky . '; 
top: 0; 
z-index:'. $iwsm_mypage_bckgrd_img_zziindx . ';   
pointer-events: none;
} 

.smleft {left: 0;} 
.smright {right: 0;} 

#leftcol {
background:url("' . $page_iwsm_bckgrd_img_url . '") top right ' . $myrepeaty . ';
height: ' . $iwsm_mypage_bckgrd_img_smheight . 'px;
margin-right:' . $iwsm_mypage_bckgrd_img_margin . 'px;
overflow:hidden;
text-align:center;
z-index:1;  
pointer-events:auto;

} 

#leftcol a {
display: block;
width: 100px;
height: 100px;
text-decoration: none;
z-index:1;  
pointer-events:auto;
}


#rightcol {
margin-left:' . $iwsm_mypage_bckgrd_img_margin . 'px;
background:url("' . $page_iwsm_bckgrd_img_urlr . '") left top ' . $myrepeaty . ';

height: ' . $iwsm_mypage_bckgrd_img_smheight . 'px;
overflow:hidden;
pointer-events:auto;
z-index:1;  
} 


@media only screen and (max-width: 1019px) {
  
#iwsm-bg {
display:none;}

#leftcol {
display:none;}

#rightcol {
display:none;}

#iwsm-content {
display:none;}


}




        </style>
        	

 

<div style="bacground-color:white;" id="iwsm-bg" >
<a id="iwsm-bglinkl" href="' . $iwsm_mypage_bckgrd_img_link . '" target="_blank">  <img id="iwsm-bgimgl" src="' . $page_iwsm_bckgrd_img_url . '" alt=""> </a>
<a id="iwsm-bglinkr" href="' . $iwsm_mypage_bckgrd_img_linkr . '" target="_blank">  <img id="iwsm-bgimgr" src="' . $page_iwsm_bckgrd_img_urlr . '" alt=""> </a>

</div>
   

<div id="iwsm-content"></div> 

<div class="smleft smcolumn"> 
<div id="leftcol" onclick="window.open(\'' . $iwsm_mypage_bckgrd_img_link . '\');" style="cursor: pointer;"    ><a href="' . $iwsm_mypage_bckgrd_img_link . '&1" target="_blank">   </a></div> 
</div> 

<div class="smright smcolumn"> 
<div id="rightcol" onclick="window.open(\'' . $iwsm_mypage_bckgrd_img_linkr . '\');" style="cursor: pointer;"    ><a href="' . $iwsm_mypage_bckgrd_img_linkr . '&1" target="_blank">   </a></div> 
</div>







';
            
            
            
        }
        
       echo $mybckrdtxt;
//       background: url(' . $page_iwsm_bckgrd_img_url . ') left top no-repeat, 
//url(' . $page_iwsm_bckgrd_img_urlr . ') right top no-repeat, 
//url(' . $page_iwsm_bckgrd_img_url . ') left top repeat-x;' 
//        

}

add_action('wp_head' , 'iwsm_manage_bg_images' , 100);

// add theme support for custom-background
function iwsm_add_cb_support(){

	if ( !current_theme_supports( 'custom-background' ) ) {
               $background = get_background_image();
             if ( empty( $background )) {
            
//            $imageurl = plugin_dir_url( __FILE__ ) . 'images/pexels-photo-552766.jpeg';
//         // echo ' 9999999999999999999999999999999' . $imageurl;
// 
//             $image = plugin_dir_url( __FILE__ ) . 'images/pexels-photo-552766.jpeg';
//	if ( empty( $image ) ) {
//            // $imageurl = 'http://developerplus.no-ip.org/tst/images/pexels-photo-552766.jpeg';
//            
//        }
            
            
	$args = array(
'default-image'  => plugin_dir_url( __FILE__ ) . '/images/pexels-photo-552766.jpg', 
 'default-preset' => 'fill'         
);
        		$jit = isset( $args[0]['__jit'] );
			unset( $args[0]['__jit'] );
        
                        
                        if ( defined( 'IWSM_BACKGROUND_COLOR' ) ) {
				$args[0]['default-color'] = IWSM_BACKGROUND_COLOR;
			} elseif ( isset( $args[0]['default-color'] ) || $jit ) {
				define( 'IWSM_BACKGROUND_COLOR', $args[0]['default-color'] );
			}
                        
                        if ( defined( 'IWSM_BACKGROUND_IMAGE' ) ) {
				$args[0]['default-image'] = IWSM_BACKGROUND_IMAGE;
			} elseif ( isset( $args[0]['default-image'] ) || $jit ) {
				define( 'IWSM_BACKGROUND_IMAGE', $args[0]['default-image'] );
			}       
        
add_theme_support( 'custom-background', $args );	
            
          
          //  'default-preset' => 'fill'
//'default-repeat' => 'no-repeat',
//'default-attachment'     => 'fixed',
//'default-size'   => 'cover',  
            
//            add_theme_support( 'custom-background', array (
//  'default-color' => 'f6f6f6',
//  'default-image' => plugin_dir_url( __FILE__ ) . 'images/pexels-photo-552766.jpeg',
//));
//                
                
                
             }
    
	}

}

add_action( 'after_setup_theme', 'iwsm_add_cb_support' );

// Settings
function iwsm_bckgrd_img_add_admin_menu(  ) { 

	add_submenu_page( 'themes.php', 'SM Manage Bg Images', 'SM Manage Bg Images', 'manage_options', 'background_images', 'iwsm_bckgrd_images_options_page' );

}


function iwsm_bckgrd_img_options_exist(  ) { 

	if( false == get_option( 'background_images_settings' ) ) { 

		add_option( 'background_images_settings' );

	}

}


function iwsm_bckgrd_img_options_init(  ) { 

	register_setting( 'pluginPage', 'iwsm_bckgrd_img_options' );
	add_settings_section(
		'iwsm_bckgrd_img_pluginPage_section', 
		'', 
		'iwsm_bckgrd_img_options_section_callback', 
		'pluginPage'
	);

        
        
//	add_settings_field( 
//		'iwsm_bckgrd_img_fullscreen', 
//		__( 'Fullscreen Image', 'iwsm_bckgrd_img' ), 
//		'iwsm_bckgrd_img_fullscreen_render', 
//		'pluginPage', 
//		'iwsm_bckgrd_img_pluginPage_section' 
//	);
//	

        
        add_settings_field( 
		'iwsm_bckgrd_img_url', 
		__( 'Left background image url', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_url_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);

        
                add_settings_field( 
		'iwsm_bckgrd_img_link', 
		__( 'Left Background image link', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_link_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);
        
        add_settings_field( 
		'iwsm_bckgrd_img_urlr', 
		__( 'Right background image', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_urlr_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);
        
            add_settings_field( 
		'iwsm_bckgrd_img_linkr', 
		__( 'Right background image link', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_linkr_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);
            
                       add_settings_field( 
		'iwsm_bckgrd_img_margin', 
		__( 'Margin of images (px) e.g. 600', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_margin_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);
        
                       
        add_settings_field( 
		'iwsm_bckgrd_img_smheight', 
		__( 'Height of images area (px) e.g. 3000', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_smheight_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);               
                    
        
               add_settings_field( 
		'iwsm_bckgrd_img_zziindx', 
		__( 'Clickable area z-index e.g. 0', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_zziindx_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);               
        
                       
                       add_settings_field( 
		'iwsm_bckgrd_img_repeat_y', 
		__( 'Repeat-y images', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_repeat_y_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);
            
                               add_settings_field( 
		'iwsm_bckgrd_img_sticky', 
		__( 'Sticky images on top', 'iwsm_bckgrd_img' ), 
		'iwsm_bckgrd_img_sticky_render', 
		'pluginPage', 
		'iwsm_bckgrd_img_pluginPage_section' 
	);               
              
//        add_settings_field( 
//		'iwsm_bckgrd_theme_with_custom_image', 
//		__( 'Theme with custom image', 'iwsm_bckgrd_img' ), 
//		'iwsm_bckgrd_theme_with_custom_image_render', 
//		'pluginPage', 
//		'iwsm_bckgrd_img_pluginPage_section' 
//	); 
//        
        
                
//            add_settings_field( 
//		'iwsm_bckgrd_img_homepage', 
//		__( 'Background settings on  home page only', 'iwsm_bckgrd_img' ), 
//		'iwsm_bckgrd_img_homepage_render', 
//		'pluginPage', 
//		'iwsm_bckgrd_img_pluginPage_section' 
//	);    
//                
//                
//            add_settings_field( 
//		'iwsm_bckgrd_img_single', 
//		__( 'Alternative background image in each post', 'iwsm_bckgrd_img' ), 
//		'iwsm_bckgrd_img_single_render', 
//		'pluginPage', 
//		'iwsm_bckgrd_img_pluginPage_section' 
//	);
            
            
       // 
        
        
//	add_settings_field( 
//		'iwsm_bckgrd_img_category', 
//		__( 'Use featured image on categories (requires WPCustom Category Image plugin)' , 'iwsm_bckgrd_img' ), 
//		'iwsm_bckgrd_img_category_render', 
//		'pluginPage', 
//		'iwsm_bckgrd_img_pluginPage_section' 
//	);

}



function iwsm_bckgrd_theme_with_custom_image_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='checkbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_theme_with_custom_image]' <?php checked( $options['iwsm_bckgrd_theme_with_custom_image'], 1 ); ?> value='1'>
	<?php
}



function iwsm_bckgrd_img_homepage_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='checkbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_homepage]' <?php checked( $options['iwsm_bckgrd_img_homepage'], 1 ); ?> value='1'>
	<?php
}



function iwsm_bckgrd_img_fullscreen_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='checkbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_fullscreen]' <?php checked( $options['iwsm_bckgrd_img_fullscreen'], 1 ); ?> value='1'>
	<?php

}



function iwsm_bckgrd_img_url_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_url]' <?php echo $options['iwsm_bckgrd_img_url'] ; ?> value='<?php echo $options['iwsm_bckgrd_img_url'] ; ?>'>
	<?php

}

function iwsm_bckgrd_img_link_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_link]' <?php echo $options['iwsm_bckgrd_img_link'] ; ?> value='<?php echo $options['iwsm_bckgrd_img_link'] ; ?>'>
	<?php

}


function iwsm_bckgrd_img_margin_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
        $myvalue = $options['iwsm_bckgrd_img_margin'];
        if ($myvalue == false || $myvalue == '') {
           $myvalue = '600';
        }
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_margin]' <?php echo $myvalue ; ?> value='<?php echo $myvalue ; ?>'>
	<?php

}

function iwsm_bckgrd_img_zziindx_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
        $myvalue = $options['iwsm_bckgrd_img_zziindx'];
        if ($myvalue == false || $myvalue == '') {
           $myvalue = '0';
        }
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_zziindx]' <?php echo $myvalue ; ?> value='<?php echo $myvalue ; ?>'>
	<?php

}

function iwsm_bckgrd_img_smheight_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
        $myvalue = $options['iwsm_bckgrd_img_smheight'];
        if ($myvalue == false || $myvalue == '') {
           $myvalue = '3000';
        }
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_smheight]' <?php echo $myvalue ; ?> value='<?php echo $myvalue ; ?>'>
	<?php

}


function iwsm_bckgrd_img_repeat_y_render( ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
        
	<input type='checkbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_repeat_y]' <?php checked(  $options['iwsm_bckgrd_img_repeat_y'], 1 ); ?> value='1'>
	<?php
}


function iwsm_bckgrd_img_sticky_render( ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
        
	<input type='checkbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_sticky]' <?php checked(  $options['iwsm_bckgrd_img_sticky'], 1 ); ?> value='1'>
	<?php
}




function iwsm_bckgrd_img_urlr_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_urlr]' <?php echo $options['iwsm_bckgrd_img_urlr'] ; ?> value='<?php echo $options['iwsm_bckgrd_img_urlr'] ; ?>'>
	<?php

}

function iwsm_bckgrd_img_linkr_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	?>
	<input type='inputbox' name='iwsm_bckgrd_img_options[iwsm_bckgrd_img_linkr]' <?php echo $options['iwsm_bckgrd_img_linkr'] ; ?> value='<?php echo $options['iwsm_bckgrd_img_linkr'] ; ?>'>
	<?php

}




//add_settings_field('plugin_text_string', 'Text Input', 'setting_string_fn', __FILE__, 'main_section');



function iwsm_bckgrd_img_single_render(  ) { 

	$options = get_option( 'iwsm_bckgrd_img_options' );
	
	if ( !current_theme_supports( 'post-thumbnails' ) ) {
	
		echo '<p style="color: #ff0000">This theme does not support featured images. This setting has been disabled.</p>';
		echo '<input type="checkbox" name="iwsm_bckgrd_img_options[iwsm_bckgrd_img_single]" value="0" disabled>';

	} else {

		echo '<input type="checkbox" name="iwsm_bckgrd_img_options[iwsm_bckgrd_img_single]"' . checked( $options['iwsm_bckgrd_img_single'], 1 , false) . ' value="1">';
	
	}

}



//function iwsm_bckgrd_img_category_render(  ) { 
//
//	$options = get_option( 'iwsm_bckgrd_img_options' );
//	
//	if ( !is_plugin_active('wpcustom-category-image/load.php') ) {
//	
//		echo '<p style="color: #ff0000">The WPCustom Category Images plugin is not active. This setting has been disabled.</p>';
//		echo '<input type="checkbox" name="iwsm_bckgrd_img_options[iwsm_bckgrd_img_category]" value="0" disabled>';
//
//	} else {
//
//		echo '<input type="checkbox" name="iwsm_bckgrd_img_options[iwsm_bckgrd_img_category]"' . checked( $options['iwsm_bckgrd_img_category'], 1 , false) . ' value="1">';
//	
//	}
//
//}



function iwsm_bckgrd_img_options_section_callback(  ) { 

//	echo __( '<p>This mode requires an assignment of a global background image from Apperance-><a href="' . get_site_url() . '/wp-admin/customize.php?return=%2Ftst%2Fwp-admin%2Fthemes.php&autofocus%5Bcontrol%5D=background_image">Background Image</a></p>'
//                , 'iwsm_bckgrd_img' );

        echo __( '<p>Please select one or two urls for left and right screen side. '
                . ' If urls are empty a default image is showing.</p>'
                , 'iwsm_bckgrd_img' );
        
        
}


function iwsm_bckgrd_images_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Background images customizer settings</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

add_action( 'admin_menu', 'iwsm_bckgrd_img_add_admin_menu' );
add_action( 'admin_init', 'iwsm_bckgrd_img_options_init' );

