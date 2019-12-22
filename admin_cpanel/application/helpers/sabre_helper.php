<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Sunil G R	   							   					   |
|--------------------------------------------------------------------------|
*/

function set_credencials_flight(){
	
	$CI = & get_instance();
    $CI->load->model('Flight_Model');
	$api_data = $CI->Flight_Model->get_api_credentials('Sabre');
	$data['from'] 				= $api_data->api_email;
    $data['conversation_id'] 	= time().$data['from'];
    $data['ipcc'] 				= $api_data->api_ipcc;
    $data['username'] 			= $api_data->api_username;
    $data['password'] 			= $api_data->api_password;
    $data['system'] 			= $api_data->api_url;
    $data['message_id'] 		= "mid:".time().$data['from'];
    $data['timestamp'] 			= gmdate("Y-m-d\TH-i-s\Z");
    $data['timetolive'] 		= gmdate("Y-m-d\TH-i-s\Z");
    return $data;
}

function SessionCreateRQ($search_id, $type = 'SEARCH', $Action = 'SessionCreateRQ'){ 
    $credencials = set_credencials_flight();
    $SessionCreateRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope
                  xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices3.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service eb:type='SabreXML'>Session</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security
                          xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                      <SessionCreateRQ>
                          <POS>
                              <Source PseudoCityCode='".$credencials['ipcc']."' />
                          </POS>
                      </SessionCreateRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
    $SessionCreateRS = flight_processRequest($SessionCreateRQ, $credencials['system']);
    $SessionCreateRQ_RS = array(
      'SessionCreateRQ' => $SessionCreateRQ,
      'SessionCreateRS' => $SessionCreateRS
    );  
	// $folder_path = $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$search_id; 
	// if (!file_exists($folder_path)){
		 // mkdir($_SERVER['DOCUMENT_ROOT']."/utravel_v1/admin_cpanel/cancel_logs/".$search_id, 0777);
	// }				
	// $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$search_id."/SessionCreateRQ.xml";
	// $fp 	= fopen($path,"wb");fwrite($fp,$SessionCreateRQ);fclose($fp);
	// 
	// $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$search_id."/SessionCreateRS.xml";
	// $fp 	= fopen($path,"wb");fwrite($fp,$SessionCreateRS);fclose($fp);
    return $SessionCreateRQ_RS;
}

function SessionCloseRQ($BinarySecurityToken, $search_id, $type = 'SEARCH',$Action = 'SessionCloseRQ'){
    $credencials = set_credencials_flight();
    $SessionCloseRQ = "<?xml version='1.0' encoding='utf-8'?>
                        <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                            <soap-env:Header>
                                <eb:MessageHeader xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                                    <eb:From>
                                        <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                                    </eb:From>
                                    <eb:To>
                                        <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices3.sabre.com</eb:PartyId>
                                    </eb:To>
                                    <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                                    <eb:Service>SessionCloseRQ</eb:Service>
                                    <eb:Action>".$Action."</eb:Action>
                                    <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                                    <eb:MessageData>
                                        <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                                        <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                                        <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                                    </eb:MessageData>
                                </eb:MessageHeader>
                                <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                                  <wsse:BinarySecurityToken valueType='String' EncodingType='wsse:Base64Binary'>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                                </wsse:Security>
                            </soap-env:Header>
                            <soap-env:Body>
                                <SessionCloseRQ>
                                    <POS>
                                        <Source PseudoCityCode='".$credencials['ipcc']."' />
                                    </POS>
                                </SessionCloseRQ>
                            </soap-env:Body>
                        </soap-env:Envelope>";
    $SessionCloseRS = flight_processRequest($SessionCloseRQ, $credencials['system']);
    $SessionCloseRQ_RS = array(
							  'SessionCloseRQ' => $SessionCloseRQ,
							  'SessionCloseRS' => $SessionCloseRS
							);
	// $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$search_id."/SessionCloseRQ.xml";
	// $fp 	= fopen($path,"wb");fwrite($fp,$SessionCloseRQ);fclose($fp);
	// 
	// $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$search_id."/SessionCloseRS.xml";
	// $fp 	= fopen($path,"wb");fwrite($fp,$SessionCloseRS);fclose($fp);
	return $SessionCloseRQ_RS;
}

function TravelItineraryReadRQ($BinarySecurityToken, $pnr, $Action = 'TravelItineraryReadLLSRQ'){
    $credencials = set_credencials_flight();
	$TravelItineraryReadRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service>TravelItineraryReadLLSRQ</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                    <TravelItineraryReadRQ Version='2.2.0' xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'>
                      <MessagingDetails>
                       <Transaction Code='PNR'/>
                      </MessagingDetails>
                      <UniqueID ID='" . $pnr . "'/>
                    </TravelItineraryReadRQ>                    
                  </soap-env:Body>
              </soap-env:Envelope>";
    $TravelItineraryReadRS = flight_processRequest($TravelItineraryReadRQ, $credencials['system']);    
    $TravelItineraryReadRQ_RS = array(
									  'TravelItineraryReadRQ' => $TravelItineraryReadRQ,
									  'TravelItineraryReadRS' => $TravelItineraryReadRS
									);   
    // $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$pnr."/TravelItineraryReadRQ.xml";
	// $fp 	= fopen($path,"wb");fwrite($fp,$TravelItineraryReadRQ);fclose($fp);
	// 
	// $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$pnr."/TravelItineraryReadRS.xml";
	// $fp 	= fopen($path,"wb");fwrite($fp,$TravelItineraryReadRS);fclose($fp);  
    return $TravelItineraryReadRQ_RS;
}

function BargainFinderMaxRQ($search_data, $BinarySecurityToken, $rand_id, $Action = 'BargainFinderMaxRQ',$flexible = ''){
    if($search_data->flexible == '1'){
		$Action = 'BargainFinderMax_ADRQ';
		$RequestType = 'AD3';
	}else{
		$Action = 'BargainFinderMaxRQ';
		$RequestType = '50ITINS';
	}
    $credencials = set_credencials_flight();
    $oneway = '';$roundtrip = '';$multicity = ''; $airline = ""; $i = "2";
    $DepPreferredTime 		= date("Y-m-d",strtotime($search_data->departure_date)).'T00:00:00';
	$OriginLocation 		= explode(",",$search_data->departure_city);
	$DestinationLocation 	= explode(",",$search_data->arrival_city);
	$oneway =  "<OriginDestinationInformation RPH='1'>
				<DepartureDateTime>".$DepPreferredTime."</DepartureDateTime>
				<OriginLocation LocationCode='".trim($OriginLocation[1])."'/>
				<DestinationLocation LocationCode='".trim($DestinationLocation[1])."'/>   
				".$airline."
			 </OriginDestinationInformation>";  
	if($search_data->journey_type == 'ROUNDTRIP'){
		$DepPreferredTime 		= date("Y-m-d",strtotime($search_data->return_date)).'T00:00:00';
		$OriginLocation 		= explode(",",$search_data->departure_city);
		$DestinationLocation 	= explode(",",$search_data->arrival_city);
		$roundtrip =  "<OriginDestinationInformation RPH='2'>
                        <DepartureDateTime>".$DepPreferredTime."</DepartureDateTime>
						<OriginLocation LocationCode='".trim($DestinationLocation[1])."'/>
						<DestinationLocation LocationCode='".trim($OriginLocation[1])."'/>                      
                     </OriginDestinationInformation>";
                          
    }
    if($search_data->journey_type == 'MULTICITY'){
	  $multi_from_city = json_decode($search_data->multi_from_city);
	  $multi_to_city = json_decode($search_data->multi_to_city);
	  $multi_fcheckin = json_decode($search_data->multi_fcheckin);
      foreach ($multi_from_city as $key => $value) {
        $OriginLocation 		= explode(",",$value);
		$DestinationLocation 	= explode(",",$multi_to_city[$key]);
        $DepPreferredTime = date("Y-m-d",strtotime($multi_fcheckin[$key])).'T00:00:00';
        $multicity .=  "<OriginDestinationInformation RPH='".$i."'>
                           <DepartureDateTime>".$DepPreferredTime."</DepartureDateTime>
							<OriginLocation LocationCode='".trim($OriginLocation[1])."'/>
							<DestinationLocation LocationCode='".trim($DestinationLocation[1])."'/>    
                       </OriginDestinationInformation>";        
        $i++;
      }
     
    }
    //Passenger Details Start
    $adult_patch = $child_patch = $infant_patch = '';
    if($search_data->adult > 0){
        $adult_patch = "<PassengerTypeQuantity Code='ADT' Quantity='".$search_data->adult."'/>";
    }
    if($search_data->child > 0){
        $child_patch = "<PassengerTypeQuantity Code='CNN' Quantity='".$search_data->child."'/>";
    }
    if($search_data->infant > 0){
        $infant_patch = "<PassengerTypeQuantity Code='INF' Quantity='".$search_data->infant."'/>";
    }
    
	$economyCode = 'Y';
	$economy = $search_data->cabin_class;
	if ($economy == 'Economy') {
		$economyCode = 'Y';
	}
	if ($economy == 'PremiumEconomy') {
		$economyCode = 'S';
	}
	if ($economy == 'Business') {
		$economyCode = 'C';
	}
	if ($economy == 'PremiumBusiness') {
		$economyCode = 'J';
	}
	if ($economy == 'First') {
		$economyCode = 'F';
	}
	if ($economy == 'PremiumFirst') {
		$economyCode = 'P';
	}
	$nonstop='';
	
    $BargainFinderMaxRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                            <SOAP-ENV:Header>
                              <m:MessageHeader xmlns:m="http://www.ebxml.org/namespaces/messageHeader">
                                <m:From>
                                  <m:PartyId type="urn:x12.org:IO5:01">'.$credencials['from'].'</m:PartyId>
                                </m:From>
                                <m:To>
                                  <m:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</m:PartyId>
                                </m:To>
                                <m:CPAId>'.$credencials['ipcc'].'</m:CPAId>
                                <m:ConversationId>'.$credencials['conversation_id'].'</m:ConversationId>
                                <m:Service m:type="OTA">'.$Action.'</m:Service>
                                <m:Action>'.$Action.'</m:Action>
                                <m:MessageData>
                                  <m:MessageId>'.$credencials['message_id'].'</m:MessageId>
                                  <m:Timestamp>'.$credencials['timestamp'].'</m:Timestamp>
                                  <m:TimeToLive>'.$credencials['timetolive'].'</m:TimeToLive>
                                </m:MessageData>
                                <m:DuplicateElimination/>
                                <m:Description>Bargain Finder Max Service</m:Description>
                              </m:MessageHeader>
                              <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
                                <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">'.$BinarySecurityToken.'</wsse:BinarySecurityToken>
                              </wsse:Security>
                            </SOAP-ENV:Header>
                            <SOAP-ENV:Body>
                              <OTA_AirLowFareSearchRQ Version="1.9.2" xmlns="http://www.opentravel.org/OTA/2003/05">
                                  <POS>
                                    <Source PseudoCityCode="'.$credencials['ipcc'].'">
                                      <RequestorID ID="1" Type="1">
                                        <CompanyName Code="TN">TN</CompanyName>
                                      </RequestorID>
                                    </Source>
                                  </POS>
                                  '.$oneway.'
                                  '.$roundtrip.'
                                  '.$multicity.'
                                  <TravelPreferences>
									'.$nonstop.'
									<CabinPref Cabin="'.$economyCode.'"/>
                                  </TravelPreferences>
                                  <TravelerInfoSummary>
                                    <SeatsRequested>'.($search_data->adult+$search_data->child).'</SeatsRequested>
                                    <AirTravelerAvail>
                                      '.$adult_patch.'
                                      '.$child_patch.'
                                      '.$infant_patch.'                                      
                                    </AirTravelerAvail>
                                  </TravelerInfoSummary>
                                  <TPA_Extensions>
                                    <IntelliSellTransaction>
                                      <RequestType Name="'.$RequestType.'"/>
                                    </IntelliSellTransaction>
                                  </TPA_Extensions>
                                </OTA_AirLowFareSearchRQ>
                            </SOAP-ENV:Body>
                          </SOAP-ENV:Envelope>';
    // echo '<pre/>';print_r($BargainFinderMaxRQ);exit;
   $BargainFinderMaxRS = flight_processRequest($BargainFinderMaxRQ, $credencials['system']);

    // $final_de = date('Ymd_His')."_".rand(1,10000);
    $final_de = $search_data->search_parameter_details_id;
    $XmlReqFileName = $Action.$final_de; $XmlResFileName = $Action.'Rs'.$final_de;
    $fp = fopen("search_logs/".$XmlReqFileName.'.xml', 'a+');
    fwrite($fp, $BargainFinderMaxRQ);
    fclose($fp);
    $fp = fopen("search_logs/".$XmlResFileName.'.xml', 'a+');
    fwrite($fp, $BargainFinderMaxRS);
    fclose($fp);

    $BargainFinderMaxRQ_RS = array(
          'BargainFinderMaxRQ' => $BargainFinderMaxRQ,
          'BargainFinderMaxRS' => $BargainFinderMaxRS,
          'BinarySecurityToken' => $BinarySecurityToken
        );
    $CI =& get_instance();
    $CI->load->model('Flight_Model');
    $CI->Flight_Model->update_flight_response($search_data->search_parameter_details_id, $rand_id,$XmlReqFileName,$XmlResFileName);
    return $BargainFinderMaxRQ_RS;
}

function TravelItineraryAddInfoRQ($BinarySecurityToken, $search_id, $search_data1, $segment_data1, $traveler_details1, $Action = 'TravelItineraryAddInfoLLSRQ'){
	$credencials 		= set_credencials_flight();
    $search_data 		= json_decode(base64_decode($search_data1));
    $segment_data 		= json_decode(base64_decode($segment_data1));
    $traveler_details 	= json_decode(base64_decode($traveler_details1));
    $travellers 		= $frequent_traveler = $PassengerType = '';$a = 1;$c = 0;$i = 0;
    for($aaa=0;$aaa < count($traveler_details->saladult);$aaa++) {       
		if($traveler_details->mnameadult[$aaa] == ''){
			$GivenNameXMLADT = "<GivenName>".$traveler_details->fnameadult[$aaa]."</GivenName>";
		}else{
			$GivenNameXMLADT = "<GivenName>".$traveler_details->fnameadult[$aaa]." ".$traveler_details->mnameadult[$aaa]."</GivenName>";
		}
		if ($traveler_details->airlineadult[$aaa]!='') {		
			 if ($traveler_details->ftnumberadult[$aaa]!='') {		
				 $frequent_traveler .= '<CustLoyalty MembershipID="'.$traveler_details->ftnumberadult[$aaa].'" NameNumber="'.$a.'.1" ProgramID="'.$traveler_details->airlineadult[$aaa].'" TravelingCarrierCode="'.$traveler_details->airlineadult[$aaa].'" />';
			 }
		}
		$travellers .= "<PersonName NameNumber='".$a.".1' PassengerType='ADT' NameReference='".$traveler_details->saladult[$aaa]."'>
							".$GivenNameXMLADT."
							<Surname>".$traveler_details->lnameadult[$aaa]."</Surname>
						</PersonName>"; 
	   
		$a++;       
	}
    if(isset($traveler_details->salchild)){
        $c = $a;
        for($ccc=0;$ccc < count($traveler_details->salchild);$ccc++) { 	
			if($traveler_details->mnamechild[$ccc] == ''){
				$GivenNameXMLCHD = "<GivenName>".$traveler_details->fnamechild[$ccc]."</GivenName>";
			}else{
				$GivenNameXMLCHD = "<GivenName>".$traveler_details->fnamechild[$ccc]." ".$traveler_details->mnamechild[$ccc]."</GivenName>";
			}
			if ($traveler_details->airlinechild[$aaa]!='') {		
				 if ($traveler_details->ftnumberchild[$aaa]!='') {		
					 $frequent_traveler .= '<CustLoyalty MembershipID="'.$traveler_details->ftnumberchild[$aaa].'" NameNumber="'.$a.'.1" ProgramID="'.$traveler_details->airlinechild[$aaa].'" TravelingCarrierCode="'.$traveler_details->airlinechild[$aaa].'" />';
				 }
			}
			$travellers .= "<PersonName NameNumber='".$a.".1' PassengerType='CNN' NameReference='".$traveler_details->salchild[$ccc]."'>
								".$GivenNameXMLCHD."
								<Surname>".$traveler_details->lnamechild[$ccc]."</Surname>
							</PersonName>"; 
		   $a++; $c++;    
		}
    }
    
    if(isset($traveler_details->salinfant)){
        $i = $a+$c;
        for($iii=0;$iii < count($traveler_details->salinfant);$iii++) { 	
			if($traveler_details->mnameinfant[$iii] == ''){
				$GivenNameXMLINF = "<GivenName>".$traveler_details->fnameinfant[$iii]."</GivenName>";
			}else{
				$GivenNameXMLINF = "<GivenName>".$traveler_details->fnameinfant[$iii]." ".$traveler_details->mnameinfant[$iii]."</GivenName>";
			}
			if ($traveler_details->airlineinfant[$aaa]!='') {		
				 if ($traveler_details->ftnumberinfant[$aaa]!='') {		
					 $frequent_traveler .= '<CustLoyalty MembershipID="'.$traveler_details->ftnumberinfant[$aaa].'" NameNumber="'.$a.'.1" ProgramID="'.$traveler_details->airlineinfant[$aaa].'" TravelingCarrierCode="'.$traveler_details->airlineinfant[$aaa].'" />';
				 }
			}
			$travellers .= "<PersonName NameNumber='".$a.".1' PassengerType='INF' NameReference='".$traveler_details->salinfant[$iii]."'>
								".$GivenNameXMLINF."
								<Surname>".$traveler_details->lnameinfant[$iii]."</Surname>
							</PersonName>"; 
		    $a++; $i++;  
		}
	}   
    $TravelItineraryAddInfoRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service eb:type='OTA'>Air</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                      <TravelItineraryAddInfoRQ Version='2.0.2' xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'>
                        <AgencyInfo>
                             <Address>
                                <AddressLine>Shoppers Lane</AddressLine>
                                <CityName>Covina</CityName>
                                <CountryCode>USA</CountryCode>
                                <PostalCode>91724</PostalCode>
                                <StateCountyProv StateCode='California'/>
                                <StreetNmbr>654 Shoppers Lane</StreetNmbr>
                            </Address>
                            <Ticketing TicketType='7TAW'/>
                        </AgencyInfo>
                        <CustomerInfo>
                            <ContactNumbers>
                                <ContactNumber Phone='".trim($traveler_details->mobile_number)."' PhoneUseType='A'/>
                            </ContactNumbers>
                            ".$frequent_traveler."
                            <Email Address='".trim($traveler_details->contact_email)."' Type='CC'/>
                            ".$travellers."
                        </CustomerInfo>
                    </TravelItineraryAddInfoRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
    $TravelItineraryAddInfoRS = flight_processRequest($TravelItineraryAddInfoRQ, $credencials['system']); 
    $TravelItineraryAddInfoRQ_RS = array(
      'TravelItineraryAddInfoRQ' => $TravelItineraryAddInfoRQ,
      'TravelItineraryAddInfoRS' => $TravelItineraryAddInfoRS
    );  
    
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/TravelItineraryAddInfoRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$TravelItineraryAddInfoRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/TravelItineraryAddInfoRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$TravelItineraryAddInfoRS);fclose($fp);		
    return $TravelItineraryAddInfoRQ_RS;
}

function AddRemarkRQ($BinarySecurityToken, $search_id, $search_data1, $segment_data1, $traveler_details1, $Action = 'AddRemarkLLSRQ'){
   $credencials 		= set_credencials_flight();
   $traveler_details 	= json_decode(base64_decode($traveler_details1));
   $PaymentDetails = '<FOP_Remark>
						 <CC_Info>
							<PaymentCard Code="'.$traveler_details->CardType.'" ExpireDate="'.$traveler_details->CardExpireYear.'-'.$traveler_details->CardExpireMonth.'" Number="'.$traveler_details->CardNumber.'" />
						</CC_Info>
					</FOP_Remark>';
	$GeneralReamrk = '<Remark Type="General">
							<Text>Internal Code - '.$traveler_details->CardSecurityCode.'</Text>
					  </Remark>';
					  
	$BillingAddress = '<Remark Type="Client Address">
							<Text>'.$traveler_details->card_contact_first_name." ".$traveler_details->card_contact_middle_name." ".$traveler_details->card_contact_last_name.", ".$traveler_details->card_contact_city.", ".$traveler_details->card_contact_state.", ".$traveler_details->card_contact_nationality.'</Text>
						  </Remark>';
						  // <Text>'.$traveler_details->card_contact_first_name." ".$traveler_details->card_contact_middle_name." ".$traveler_details->card_contact_last_name.", ".$traveler_details->card_contact_city.", ".$traveler_details->card_contact_state.", ".$traveler_details->card_contact_nationality." - ".$traveler_details->card_contact_zipcode." Email: ".$traveler_details->card_contact_email.'</Text>
   $AddRemarkRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service eb:type='OTA'>Air</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                      <AddRemarkRQ xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' ReturnHostCommand='false' Version='2.1.0'>
						  <RemarkInfo>
							".$PaymentDetails."
							".$GeneralReamrk."
							".$BillingAddress."
						  </RemarkInfo>
                     </AddRemarkRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
    $AddRemarkRS = flight_processRequest($AddRemarkRQ, $credencials['system']); 
    $AddRemarkRQ_RS = array(
					  'AddRemarkRQ' => $AddRemarkRQ,
					  'AddRemarkRS' => $AddRemarkRS
					);      
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/AddRemarkRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$AddRemarkRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/AddRemarkRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$AddRemarkRS);fclose($fp);  
    return $AddRemarkRQ_RS;
}

function OTA_AirBookRQ($BinarySecurityToken, $search_id, $search_data1, $segment_data1, $traveler_details1, $Action = 'EnhancedAirBookRQ'){
    $credencials 	= set_credencials_flight();
    $search_data 	= json_decode(base64_decode($search_data1));
    $segment_data 	= json_decode(base64_decode($segment_data1));
    $Segments = '';
    for($j=0;$j< count($segment_data); $j++){
		for($ss=0;$ss< count($segment_data[$j]->OriginLocation); $ss++){
			$Segments .= "<FlightSegment DepartureDateTime='".$segment_data[$j]->DepartureDateTime_r[$ss]."' ArrivalDateTime='".$segment_data[$j]->ArrivalDateTime_r[$ss]."' FlightNumber='".$segment_data[$j]->FlighvgtNumber_no[$ss]."' NumberInParty='".($search_data[0]->adult + $search_data[0]->child)."' ResBookDesigCode='".$segment_data[$j]->ResBookDesigCode[$ss]."' Status='NN'>
							 <DestinationLocation LocationCode='".$segment_data[$j]->DestinationLocation[$ss]."'/>
							 <Equipment AirEquipType='".$segment_data[$j]->Equipment[$ss]."'/>
							 <MarketingAirline Code='".$segment_data[$j]->OperatingAirline[$ss]."' FlightNumber='".$segment_data[$j]->FlighvgtNumber_no[$ss]."'/>
							 <OperatingAirline Code='".$segment_data[$j]->OperatingAirline[$ss]."'/>
							 <OriginLocation LocationCode='".$segment_data[$j]->OriginLocation[$ss]."'/>
						  </FlightSegment>";
		}
	}
	$OTA_AirBookRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service>EnhancedAirBookRQ</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                    <EnhancedAirBookRQ Version='2.3.0' ReturnHostCommand='true' xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://webservices.sabre.com/sabreXML/2011/10 http://webservices.sabre.com/wsdl/swso/EnhancedAirBook2.3.0RQ.xsd'>
                      <OTA_AirBookRQ HaltOnError='true'>
                        <HaltOnStatus Code='NN'/>
                        <HaltOnStatus Code='UC'/>
                        <HaltOnStatus Code='NO'/>
                        <HaltOnStatus Code='US'/>
                        <HaltOnStatus Code='LL'/>
                        <OriginDestinationInformation>
                          " . $Segments . "
                        </OriginDestinationInformation>
                        <RedisplayReservation NumAttempts='10' WaitInterval='3000'/>
                      </OTA_AirBookRQ>
                      <PostProcessing HaltOnError='true' IgnoreAfter='false' RedisplayReservation='true'/>
                      <PreProcessing HaltOnError='true' IgnoreBefore='false'/>  
                    </EnhancedAirBookRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
    $OTA_AirBookRS = flight_processRequest($OTA_AirBookRQ, $credencials['system']);   
    $OTA_AirBookRQ_RS = array(
						  'OTA_AirBookRQ' => $OTA_AirBookRQ,
						  'OTA_AirBookRS' => $OTA_AirBookRS
						);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/OTA_AirBookRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$OTA_AirBookRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/OTA_AirBookRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$OTA_AirBookRS);fclose($fp); 
	return $OTA_AirBookRQ_RS;
}

function OTA_AirPriceRQ($BinarySecurityToken, $search_id, $search_data1, $segment_data1, $traveler_details1, $Action = 'OTA_AirPriceLLSRQ'){
    $credencials 	= set_credencials_flight();
    $search_data 	= json_decode(base64_decode($search_data1));  
    $adult_patch 	= $child_patch = $infant_patch = '';
    if($search_data[0]->adult > 0){
        $adult_patch = "<PassengerType Code='ADT' Quantity='".$search_data[0]->adult."' Force='true'/>";
    }
    if($search_data[0]->child > 0){
        $child_patch = "<PassengerType Code='CNN' Quantity='".$search_data[0]->child."' Force='true'/>";
    }
    if($search_data[0]->infant > 0){
        $infant_patch = "<PassengerType Code='INF' Quantity='".$search_data[0]->infant."' Force='true'/>";
    }
    
	$OTA_AirPriceRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service>OTA_AirPriceLLSRQ</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                    <OTA_AirPriceRQ Version='2.8.0' xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' ReturnHostCommand='true'>
                      <PriceRequestInformation Retain='true'>
                        <OptionalQualifiers>
                          <PricingQualifiers>
                            ".$adult_patch.$child_patch.$infant_patch."
                          </PricingQualifiers>
                        </OptionalQualifiers>
                      </PriceRequestInformation>
                    </OTA_AirPriceRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
    $OTA_AirPriceRS = flight_processRequest($OTA_AirPriceRQ, $credencials['system']);   
    $OTA_AirPriceRQ_RS = array(
							  'OTA_AirPriceRQ' => $OTA_AirPriceRQ,
							  'OTA_AirPriceRS' => $OTA_AirPriceRS
							);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/OTA_AirPriceRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$OTA_AirPriceRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/OTA_AirPriceRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$OTA_AirPriceRS);fclose($fp); 
    return $OTA_AirPriceRQ_RS;
}

function SpecialServiceRQ($BinarySecurityToken, $search_id, $search_data1, $segment_data1, $traveler_details1, $Action = 'SpecialServiceLLSRQ'){
    $credencials 	= set_credencials_flight();
    $search_data 	= json_decode(base64_decode($search_data1));
    $segment_data 	= json_decode(base64_decode($segment_data1));
    $traveler_details 	= json_decode(base64_decode($traveler_details1));
	$travellers 	= $PassengerType = '';$a = 1;$c = 0;$i = 0;
	
	for($aaa=0;$aaa < count($traveler_details->saladult);$aaa++) {       
		if($traveler_details->mnameadult[$aaa] == ''){
			$adultText = 'P/IND/123456789/IND/01JAN90/M/30MAY24/'.$traveler_details->lnameadult[$aaa].'/'.$traveler_details->fnameadult[$aaa].'/H-'.$a .'.'.'1';
		}else{
			$adultText = 'P/IND/123456789/IND/01JAN90/M/30MAY24/'.$traveler_details->lnameadult[$aaa].'/'.$traveler_details->fnameadult[$aaa]." ".$traveler_details->mnameadult[$aaa].'/H-'.$a .'.'.'1';
		}
		$travellers .= '<Service SSR_Code="DOCS">
							  <PersonName/>
							  <Text>'.$adultText.'</Text>
							  <VendorPrefs><Airline Hosted="false"/></VendorPrefs>
							</Service>';
							
		if(isset($traveler_details->salinfant)){					
			if($traveler_details->mnameinfant[$aaa] == ''){
				$infText      = $traveler_details->lnameinfant[$aaa].'/'.$traveler_details->fnameinfant[$aaa].'/01JAN16';
			}else{
				$infText      = $traveler_details->lnameinfant[$aaa].'/'.$traveler_details->fnameinfant[$aaa]." ".'/01JAN16';
			}
			$travellers .= '<Service SSR_Code="INFT">
							<PersonName NameNumber="'.$a . '.1" />
							 <Text>'.$infText.'</Text>
							 <VendorPrefs><Airline Hosted="false"/></VendorPrefs>
						  </Service>';
		}
	   $a++;       
	}
    if(isset($traveler_details->salchild)){
        $c = $a;
        for($ccc=0;$ccc < count($traveler_details->salchild);$ccc++) { 	
			if($traveler_details->mnamechild[$aaa] == ''){
				$childText = 'P/IND/123456789/IND/01JAN10/M/30MAY30/'.$traveler_details->lnameadult[$ccc].'/'.$traveler_details->fnamechild[$ccc].'/H-'.$a .'.'.'1';
			}else{
				$childText = 'P/IND/123456789/IND/01JAN10/M/30MAY30/'.$traveler_details->lnamechild[$ccc].'/'.$traveler_details->fnamechild[$ccc]." ".$traveler_details->mnamechild[$ccc].'/H-'.$a .'.'.'1';
			}
			$travellers .= '<Service SSR_Code="DOCS">
							  <PersonName/>
							  <Text>'.$childText.'</Text>
							  <VendorPrefs><Airline Hosted="false"/></VendorPrefs>
							</Service>';
		   $a++; $c++;    
		}
    }
    
	$SpecialServiceRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service>SpecialServiceLLSRQ</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                    <SpecialServiceRQ Version='2.0.2' xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' ReturnHostCommand='true'>
                      <SpecialServiceInfo>
                        ".$travellers."
                      </SpecialServiceInfo>
                    </SpecialServiceRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
    $SpecialServiceRS = flight_processRequest($SpecialServiceRQ, $credencials['system']);    
    $SpecialServiceRQ_RS = array(
								  'SpecialServiceRQ' => $SpecialServiceRQ,
								  'SpecialServiceRS' => $SpecialServiceRS
								);  
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/SpecialServiceRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$SpecialServiceRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/SpecialServiceRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$SpecialServiceRS);fclose($fp);
    return $SpecialServiceRQ_RS;
}

function EndTransactionRQ($BinarySecurityToken, $search_id, $search_data1, $segment_data1, $traveler_details1, $Action = 'EndTransactionLLSRQ'){
    $credencials = set_credencials_flight();
    $EndTransactionRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">
          <SOAP-ENV:Header>
            <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
              <eb:From>
             <eb:PartyId eb:type="urn:x12.org.IO5:01">'.$credencials["from"].'</eb:PartyId>
              </eb:From>
              <eb:To>
                <eb:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</eb:PartyId>
              </eb:To>
              <eb:CPAId>'.$credencials["ipcc"].'</eb:CPAId>
              <eb:ConversationId>'.$credencials["conversation_id"].'</eb:ConversationId>
              <eb:Service>EndTransactionLLSRQ</eb:Service>
              <eb:Action>EndTransactionLLSRQ</eb:Action>
              <eb:MessageData>
                <eb:MessageId>mid:'.$credencials["message_id"].'</eb:MessageId>
                <eb:Timestamp>'.$credencials["timestamp"].'</eb:Timestamp>
                <eb:TimeToLive>'.$credencials["timetolive"].'</eb:TimeToLive>
                <eb:Timeout>40</eb:Timeout>
              </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
              <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">' . $BinarySecurityToken . '</wsse:BinarySecurityToken>
            </wsse:Security>
          </SOAP-ENV:Header>
            <SOAP-ENV:Body>
             <EndTransactionRQ Version="2.0.1" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <EndTransaction Ind="true">
            </EndTransaction>
          <Source ReceivedFrom="UTRAVEL"/>
        </EndTransactionRQ>
      </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>';
    $EndTransactionRS = flight_processRequest($EndTransactionRQ, $credencials['system']); 
    $EndTransactionRQ_RS = array(
							  'EndTransactionRQ' => $EndTransactionRQ,
							  'EndTransactionRS' => $EndTransactionRS
							);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/EndTransactionRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$EndTransactionRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/EndTransactionRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$EndTransactionRS);fclose($fp);    
    return $EndTransactionRQ_RS;
}

function EndTransactionRQFinal($BinarySecurityToken, $Name, $pnr,  $Action = 'EndTransactionLLSRQ'){
    $credencials = set_credencials_flight();
    $EndTransactionRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">
          <SOAP-ENV:Header>
            <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
              <eb:From>
                <eb:PartyId eb:type="urn:x12.org.IO5:01">'.$credencials["from"].'</eb:PartyId>
              </eb:From>
              <eb:To>
                <eb:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</eb:PartyId>
              </eb:To>
              <eb:CPAId>'.$credencials["ipcc"].'</eb:CPAId>
              <eb:ConversationId>'.$credencials["conversation_id"].'</eb:ConversationId>
              <eb:Service>EndTransactionLLSRQ</eb:Service>
              <eb:Action>EndTransactionLLSRQ</eb:Action>
              <eb:MessageData>
                <eb:MessageId>mid:'.$credencials["message_id"].'</eb:MessageId>
                <eb:Timestamp>'.$credencials["timestamp"].'</eb:Timestamp>
                <eb:TimeToLive>'.$credencials["timetolive"].'</eb:TimeToLive>
                <eb:Timeout>40</eb:Timeout>
              </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
              <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">' . $BinarySecurityToken . '</wsse:BinarySecurityToken>
            </wsse:Security>
          </SOAP-ENV:Header>
            <SOAP-ENV:Body>
             <EndTransactionRQ Version="2.0.1" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <EndTransaction Ind="true">
            </EndTransaction>
          <Source ReceivedFrom="' . $Name . '"/>
        </EndTransactionRQ>
      </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>';
    $EndTransactionRS 		= flight_processRequest($EndTransactionRQ, $credencials['system']); 
    $EndTransactionRQ_RS 	= array(
								  'EndTransactionRQ' => $EndTransactionRQ,
								  'EndTransactionRS' => $EndTransactionRS
								);							
    $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$pnr."/EndTransactionRQ.xml";
	$fp 	= fopen($path,"wb");fwrite($fp,$EndTransactionRQ);fclose($fp);
	
	$path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$pnr."/EndTransactionRS.xml";
	$fp 	= fopen($path,"wb");fwrite($fp,$EndTransactionRS);fclose($fp);  
    return $EndTransactionRQ_RS;   
}

function OTA_CancelRQ($BinarySecurityToken, $pnr, $Action = 'OTA_CancelLLSRQ'){
   $credencials = set_credencials_flight();
   $OTA_CancelRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service>OTA_CancelLLSRQ</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                    <OTA_CancelRQ Version='2.0.0' xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'>
                      <Segment Type='air'/>
                    </OTA_CancelRQ>                                        
                  </soap-env:Body>
              </soap-env:Envelope>";
    $OTA_CancelRS = flight_processRequest($OTA_CancelRQ, $credencials['system']);    
    $OTA_CancelRQ_RS = array(
      'OTA_CancelRQ' => $OTA_CancelRQ,
      'OTA_CancelRS' => $OTA_CancelRS
    );
    $path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$pnr."/OTA_CancelRQ.xml";
	$fp 	= fopen($path,"wb");fwrite($fp,$OTA_CancelRQ);fclose($fp);
	
	$path 	= $_SERVER['DOCUMENT_ROOT'] . "/utravel_v1/admin_cpanel/cancel_logs/".$pnr."/OTA_CancelRS.xml";
	$fp 	= fopen($path,"wb");fwrite($fp,$OTA_CancelRS);fclose($fp);    
    return $OTA_CancelRQ_RS;
}

function FareRuleRQ($BinarySecurityToken, $flight, $request, $Action = 'FareLLSRQ'){
      $credencials = set_credencials_flight();   
      $request=json_decode($request);
      $FlightSegment=json_decode($flight,true);
      $flight_=count($FlightSegment);
      // echo '<pre>';print_r($FlightSegment);die;
      
            $DepartureAirportCode=$FlightSegment[0]['OriginLocation'][$flight_-1];
       $ArrivalAirportCode=$FlightSegment[$flight_-1]['DestinationLocation'][$flight_-1];
       $DepartureTime=$FlightSegment[0]['timeOfDeparture'][$flight_-1];
       $MarketingAirlineCode=$FlightSegment[0]['MarketingAirline'][0];
       $DepartureDate=date('m-d',strtotime($FlightSegment[0]['dateOfDeparture'][$flight_-1]));

    $FareRuleRQ = "<?xml version='1.0' encoding='utf-8'?>
        <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service eb:type='OTA'>FareLLSRQ</eb:Service>
                          <eb:Action>".$Action."</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                      <FareRQ xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' Version='2.9.0'>
                        <OptionalQualifiers>
                           <FlightQualifiers>
                <VendorPrefs>
                  <Airline Code='".$MarketingAirlineCode."'/>
                </VendorPrefs>
              </FlightQualifiers>
                          <TimeQualifiers>
                            <TravelDateOptions Start='".$DepartureDate."'/>
                          </TimeQualifiers>
                        </OptionalQualifiers>
                        <OriginDestinationInformation>
                          <FlightSegment>
                             <DestinationLocation LocationCode='".$ArrivalAirportCode."'/>                         
                             <OriginLocation LocationCode='".$DepartureAirportCode."'/>
                          </FlightSegment>
                        </OriginDestinationInformation>
                      </FareRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";    
   // if(true){
   
    $FareRuleRS =flight_processRequest($FareRuleRQ,$credencials['system']); 
    $FareRuleRqRS = array(
      'FareRuleRQ' => $FareRuleRQ,
      'FareRuleRS' => $FareRuleRS
    ); 
    // echo "<pre/>";print_r($FareRuleRS);exit();
    return $FareRuleRqRS;
}

function OTA_AirRulesRQ($BinarySecurityToken,$FareBasis,$flight, $request){
	// echo '<pre>';print_r($FareBasis);die;
	 $credencials = set_credencials_flight();   
      $request=json_decode($request);
      $FlightSegment=json_decode($flight,true);
      $flight_=count($FlightSegment);
      // echo '<pre>';print_r($FlightSegment);die;
      
       $DepartureAirportCode=$FlightSegment[0]['OriginLocation'][$flight_-1];
       $ArrivalAirportCode=$FlightSegment[$flight_-1]['DestinationLocation'][$flight_-1];
       $DepartureTime=$FlightSegment[0]['timeOfDeparture'][$flight_-1];
       $MarketingAirlineCode=$FlightSegment[0]['MarketingAirline'][0];
       $DepartureDate=date('m-d',strtotime($FlightSegment[0]['dateOfDeparture'][$flight_-1]));	
	 
      for($i=0;$i<count($FareBasis);$i++){    
      // echo '<pre/>';print_r($FareBasisCode);
      // $FareBasisCode = 'POW12M1';
      $OTA_AirRulesRQ = "<?xml version='1.0' encoding='utf-8'?>
              <soap-env:Envelope xmlns:soap-env='http://schemas.xmlsoap.org/soap/envelope/'>
                  <soap-env:Header>
                      <eb:MessageHeader
                          xmlns:eb='http://www.ebxml.org/namespaces/messageHeader'>
                          <eb:From>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>".$credencials['from']."</eb:PartyId>
                          </eb:From>
                          <eb:To>
                              <eb:PartyId eb:type='urn:x12.org.IO5:01'>webservices.sabre.com</eb:PartyId>
                          </eb:To>
                          <eb:ConversationId>".$credencials['conversation_id']."</eb:ConversationId>
                          <eb:Service>OTA_AirRulesLLSRQ</eb:Service>
                          <eb:Action>OTA_AirRulesLLSRQ</eb:Action>
                          <eb:CPAID>".$credencials['ipcc']."</eb:CPAID>
                          <eb:MessageData>
                              <eb:MessageId>".$credencials['message_id']."</eb:MessageId>
                              <eb:Timestamp>".$credencials['timestamp']."</eb:Timestamp>
                              <eb:TimeToLive>".$credencials['timetolive']."</eb:TimeToLive>
                          </eb:MessageData>
                      </eb:MessageHeader>
                      <wsse:Security xmlns:wsse='http://schemas.xmlsoap.org/ws/2002/12/secext'>
                          <wsse:UsernameToken>
                              <wsse:Username>".$credencials['username']."</wsse:Username>
                              <wsse:Password>".$credencials['password']."</wsse:Password>
                              <Organization>".$credencials['ipcc']."</Organization>
                              <Domain>Default</Domain>
                          </wsse:UsernameToken>
                          <wsse:BinarySecurityToken>".$BinarySecurityToken."</wsse:BinarySecurityToken>
                      </wsse:Security>
                  </soap-env:Header>
                  <soap-env:Body>
                      <OTA_AirRulesRQ xmlns='http://webservices.sabre.com/sabreXML/2011/10' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' ReturnHostCommand='true' Version='2.2.0'>
                        <OriginDestinationInformation>
                          <FlightSegment DepartureDateTime='" . $DepartureDate . "'>
                <DestinationLocation LocationCode='".$ArrivalAirportCode."'/>
                <MarketingCarrier Code='" . $MarketingAirlineCode . "'/>
                <OriginLocation LocationCode='".$DepartureAirportCode."'/>
              </FlightSegment>
                        </OriginDestinationInformation>
                        <RuleReqInfo>
              <FareBasis Code='" . $FareBasis[$i] ."'/>
            </RuleReqInfo>
                      </OTA_AirRulesRQ>
                  </soap-env:Body>
              </soap-env:Envelope>";
      $OTA_AirRulesRS = flight_processRequest($OTA_AirRulesRQ, $credencials['system']);   
      
	  $OTA_AirRulesRqRQ = array(
      'OTA_AirRulesRQ' => $OTA_AirRulesRQ,
      'OTA_AirRulesRS' => $OTA_AirRulesRS
    ); 
    // echo "<pre/>";print_r($OTA_AirRulesRqRQ);exit();
    return $OTA_AirRulesRqRQ; 
    }
}

function seatmap($BinarySecurityToken,$flight,$request){
	//echo '<pre/>';print_r($flight);die;
	 $credencials = set_credencials_flight();   
      $request=json_decode($request);
      $FlightSegment=json_decode($flight,true);
      $flight_=count($FlightSegment);
      
      $DepartureAirportCode=$FlightSegment[0]['OriginLocation'][$flight_-1];
       $ArrivalAirportCode=$FlightSegment[$flight_-1]['DestinationLocation'][$flight_-1];
       $DepartureTime=$FlightSegment[0]['timeOfDeparture'][$flight_-1];
       $MarketingAirlineCode=$FlightSegment[0]['MarketingAirline'][0];
       $DepartureDate=date('Y-m-d',strtotime($FlightSegment[0]['dateOfDeparture'][$flight_-1]));
        $ArrivalDate=date('Y-m-d',strtotime($FlightSegment[$flight_-1]['dateOfArrival'][$flight_-1]));		
	
	

$Air_SeatmapRQ = '<ns6:EnhancedSeatMapRQ xmlns="http://services.sabre.com/STL/v02" xmlns:ns2="http://opentravel.org/common/message/v02" xmlns:ns3="http://opentravel.org/common/v02" xmlns:ns4="http://services.sabre.com/STL_Payload/v02_00" xmlns:ns5="http://stl.sabre.com/Merchandising/v1" xmlns:ns6="http://stl.sabre.com/Merchandising/v4" xmlns:ext="http://stl.sabre.com/Merchandising/diagnostics/v1">
	<ns6:SeatMapQueryEnhanced correlationID="50468727">
		<ns6:RequestType>Payload</ns6:RequestType>
		<ns6:Flight destination="'.$ArrivalAirportCode.'" origin="'.$DepartureAirportCode.'">
			<ns6:DepartureDate>'.$DepartureDate.'</ns6:DepartureDate>
			<ns6:Operating carrier="'.$MarketingAirlineCode.'">1023</ns6:Operating>
			<ns6:Marketing carrier="'.$MarketingAirlineCode.'">1023</ns6:Marketing>
			<ns6:ArrivalDate>'.$ArrivalDate.'</ns6:ArrivalDate>
		</ns6:Flight>
		<ns6:CabinDefinition>
			<ns6:RBD>M</ns6:RBD>
		</ns6:CabinDefinition>
		<ns6:Currency>USD</ns6:Currency>
		<ns6:FareAvailQualifiers accompaniedByInfantInd="false">
			<ns6:TravellerID>1</ns6:TravellerID>
			<ns6:GivenName>KJW</ns6:GivenName>
			<ns6:Surname>ZQBS</ns6:Surname>
		</ns6:FareAvailQualifiers>
		<ns6:POS company="1S">
			<ns6:PCC>F4X0</ns6:PCC>
		</ns6:POS>
		<ns6:JourneyData>
			<ns6:JourneyFlight>
			
				<ns6:Flight destination="'.$ArrivalAirportCode.'" origin="'.$DepartureAirportCode.'">
					<ns6:DepartureDate>'.$DepartureDate.'</ns6:DepartureDate>
					<ns6:Operating carrier="'.$MarketingAirlineCode.'">1023</ns6:Operating>
					<ns6:Marketing carrier="'.$MarketingAirlineCode.'">1023</ns6:Marketing>
					<ns6:ArrivalDate>'.$ArrivalDate.'</ns6:ArrivalDate>
				</ns6:Flight>
				
				<ns6:FlightFlxData>
					<ns6:CnxxIndicator>N</ns6:CnxxIndicator>
					<ns6:MarriedSegment>0</ns6:MarriedSegment>
					<ns6:MarriedRef>0</ns6:MarriedRef>
					<ns6:ClassOfService>M</ns6:ClassOfService>
					<ns6:ActionCode>SS</ns6:ActionCode>
				</ns6:FlightFlxData>
			</ns6:JourneyFlight>
		</ns6:JourneyData>
	</ns6:SeatMapQueryEnhanced>
</ns6:EnhancedSeatMapRQ>';
$fp = fopen('request.xml', 'w+');
fwrite($fp, $Air_SeatmapRQ);
fclose($fp);
 $OTA_AirRulesRS = flight_processRequest($Air_SeatmapRQ, $credencials['system']);
	echo "<pre/>SSea";print_r($OTA_AirRulesRS);die();
	
	
	
	
}

function QueueAnalysisRQ($BinarySecurityToken, $PNR_NUMBER, $Action = 'QueueAnalysisLLSRQ'){
    $credencials = set_credencials_flight();
    $QueueAnalysisRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">
          <SOAP-ENV:Header>
            <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
              <eb:From>
             <eb:PartyId eb:type="urn:x12.org.IO5:01">'.$credencials["from"].'</eb:PartyId>
              </eb:From>
              <eb:To>
                <eb:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</eb:PartyId>
              </eb:To>
              <eb:CPAId>'.$credencials["ipcc"].'</eb:CPAId>
              <eb:ConversationId>'.$credencials["conversation_id"].'</eb:ConversationId>
              <eb:Service>QueueAnalysisLLSRQ</eb:Service>
              <eb:Action>QueueAnalysisLLSRQ</eb:Action>
              <eb:MessageData>
                <eb:MessageId>mid:'.$credencials["message_id"].'</eb:MessageId>
                <eb:Timestamp>'.$credencials["timestamp"].'</eb:Timestamp>
                <eb:TimeToLive>'.$credencials["timetolive"].'</eb:TimeToLive>
                <eb:Timeout>40</eb:Timeout>
              </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
              <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">' . $BinarySecurityToken . '</wsse:BinarySecurityToken>
            </wsse:Security>
          </SOAP-ENV:Header>
            <SOAP-ENV:Body>
             <QueueAnalysisRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" TimeStamp="2012-04-30T15:30:00-06:00" Version="2.0.0">
				<QueueInfo><QueueIdentifier PseudoCityCode="'.$credencials["ipcc"].'"/></QueueInfo>
			 </QueueAnalysisRQ>
      </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>';
    $QueueAnalysisRs = flight_processRequest($QueueAnalysisRQ, $credencials['system']); 
    $QueueAnalysisRQ_RS = array(
							  'QueueAnalysisRQ' => $QueueAnalysisRQ,
							  'QueueAnalysisRs' => $QueueAnalysisRs
							);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueueAnalysisRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueueAnalysisRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueueAnalysisRs.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueueAnalysisRs);fclose($fp);    
    return $QueueAnalysisRQ_RS;
}

function QueueAccessRQ($BinarySecurityToken, $PNR_NUMBER, $Action = 'QueueAccessLLSRQ'){
    $credencials = set_credencials_flight();
    $QueueAccessRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">
          <SOAP-ENV:Header>
            <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
              <eb:From>
             <eb:PartyId eb:type="urn:x12.org.IO5:01">'.$credencials["from"].'</eb:PartyId>
              </eb:From>
              <eb:To>
                <eb:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</eb:PartyId>
              </eb:To>
              <eb:CPAId>'.$credencials["ipcc"].'</eb:CPAId>
              <eb:ConversationId>'.$credencials["conversation_id"].'</eb:ConversationId>
              <eb:Service>QueueAccessLLSRQ</eb:Service>
              <eb:Action>QueueAccessLLSRQ</eb:Action>
              <eb:MessageData>
                <eb:MessageId>mid:'.$credencials["message_id"].'</eb:MessageId>
                <eb:Timestamp>'.$credencials["timestamp"].'</eb:Timestamp>
                <eb:TimeToLive>'.$credencials["timetolive"].'</eb:TimeToLive>
                <eb:Timeout>40</eb:Timeout>
              </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
              <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">' . $BinarySecurityToken . '</wsse:BinarySecurityToken>
            </wsse:Security>
          </SOAP-ENV:Header>
            <SOAP-ENV:Body>
             <QueueAccessRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" TimeStamp="2014-10-13T10:00:00-06:00" Version="2.0.6">
				<QueueIdentifier Number="7" PseudoCityCode="'.$credencials["ipcc"].'"/>
			 </QueueAccessRQ>
      </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>';
    $QueueAccessRS = flight_processRequest($QueueAccessRQ, $credencials['system']); 
    $QueueAccessRQ_RS = array(
							  'QueueAccessRQ' => $QueueAccessRQ,
							  'QueueAccessRS' => $QueueAccessRS
							);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueueAccessRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueueAccessRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueueAccessRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueueAccessRS);fclose($fp);    
    return $QueueAccessRQ_RS;
}

function QueueCountRQ($BinarySecurityToken, $PNR_NUMBER, $Action = 'QueueCountLLSRQ'){
    $credencials = set_credencials_flight();
    $QueueCountRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">
          <SOAP-ENV:Header>
            <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
              <eb:From>
             <eb:PartyId eb:type="urn:x12.org.IO5:01">'.$credencials["from"].'</eb:PartyId>
              </eb:From>
              <eb:To>
                <eb:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</eb:PartyId>
              </eb:To>
              <eb:CPAId>'.$credencials["ipcc"].'</eb:CPAId>
              <eb:ConversationId>'.$credencials["conversation_id"].'</eb:ConversationId>
              <eb:Service>QueueCountLLSRQ</eb:Service>
              <eb:Action>QueueCountLLSRQ</eb:Action>
              <eb:MessageData>
                <eb:MessageId>mid:'.$credencials["message_id"].'</eb:MessageId>
                <eb:Timestamp>'.$credencials["timestamp"].'</eb:Timestamp>
                <eb:TimeToLive>'.$credencials["timetolive"].'</eb:TimeToLive>
                <eb:Timeout>40</eb:Timeout>
              </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
              <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">' . $BinarySecurityToken . '</wsse:BinarySecurityToken>
            </wsse:Security>
          </SOAP-ENV:Header>
            <SOAP-ENV:Body>
             <QueueCountRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" TimeStamp="2015-11-16T11:00:00-06:00" Version="2.2.0">
				<QueueInfo><QueueIdentifier PseudoCityCode="'.$credencials["ipcc"].'"/></QueueInfo>
			 </QueueCountRQ>
      </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>';
    $QueueCountRS = flight_processRequest($QueueCountRQ, $credencials['system']); 
    $QueueCountRQ_RS = array(
							  'QueueCountRQ' => $QueueCountRQ,
							  'QueueCountRS' => $QueueCountRS
							);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueueCountRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueueCountRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueueCountRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueueCountRS);fclose($fp);    
    return $QueueCountRQ_RS;
}

function QueuePlaceRQ($BinarySecurityToken, $PNR_NUMBER, $Action = 'QueuePlaceLLSRQ'){
    $credencials = set_credencials_flight();
    $QueuePlaceRQ = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">
          <SOAP-ENV:Header>
            <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
              <eb:From>
             <eb:PartyId eb:type="urn:x12.org.IO5:01">'.$credencials["from"].'</eb:PartyId>
              </eb:From>
              <eb:To>
                <eb:PartyId type="urn:x12.org:IO5:01">webservices.sabre.com</eb:PartyId>
              </eb:To>
              <eb:CPAId>'.$credencials["ipcc"].'</eb:CPAId>
              <eb:ConversationId>'.$credencials["conversation_id"].'</eb:ConversationId>
              <eb:Service>QueuePlaceLLSRQ</eb:Service>
              <eb:Action>QueuePlaceLLSRQ</eb:Action>
              <eb:MessageData>
                <eb:MessageId>mid:'.$credencials["message_id"].'</eb:MessageId>
                <eb:Timestamp>'.$credencials["timestamp"].'</eb:Timestamp>
                <eb:TimeToLive>'.$credencials["timetolive"].'</eb:TimeToLive>
                <eb:Timeout>40</eb:Timeout>
              </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
              <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">' . $BinarySecurityToken . '</wsse:BinarySecurityToken>
            </wsse:Security>
          </SOAP-ENV:Header>
            <SOAP-ENV:Body>
             <QueuePlaceRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" TimeStamp="2014-09-07T09:30:00-06:00" Version="2.0.4">
				 <QueueInfo>
					<QueueIdentifier Number="100" PseudoCityCode="'.$credencials["ipcc"].'"/>
					<UniqueID ID="'.$PNR_NUMBER.'"/>
				</QueueInfo>
			 </QueuePlaceRQ>
      </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>';
    $QueuePlaceRS = flight_processRequest($QueuePlaceRQ, $credencials['system']); 
    $QueuePlaceRQ_RS = array(
							  'QueuePlaceRQ' => $QueuePlaceRQ,
							  'QueuePlaceRS' => $QueuePlaceRS
							);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueuePlaceRQ.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueuePlaceRQ);fclose($fp);
	
	$path = $_SERVER['DOCUMENT_ROOT'] . "/WDMA/utravel/booking_logs/".$search_id."/QueuePlaceRS.xml";
	$fp = fopen($path,"wb");fwrite($fp,$QueuePlaceRS);fclose($fp);    
    return $QueuePlaceRQ_RS;
}

function flight_processRequest($XML, $URL){
  $httpHeader = array( 'Content-Type: text/xml; charset="utf-8"',);
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $URL); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
  curl_setopt($ch, CURLOPT_POST, TRUE); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, $XML);
  // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  // curl_setopt($ch, CURLOPT_SSLVERSION, 4); 
  curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
  $response = curl_exec($ch);
  return $response;
}
?>
