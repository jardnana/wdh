
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Dashboard</title>	
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
</head>
<body class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<!-- <div class="page-container horizontal-menu with-sidebar right-sidebar">-->
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> sidebar-collapsed">
		<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		
		<div class="main-content">
		
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>

				
<hr />
			<ol class="breadcrumb bc-3">
						<li>
				<a href="index.html"><i class="entypo-home"></i>Home</a>
			</li>
					<li>
			
							<a href="extra-icons.html">Extra</a>
					</li>
				<li class="active">
			
							<strong>Search Page</strong>
					</li>
					</ol>
			

<section class="search-results-env">
	
	<div class="row">
		<div class="col-md-12">
						
			
			<!-- Search categories tabs -->			<ul class="nav nav-tabs right-aligned">
				<li class="tab-title pull-left" style="display:none;">
					<div class="search-string">10 results found for: <strong>&ldquo;this&rdquo;</strong></div>
				</li>
				
				<li class="active">
					<a href="#pages">
						All
						<span class="disabled-text">(31)</span>
					</a>
				</li>
				<li>
					<a href="#members">Users</a>
				</li>
				<li>
					<a href="#messages">Messages</a>
				</li>
			</ul>
			
			<!-- Search search form -->			
			
			
			<!-- Search search form -->			<div class="search-results-panes">
				
				<div class="search-results-pane active" id="pages">
					
				
					<form method="get" class="searchcontrol" action="" enctype="application/x-www-form-urlencoded">
				
				<div class="input-group" id="searchcontrol">
					<!--<input type="text" class="form-control input-lg" name="search" placeholder="Search for something...">-->
					
					<div class="input-group-btn" style="display:none;">
						<button type="submit" class="btn btn-lg btn-primary btn-icon">
							Search 
							<i class="entypo-search"></i>
						</button>
					</div>
				</div>
				
			</form>
					<!--<div id="searchcontrol" class="form-control input-lg" >Loading</div>-->
					
				</div>
				
				<div class="search-results-pane" id="members">
					
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th width="4%" class="text-center">Pic</th>
								<th>Full Name</th>
								<th width="40%">Occupation</th>
								<th class="text-center" width="25%">Items Purchased</th>
							</tr>
						</thead>
						<tbody>
						
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-1.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Joseph B. Wilson</td>
								<td class="middle-align">Dental technician</td>
								<td class="text-center middle-align">10</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-2.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Barbara A. Ganley</td>
								<td class="middle-align">Anchor</td>
								<td class="text-center middle-align">32</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-3.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Isaac D. Webb</td>
								<td class="middle-align">Chef</td>
								<td class="text-center middle-align">83</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-4.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Tara B. Rosen</td>
								<td class="middle-align">Family and general practitioner</td>
								<td class="text-center middle-align">24</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-2.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Sandra R. Capetillo</td>
								<td class="middle-align">Manpower development advisor</td>
								<td class="text-center middle-align">58</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-1.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Dewey T. Reid</td>
								<td class="middle-align">Aircraft engineer</td>
								<td class="text-center middle-align">30</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-4.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Ashley H. Lehman</td>
								<td class="middle-align">Community support worker</td>
								<td class="text-center middle-align">28</td>
							</tr>
							
							<tr>
								<td class="text-center middle-align">
									<a href="#">
										<img src="assets/images/thumb-3.png" alt="" width="40" class="img-rounded" />
									</a>
								</td>
								<td class="middle-align">Michael V. Lindsey</td>
								<td class="middle-align">Engineering technician</td>
								<td class="text-center middle-align">16</td>
							</tr>
							
						</tbody>
					</table>
					
				</div>
				
				<div class="search-results-pane" id="messages">
					
					<table class="table table-bordered search-results-messages">
						<thead>
							<tr>
								<th width="1%" class="text-center">
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</th>
								<th width="30%">From</th>
								<th>Subject</th>
								<th width="15%">Date</th>
							</tr>
						</thead>
						<tbody>
							<tr class="unread">
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star stared">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Facebook</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Reset your account password
									</a>
								</td>
								<td>
									<div class="disabled-text">13:52</div>
								</td>
							</tr>
							<tr class="unread">
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Google AdWords</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Google AdWords: Ads not serving
									</a>
								</td>
								<td>
									<div class="disabled-text">09:27</div>
								</td>
							</tr>
							
							<tr>
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Apple.com</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Your apple account ID has been accessed from un-familiar location.
									</a>
								</td>
								<td>
									<div class="disabled-text">Today</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">World Weather Online</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Over Throttle Alert
									</a>
								</td>
								<td>
									<div class="disabled-text">Yesterday</div>
								</td>
							</tr>
							<tr class="unread">
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star stared">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Dropbox</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Complete your Dropbox setup!
									</a>
								</td>
								<td>
									<div class="disabled-text">4 Dec</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Arlind Nushi</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Work progress for Provab Project
									</a>
								</td>
								<td>
									<div class="disabled-text">28 Nov</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Jose D. Gardner</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Regarding to your website issues.
									</a>
								</td>
								<td>
									<div class="disabled-text">22 Nov</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star stared">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Aurelio D. Cummins</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										Steadicam operator
									</a>
								</td>
								<td>
									<div class="disabled-text">15 Nov</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="checkbox checkbox-replace">
										<input type="checkbox" />
									</div>
								</td>
								<td>
									<a href="#" class="star">
										<i class="entypo-star"></i>
									</a>
									<a href="mailbox-message.html">Filan Fisteku</a>
								</td>
								<td>
									<a href="mailbox-message.html">
										You are loosing clients because your website is not responsive.
									</a>
								</td>
								<td>
									<div class="disabled-text">02 Nov</div>
								</td>
							</tr>
							
						</tbody>
					</table>
					
				</div>
				
			</div>
			
		</div>
	</div>
	
</section><!-- Footer -->

			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Footer -->
			<?php $this->load->view('general/chat');	?>	
	</div>

	<!-- Sample Modal (Default skin) -->
	<div class="modal fade" id="sample-modal-dialog-1">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Widget Options - Default Modal</h4>
				</div>
				
				<div class="modal-body">
					<p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Sample Modal (Skin inverted) -->
	<div class="modal invert fade" id="sample-modal-dialog-2">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
				</div>
				
				<div class="modal-body">
					<p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Sample Modal (Skin gray) -->
	<div class="modal gray fade" id="sample-modal-dialog-3">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
				</div>
				
				<div class="modal-body">
					<p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
				</div>
				 
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/provab-notes.js"></script>
	
	
	<!-------------------start search web--------------->
	 <script src="https://www.google.com/jsapi" type="text/javascript"></script>
    <script language="Javascript" type="text/javascript">
		google.load('search', '1');
		function OnLoad() {
		  // Create a search control
		  var searchControl = new google.search.SearchControl();

		  // Add in a full set of searchers
		  var localSearch = new google.search.LocalSearch();
		 searchControl.addSearcher(localSearch);
		  searchControl.addSearcher(new google.search.WebSearch());
		  searchControl.addSearcher(new google.search.VideoSearch());
		  searchControl.addSearcher(new google.search.BlogSearch());
		  searchControl.addSearcher(new google.search.NewsSearch());
		 searchControl.addSearcher(new google.search.ImageSearch());
		  searchControl.addSearcher(new google.search.BookSearch());
		  searchControl.addSearcher(new google.search.PatentSearch());

		  // Set the Local Search center point
		  localSearch.setCenterPoint("India, IN");

		  // tell the searcher to draw itself and tell it where to attach
		  searchControl.draw(document.getElementById("searchcontrol"));

		  // execute an inital search
		  searchControl.execute("provab");
		}
		google.setOnLoadCallback(OnLoad);
    </script>
	<style>
		/* default+en.css line no:7*/
	.gsc-control {
width: 100% !important;
}
/* default+en.css line no:1356*/
.gs-result .gs-title, .gs-result .gs-title * {
color: #373e4a;
text-decoration: none;
font-size: 18px;
margin: 0;
margin-bottom: 10px;
}
/* default+en.css line no:1379*/
.gs-result a.gs-visibleUrl, .gs-result .gs-visibleUrl {
color: #ec5956;
text-decoration: none;
}

.gsc-table-result tr:hover
 {
	background: #f9f9f9;
  color: #818da2;
}
.gsc-table-result tr:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;

}
.searchcontrol{
	padding:25px;
	margin-bottom:30px;
}

.gsc-input gsc-input-focus {
height: 41px;
padding: 10px 16px;
font-size: 15px;
line-height: 1.33;
border-radius: 3px;
}
/* 298 */
input.gsc-input {
padding: 1px 6px;
border: 1px solid #DDD;
width: 99%;
height: 32px !important;
border-radius: 5px;
}
.gsc-search-button{
	height:30px;
}
	</style>
	
		<!------------------- end search web--------------->
</body>
</html>
