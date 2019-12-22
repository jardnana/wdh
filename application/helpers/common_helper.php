<?php

function upload_image($dir,$img){
	$CI=&get_instance();
	//print_r($img);
	     $config['upload_path']   = $dir; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 148366 ; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;
    $CI->load->library('upload', $config);
    if ( ! $CI->upload->do_upload('site_logo')) {
       $error = array('error' => $CI->upload->display_errors()); 
       $data = false;
       }	
    else 
    { 
       $data = array('upload_data' => $CI->upload->data());  
         $data = true;       
         }
   return $data;
}


?>