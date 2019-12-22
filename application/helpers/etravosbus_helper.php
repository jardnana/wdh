<?php ob_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function search_bus($search_data,$rand_id,$search_id){
// echo '<pre>'; print_r(); exit;

$strFolderPath = "all_xml_logs/bus/search_logs";
$strMethod     = "Sync";
	$depCity = $search_data[0]->departure_city;
	$arrvCity = $search_data[0]->arrival_city;
	$CI = & get_instance();
	$CI->load->model('Bus_model');
	$destCity = $CI->Bus_model->get_bus_destination($depCity); 
	$destCity = $destCity->destid;
	$arrCity = $CI->Bus_model->get_bus_destination($arrvCity); 
	$arrCity = $arrCity->destid;
	$departureDate = $search_data[0]->departure_date;
	$journeyType = $search_data[0]->journey_type;
	if ($journeyType == 'OneWay') {
		$tripType = '1';
	}else{
		$tripType = '2';
	}

	ini_set('memory_limit', '-1');
	$URL = 'http://webapi.i2space.co.in/Buses/AvailableBuses?sourceId='.$destCity.'&destinationId='.$arrCity.'&journeyDate='.$departureDate.'&tripType='.$tripType.'&userType=5&user=';

	$strResponse  = bus_processRequest_search($URL);
	$strResponse = json_decode($strResponse,true);

	 if (!file_exists($strFolderPath.'/'.date('Y-m-d'))) {

            mkdir($strFolderPath.'/'.date('Y-m-d'), 0777, true);

        }

        $new_folder_path = $strFolderPath.'/'.date('Y-m-d');



        //echo "<pre>";print_r($strData);exit();

        $path = FCPATH . "/".$new_folder_path."/SearchRQ_".$search_id.".txt";

        // $fp = fopen($path,"wb");fwrite($fp,$URL);fclose($fp);



        $path = FCPATH . "/".$new_folder_path."/SearchRS_".$search_id.".json";

        // $fp = fopen($path,"wb");fwrite($fp,$strResponse);fclose($fp);

        return $strResponse;
	// echo '<pre>f'; print_r($strResponse); exit;

}

function bus_processRequest_search($url){

	ini_set('memory_limit', '-1');
	$ch = curl_init();
    $headers = array(
    'ConsumerKey: 8BCAFEBCE6E63C4523E3E0A00369D0171EB315B5',
    'ConsumerSecret : C0A896DCC6EA8338830747A5A61C41BC4619B77A',
    'Content-Type: application/json',

    );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    /*$body = '{}';*/

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    //curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    // $response  = file_get_contents(base_url() . "/".$strFolderPath."/FareRuleRS_582_25617.xml");
    $response  = file_get_contents('file:///C:/xampp/htdocs/test/trunk/all_xml_logs/searchResponse.json');
    // echo '<pre>da'; print_r($response); exit();
    // $response = curl_exec($ch);

    return $response;
}
?>