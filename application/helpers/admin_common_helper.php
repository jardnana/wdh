<?php

function check_admin_logged_in(){
	if(isset($_SESSION['logged_id']) && ($_SESSION['logged_id']!='')){ redirect(base_url().'dashboard'); }
}


function validate_admin_loggin(){
	if(isset($_SESSION['logged_id']) && ($_SESSION['logged_id']!='')){ }else{ redirect(base_url().'login');}
}

?>
