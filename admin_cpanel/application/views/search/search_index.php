
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
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li class="active"><strong>Search Page</strong></li>
			</ol>
			<section class="search-results-env">
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-tabs right-aligned">
							<li class="active"><a href="#pages">Google Search</a></li>
						</ul>
						<div class="search-results-panes">							
							<div class="search-results-pane active" id="pages">	
								<form method="get" class="searchcontrol" action="" enctype="application/x-www-form-urlencoded">
									<div class="input-group" id="searchcontrol">
										<!--<input type="text" class="form-control input-lg" name="search" placeholder="Search for something...">-->
										<div class="input-group-btn" style="display:none;">
											<button type="submit" class="btn btn-lg btn-primary btn-icon">Search<i class="entypo-search"></i></button>
										</div>
									</div>							
								</form>
								<!--<div id="searchcontrol" class="form-control input-lg" >Loading</div>-->
							</div>
						</div>
					</div>
				</div>
			</section>

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
		google.load('search', '1', {"language" : "en"});
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
		  searchControl.setResultSetSize(8);

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
