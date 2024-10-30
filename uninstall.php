<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
exit ();
}


delete_option( 'iwsm_bckgrd_img_options' );
remove_custom_background();