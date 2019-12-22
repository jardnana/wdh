<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if(session_status() == PHP_SESSION_NONE) { session_start(); } // error_reporting(E_ALL);
class Cronjob extends CI_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Currency_Model');
		// $this->check_admin_login();		
	}
	
	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
	        redirect('login','refresh');
        } else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
			// redirect('dashboard','refresh');
        } else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}
    }
    
    function ConverCurrency_Layer(){ ini_set('max_execution_time', 600);
		$currency_api_details = $this->Currency_Model->get_currency_api_details_byname('CURRENCY_LAYER');
		if(isset($currency_api_details->api_url) && $currency_api_details->api_url !=''){
			// $response 			= '{"success":true,"terms":"https:\/\/currencylayer.com\/terms","privacy":"https:\/\/currencylayer.com\/privacy","timestamp":1559051885,"source":"USD","quotes":{"USDAED":3.67315,"USDAFN":79.297564,"USDALL":109.780332,"USDAMD":480.145011,"USDANG":1.874899,"USDAOA":329.944025,"USDARS":44.848986,"USDAUD":1.442702,"USDAWG":1.8,"USDAZN":1.705011,"USDBAM":1.747898,"USDBBD":1.99145,"USDBDT":84.495497,"USDBGN":1.74815,"USDBHD":0.37705,"USDBIF":1849,"USDBMD":1,"USDBND":1.3506,"USDBOB":6.90265,"USDBRL":4.02795,"USDBSD":0.9988,"USDBTC":0.000115,"USDBTN":69.566531,"USDBWP":10.811032,"USDBYN":2.08055,"USDBYR":19600,"USDBZD":2.015596,"USDCAD":1.347055,"USDCDF":1651.999905,"USDCHF":1.00635,"USDCLF":0.025365,"USDCLP":699.901015,"USDCNY":6.911603,"USDCOP":3355.5,"USDCRC":590.964991,"USDCUC":1,"USDCUP":26.5,"USDCVE":98.4645,"USDCZK":23.098198,"USDDJF":177.719975,"USDDKK":6.672302,"USDDOP":54.999926,"USDDZD":119.449895,"USDEGP":16.842982,"USDERN":15.00056,"USDETB":28.888496,"USDEUR":0.8936,"USDFJD":2.15755,"USDFKP":0.78892,"USDGBP":0.788403,"USDGEL":2.785029,"USDGGP":0.788381,"USDGHS":5.264704,"USDGIP":0.78891,"USDGMD":49.694999,"USDGNF":9224.999832,"USDGTQ":7.67945,"USDGYD":210.225023,"USDHKD":7.84867,"USDHNL":24.462504,"USDHRK":6.635599,"USDHTG":90.336005,"USDHUF":292.074959,"USDIDR":14382.75,"USDILS":3.61448,"USDIMP":0.788381,"USDINR":69.570497,"USDIQD":1193.2,"USDIRR":42104.999942,"USDISK":123.959723,"USDJEP":0.788381,"USDJMD":133.519796,"USDJOD":0.70897,"USDJPY":109.491059,"USDKES":101.25004,"USDKGS":69.850355,"USDKHR":4052.999718,"USDKMF":439.496194,"USDKPW":899.994694,"USDKRW":1187.397226,"USDKWD":0.304204,"USDKYD":0.833355,"USDKZT":380.650153,"USDLAK":8699.550046,"USDLBP":1512.74991,"USDLKR":176.279756,"USDLRD":184.750379,"USDLSL":14.393972,"USDLTL":2.95274,"USDLVL":0.60489,"USDLYD":1.398596,"USDMAD":9.69375,"USDMDL":18.093975,"USDMGA":3659.999799,"USDMKD":54.965011,"USDMMK":1534.549528,"USDMNT":2645.333192,"USDMOP":8.08365,"USDMRO":357.000402,"USDMUR":35.550498,"USDMVR":15.460012,"USDMWK":722.555023,"USDMXN":19.09888,"USDMYR":4.184599,"USDMZN":62.290196,"USDNAD":14.395377,"USDNGN":359.480232,"USDNIO":32.848011,"USDNOK":8.68265,"USDNPR":111.440077,"USDNZD":1.527196,"USDOMR":0.38503,"USDPAB":0.999965,"USDPEN":3.34815,"USDPGK":3.37625,"USDPHP":52.256,"USDPKR":151.50986,"USDPLN":3.836797,"USDPYG":6267.203101,"USDQAR":3.640973,"USDRON":4.255399,"USDRSD":105.4101,"USDRUB":64.631009,"USDRWF":908.725,"USDSAR":3.751203,"USDSBD":8.20785,"USDSCR":13.682976,"USDSDG":45.098502,"USDSEK":9.546803,"USDSGD":1.376935,"USDSHP":1.320902,"USDSLL":8955.000016,"USDSOS":583.488836,"USDSRD":7.457972,"USDSTD":21050.59961,"USDSVC":8.749401,"USDSYP":515.000133,"USDSZL":14.617499,"USDTHB":31.803497,"USDTJS":9.42415,"USDTMT":3.51,"USDTND":3.002097,"USDTOP":2.29445,"USDTRY":6.013805,"USDTTD":6.77875,"USDTWD":31.513032,"USDTZS":2297.049781,"USDUAH":26.471001,"USDUGX":3759.749831,"USDUSD":1,"USDUYU":35.230082,"USDUZS":8450.000271,"USDVEF":9.987499,"USDVND":23394.55,"USDVUV":116.191497,"USDWST":2.663034,"USDXAF":586.279881,"USDXAG":0.069776,"USDXAU":0.000782,"USDXCD":2.70255,"USDXDR":0.72475,"USDXOF":586.239535,"USDXPF":107.000087,"USDYER":250.295457,"USDZAR":14.61235,"USDZMK":9001.196076,"USDZMW":13.425013,"USDZWL":322.355011}}'; // file_get_contents("http://apilayer.net/api/live?access_key=451976fa2d0007a6be27323eab1a6f83 ");		
			// $response 			= file_get_contents("http://apilayer.net/api/live?access_key=451976fa2d0007a6be27323eab1a6f83 ");		
			$response 			= file_get_contents(trim($currency_api_details->api_url).trim($currency_api_details->api_key));	
			$currency_values 	= json_decode($response);
			if (isset($currency_values->quotes) && $currency_values->quotes !='') {
				foreach($currency_values->quotes as $key => $values){
					$to_curreny = str_replace('USD',"",$key);
					if($to_curreny !='' && $values > 0){
						$value = number_format((float)$values, 2, '.', '');
						if($value > 0){
							$data	   = array('value' => $value);
							// Update the Currency Converter Details USD
							$this->db->where('currency_code',$to_curreny);
							$this->db->update('currency_converter_usd',$data);
							
							// Update the Currency Details
							$this->db->where('currency_code',$to_curreny);
							$this->db->update('currency_details',$data);
						}
					}
				}
				// $result = 'Currency updated Successfully';
				$result = 'success';
			}else{
				$result = 'Currency Converter API is down, Plese try again after some time';
			}
		}else{
			$result = 'Currency Converter API is disabled...';
		}
		echo $result;exit;		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
