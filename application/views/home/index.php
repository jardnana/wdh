<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="TRABBLE - Tour, Travel, Travel Agency Template">
	<meta name="keywords" content="Tour, Travel, Travel Agency Template">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>:: WDH ::</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<?php $this->load->view('common/css'); ?>
</head>
<body> 
	<?php $this->load->view('common/header'); ?>
	<div class="baner">
		<div class="mask">
			<div class="ttl">
				<h3>Discover Hot Deals on hotel booking</h3>
				<p>Search over 450 airlines and more than 320,000 hotels around the world.
				</p>
			</div>			
			<section class="tabbased-search-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="tabbable-menu">
								<ul class="tab-menu" id="myTab1">
									<li><h6><a href="#flights" data-easein="fadeIn"> <i class="fa fa-plane" aria-hidden="true"></i></a>Flight</h6>
									</li>
									<li><h6><a href="#hotels" data-easein="fadeIn"><i class="fa fa-building" aria-hidden="true"></i> </a>Hotel</h6>
									</li>
									<li class="active"><h6><a href="#bus" data-easein="fadeIn"> <i class="fa fa-bus" aria-hidden="true"></i></a>Bus</h6>
									</li>

									<li><h6><a href="#trains" data-easein="fadeIn"> <i class="fa fa-train" aria-hidden="true"></i></a>Train</h6>
									</li>
									<!-- <li><h6><a href="#ship"  data-easein="fadeIn"> <img src="<?php echo base_url();?>assets/images/icon/tour.png" alt=""></a></h6>
									</li>
									<li><h6><a href="#transfer"  data-easein="fadeIn"> <img src="<?php echo base_url();?>assets/images/icon/car.png" alt=""></a></h6>
									</li> -->
								</ul>
							</div> <!-- tab menu end here -->

							<!-- tab content strat here -->
							<div class="tab-content" id="tab-content1">
								<div class="tab-pane" id="flights">
									<div class="flights-form">
										<form action="#" method="post">
											<div class="col-md-4 pd5">
											<div class="row">
											<div class="col-md-6 pd5">
												<span class="maskimg f_from"></span>
												<input type="email" class="form-control brds" placeholder="Select a Location">
											</div>
											<div class="col-md-6 pd4">
												<span class="maskimg f_to"></span>
												<input type="email" class="form-control" placeholder="Destination City">
											</div>
											</div>
											</div>
											<div class="col-md-8 pd5">
												<div class="row">
											<div class="col-md-3 pd5">
												<span class="maskimg f_cal"></span>
												<input type="email" class="form-control" placeholder="Daparture date">
											</div>
											<div class="col-md-2 pd5">
												<span class="maskimg f_cal"></span>
												<input type="email" class="form-control" placeholder="Return date">
											</div>
											<div class="col-md-2 pd5">
												<div class="form-group">

													<select class="form-control fc" id="sel1">
														<option value=''>Economy</option>
													<option value='1'>1</option>
													<option value='2'>2</option>
													</select>
												</div>
												
											</div>
											<div class="col-md-1 pd5 wd4">
												<div class="form-group">

													<select class="form-control fc" id="sel1">
														<option value=''>Adult</option>
													<option value='1'>1</option>
													<option value='2'>2</option>
													</select>
												</div>
											</div>
											<div class="col-md-1 pd5 wd4">
												<div class="form-group">
													
													<select class="form-control fc" id="sel1">
														<option value=''>Kids</option>
													<option value='1'>1</option>
													<option value='2'>2</option>
													</select>
												</div>
											</div>

											<div class="col-md-3 pd5 bt4">
												<button type="submit" class="nbtm">Search</button>
											</div> 
											</div> 
											</div> 
											
										</form>
									</div>
								</div> <!-- flights form start here -->
								<div class="tab-pane" id="hotels">
									<div class="hotels-form">
										<form action="#" method="post">
											<div class="col-md-5 pd5">
											<div class="row">
											<div class="col-md-6 pd5">
												<span class="maskimg1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												<input type="email" class="form-control brds" placeholder="Your Destination">
											</div>
											<div class="col-md-6 ht4">

												<span class="maskimg1"><i class="fa fa-building" aria-hidden="true"></i></span>
												<input type="email" class="form-control" placeholder="Rooms">
											</div>
											</div>
											</div>
											<div class="col-md-7 pd5">
												<div class="row">
											<div class="col-md-3 pd5">
												<span class="maskimg f_cal"></span>
												<input type="email" class="form-control" id="datepicker2" placeholder="Daparture date">
											</div>
											<div class="col-md-3 pd5">
												<span class="maskimg f_cal"></span>
												<input type="email" class="form-control" id="datepicker3" placeholder="Return date">
											</div>
											<div class="col-md-3 pd5">
												<div class="form-group">
													
													<select class="form-control fc" id="sel1">
														<option value=''>Nationality</option>
													<option value='1'>1</option>
													<option value='2'>2</option>
													</select>
												</div>
											</div>
											
											
											

											<div class="col-md-3 pd5">
												<button type="submit" class="nbtm">Search</button>
											</div> 
											</div> 
											</div> 
											
										</form>
										
									</div>
								</div> <!-- hotel form end here -->
								 <!-- hotel form end here -->

								<div class="tab-pane active" id="bus">
									<div class="hotels-form">
										<form action="<?php echo base_url(); ?>bus/search" method="post">
											<div class="col-md-7 pd5">
											<div class="row">
											<div class="col-md-6 pd5">
												<span class="maskimg1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												<span class="fa fa-exchange" id="togglebtn"></span>
												<input type="text" id="from_city" name="from_city" class="form-control brds" placeholder="From" required>
											</div>
											<div class="col-md-6 bs4">

												<span class="maskimg1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												<input type="text" class="form-control" id="to_city" name="to_city" placeholder="To" required>
											</div>
											</div>
											</div>
											<div class="col-md-5 pd5">
												<div class="row">
											<div class="col-md-4 pd5">
												<span class="maskimg f_cal"></span>
												<input type="text" class="form-control" id="departing_1" name="departureDate" placeholder="Departure date" required>
											</div>
											<div class="col-md-4 pd5">
												<span class="maskimg f_cal"></span>
												<input type="text" class="form-control" name="returnDate" id="date_tavel_1" placeholder="Return(Optional)">
											</div>
											<div class="col-md-4 pd5">
												<button type="submit" class="nbtm">Search</button>
											</div> 
											</div> 
											</div> 
											
										</form>
										
									</div>
								</div> <!-- hotel form end here -->



								<div class="tab-pane" id="trains">
									<div class="flights-form">
										<form action="#" method="post">
											<div class="col-md-5 pd5">
											<div class="row">
											<div class="col-md-6 pd5">
												<span class="maskimg1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												<input type="email" class="form-control brds" placeholder="From">
											</div>
											<div class="col-md-6 ht4">
												<span class="maskimg1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
												<input type="email" class="form-control" placeholder="To">
											</div>
											</div>
											</div>
											<div class="col-md-7 pd5">
												<div class="row">
											<div class="col-md-3 pd5">
												<span class="maskimg f_cal"></span>
												<input type="email" class="form-control" placeholder="Daparture date">
											</div>
											<div class="col-md-3 pd5">
												<span class="maskimg f_cal"></span>
												<input type="email" class="form-control" placeholder="Return date">
											</div>
											<div class="col-md-3 pd5">
												<div class="form-group">

													<select class="form-control fc" id="sel1">
														<option value=''>Class</option>
													<option value='1'>1</option>
													<option value='2'>2</option>
													<option value='2'>3</option>
													</select>
												</div>
												
											</div>
											
											

											<div class="col-md-3 pd5">
												<button type="submit" class="nbtm">Search</button>
											</div> 
											</div> 
											</div> 
											
										</form>
									</div>
								</div> <!-- vehicles form end here -->

								<div class="tab-pane" id="ship">
									<div class="hotels-form">
										<form action="#" method="post">
											<div class="hotel-input-4-23 input-s">
												<input type="text" name="s" id="shippickupdate" class="hotel-input-first" placeholder="Pickup Date & time">
											</div>
											<div class="hotel-input-4-23 input-s">
												<input type="number" name="s" id="time" class="hotel-input-first" placeholder="Hours">
											</div>
											<div class="hotel-input-4-23 input-s">
												<input type="text" name="s" id="name" class="hotel-input-first" placeholder="Pickup Location">
											</div>
											<div class="hotel-input-4-23 input-s">
												<input type="text" name="s" id="drop-location" class="hotel-input-first" placeholder="Drop Location">
											</div>
											<div class="searc-btn-7">
												<button type="submit">Search</button>
											</div>
										</form>
									</div>
								</div><!-- ship form end here -->
								<div class="tab-pane" id="transfer">
									<div class="hotels-form">
										<form action="#" method="post">
											<div class="hotel-input-4-23 input-s">
												<input type="text" name="s" id="shippickupdate" class="hotel-input-first" placeholder="Pickup Date & time">
											</div>
											<div class="hotel-input-4-23 input-s">
												<input type="number" name="s" id="time" class="hotel-input-first" placeholder="Hours">
											</div>
											<div class="hotel-input-4-23 input-s">
												<input type="text" name="s" id="name" class="hotel-input-first" placeholder="Pickup Location">
											</div>
											<div class="hotel-input-4-23 input-s">
												<input type="text" name="s" id="drop-location" class="hotel-input-first" placeholder="Drop Location">
											</div>
											<div class="searc-btn-7">
												<button type="submit">Search</button>
											</div>
										</form>
									</div>
								</div><!-- ship form end here -->
							</div><!-- tab content end -->
						</div>
					</div>
				</div>
			</section> <!-- header tab based search area end-->
		</div>
	</div>

	<section class="popular-packages pb-70 pt-100">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="section-title text-center">
						<h2>The Best Hotels</h2>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus orci vel nibh aliquam laoreet Aenean accumsan </p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<div class="single-package">
						<div class="package-image">
							<a href="#"><img src="<?php echo base_url();?>assets/images/packages/1.jpg" alt="">
							</a>
						</div>
						<div class="package-content">
							<h3>Dubai – All Stunning Places</h3>
							<p>4 Days, 5 Nights <span> $500</span>
							</p>
						</div>
						<div class="package-calto-action">
							<ul class="ct-action">
								<li><a href="#" class="travel-booking-btn hvr-shutter-out-horizontal">Book Now</a>
								</li>
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
							</ul>
						</div>
					</div>
				</div> <!-- single package end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-package">
						<div class="package-image">
							<a href="#"><img src="<?php echo base_url();?>assets/images/packages/2.jpg" alt="">
							</a>
						</div>
						<div class="package-content">
							<h3>Thailand – All Stunning Places</h3>
							<p>4 Days, 5 Nights <span> $500</span>
							</p>
						</div>
						<div class="package-calto-action">
							<ul class="ct-action">
								<li><a href="#" class="travel-booking-btn hvr-shutter-out-horizontal">Book Now</a>
								</li>
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
							</ul>
						</div>
					</div>
				</div> <!-- single package end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-package">
						<div class="package-image">
							<a href="#"><img src="<?php echo base_url();?>assets/images/packages/3.jpg" alt="">
							</a>
						</div>
						<div class="package-content">
							<h3>England – All Stunning Places</h3>
							<p>4 Days, 5 Nights <span> $500</span>
							</p>
						</div>
						<div class="package-calto-action">
							<ul class="ct-action">
								<li><a href="#" class="travel-booking-btn hvr-shutter-out-horizontal"> Book Now </a>
								</li>
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
							</ul>
						</div>
					</div>
				</div> <!-- single package end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-package">
						<div class="package-image">
							<a href="#"><img src="<?php echo base_url();?>assets/images/packages/4.jpg" alt="">
							</a>
						</div>
						<div class="package-content">
							<h3>Italy – All Stunning Places</h3>
							<p>4 Days, 5 Nights <span> $500</span>
							</p>
						</div>
						<div class="package-calto-action">
							<ul class="ct-action">
								<li><a href="#" class="travel-booking-btn hvr-shutter-out-horizontal">Book Now</a>
								</li>
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
							</ul>
						</div>
					</div>
				</div> <!-- single package end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-package">
						<div class="package-image">
							<a href="#"><img src="<?php echo base_url();?>assets/images/packages/5.jpg" alt="">
							</a>
						</div>
						<div class="package-content">
							<h3>Brazil – All Stunning Places</h3>
							<p>4 Days, 5 Nights <span> $500</span>
							</p>
						</div>
						<div class="package-calto-action">
							<ul class="ct-action">
								<li><a href="#" class="travel-booking-btn hvr-shutter-out-horizontal">Book Now</a>
								</li>
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
							</ul>
						</div>
					</div>
				</div> <!-- single package end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-package">
						<div class="package-image">
							<a href="#"><img src="<?php echo base_url();?>assets/images/packages/6.jpg" alt="">
							</a>
						</div>
						<div class="package-content">
							<h3>India – All Stunning Places</h3>
							<p>4 Days, 5 Nights <span> $500</span>
							</p>
						</div>
						<div class="package-calto-action">
							<ul class="ct-action">
								<li><a href="#" class="travel-booking-btn hvr-shutter-out-horizontal">Book Now</a>
								</li>
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
							</ul>
						</div>
					</div>
				</div> <!-- single package end -->
			</div>
		</div>
	</section> <!--end  popular packajge -->


	<section class="trabble-bg image-bg-padding-100">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="section-title-white text-center">
						<h2>Why Choose WDH</h2>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus orci vel nibh aliquam laoreet Aenean accumsan </p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- single travel start -->
				<div class="col-md-4 col-sm-6">
					<div class="single-travel">
						<div class="media">
							<div class="media-left media-middle travel-number">
								<span><i class="fa fa-money" aria-hidden="true"></i></span>
							</div>
							<div class="media-body travel-content">
								<h4>Best Price Guarantee</h4>
								<p>Lorem ipsum dolor sit amet consect adiu piscing elit sed diam nonum euismo.</p>
							</div>
						</div>
					</div>
				</div> <!-- single travel end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-travel">
						<div class="media">
							<div class="media-left media-middle travel-number">
								<span><i class="fa fa-lock" aria-hidden="true"></i></span>
							</div>
							<div class="media-body travel-content">
								<h4>Trust &Safety</h4>
								<p>Lorem ipsum dolor sit amet consect adiu piscing elit sed diam nonum euismo tincidunt ut.</p>
							</div>
						</div>
					</div>
				</div> <!-- single travel end -->

				<div class="col-md-4 col-sm-6">
					<div class="single-travel">
						<div class="media">
							<div class="media-left media-middle travel-number">
								<span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
							</div>
							<div class="media-body travel-content">
								<h4>Best Destinations</h4>
								<p>Lorem ipsum dolor sit amet consect adiu piscing elit sed diam nonum euismo tincidunt ut.</p>
							</div>
						</div>
					</div>
				</div> <!-- single travel end -->
			</div>
		</div>
	</section>
<div class="section-paddings incredible-places">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="section-title text-center">
					<h2>Best Flight Deals</h2>
					<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus orci vel nibh aliquam laoreet Aenean accumsan</p>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<div class="single-place">
				<figure>
					<a href="#"><img src="<?php echo base_url();?>assets/images/place/1.jpg" alt="">
					</a>
					<figcaption>
						<h4>Flights Form Dubai To Delhi</h4>
						<h4><span class="dd">KWD 196.724</span></h4>
					</figcaption>
				</figure>
			</div>
		</div> <!-- end single place -->

		<div class="col-md-4 col-sm-6">
			<div class="single-place">
				<figure>
					<a href="#"><img src="<?php echo base_url();?>assets/images/place/2.jpg" alt="">
					</a>
					<figcaption>
						<h4>Flights Form Dubai To Delhi</h4>
						<h4><span class="dd">KWD 196.724</span></h4>
					</figcaption>
				</figure>
			</div>
		</div> <!-- end single place -->

		<div class="col-md-4 col-sm-6">
			<div class="single-place">
				<figure>
					<a href="#"><img src="<?php echo base_url();?>assets/images/place/3.jpg" alt="">
					</a>
					<figcaption>
						<h4>Flights Form Dubai To Delhi</h4>
						<h4><span class="dd">KWD 196.724</span></h4>
					</figcaption>
				</figure>
			</div>
		</div> <!-- end single place -->

		<div class="col-md-4 col-sm-6">
			<div class="single-place">
				<figure>
					<a href="#"><img src="<?php echo base_url();?>assets/images/place/4.jpg" alt="">
					</a>
					<figcaption>
						<h4>Flights Form Dubai To Delhi</h4>
						<h4><span class="dd">KWD 196.724</span></h4>
					</figcaption>
				</figure>
			</div>
		</div> <!-- end single place -->

		<div class="col-md-4 col-sm-6">
			<div class="single-place">
				<figure>
					<a href="#"><img src="<?php echo base_url();?>assets/images/place/5.jpg" alt="">
					</a>
					<figcaption>
						<h4>Flights Form Dubai To Delhi</h4>
						<h4><span class="dd">KWD 196.724</span></h4>
					</figcaption>
				</figure>
			</div>
		</div> <!-- end single place -->

		<div class="col-md-4 col-sm-6">
			<div class="single-place">
				<figure>
					<a href="#"><img src="<?php echo base_url();?>assets/images/place/3.jpg" alt="">
					</a>
					<figcaption>
						<h4>Flights Form Dubai To Delhi</h4>
						<h4><span class="dd">KWD 196.724</span></h4>
					</figcaption>
				</figure>
			</div>
		</div> <!-- end single place -->
	</div>
</div>

<!-- guide and Expert Advice strat -->
<section class="section-paddings ptp">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="section-title text-center">
					<h2>Best Destinations</h2>
					<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus orci vel nibh aliquam laoreet Aenean accumsan </p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- single travel blog-->
			<div class="col-md-4 col-sm-6 phone-layout-s">
				<div class="single-travel-blog">
					<div class="blog-image">
						<a href="#"><img src="<?php echo base_url();?>assets/images/blog/1.jpg" alt="">
						</a>
					</div>
					<div class="blog-content">
						<div class="blog-meta">
							<div class="post-date">
								<span><i class="fa fa-calendar"></i> 12 Sep, 2018</span>
							</div>
							<ul class="post-social">
								<li><a href="#"><i class="fa fa-comments"></i>3</a>
								</li>
								<li><a href="#"><i class="fa fa-heart-o"></i>43</a>
								</li>
							</ul>
						</div>
						<div class="blog-post-content">
							<h4>Tips for taking a long-term trip with kids.</h4>
							<p>Lorem ipsum dolor sit amet consepctetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus.</p>
							<!-- <a href="#">Read More <i class="fa fa-angle-right"></i></a> -->
						</div>
					</div>
				</div>
			</div> <!--end single travel guide & security-->

			<div class="col-md-4 col-sm-6 phone-layout-s">
				<div class="single-travel-blog">
					<div class="blog-image">
						<a href="#"><img src="<?php echo base_url();?>assets/images/blog/2.jpg" alt="">
						</a>
					</div>
					<div class="blog-content">
						<div class="blog-meta">
							<div class="post-date">
								<span><i class="fa fa-calendar"></i> 12 Aug, 2018</span>
							</div>
							<ul class="post-social">
								<li><a href="#"><i class="fa fa-comments"></i>3</a>
								</li>
								<li><a href="#"><i class="fa fa-heart-o"></i>43</a>
								</li>
							</ul>
						</div>
						<div class="blog-post-content">
							<h4>Tips for taking a long-term trip with kids.</h4>
							<p>Lorem ipsum dolor sit amet consepctetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus.</p>
							<!-- <a href="#">Read More <i class="fa fa-angle-right"></i></a> -->
						</div>
					</div>
				</div>
			</div> <!--end single travel guide & security-->

			<div class="col-md-4 col-sm-6 phone-layout-s">
				<div class="single-travel-blog">
					<div class="blog-image">
						<a href="#"><img src="<?php echo base_url();?>assets/images/blog/3.jpg" alt="">
						</a>
					</div>
					<div class="blog-content">
						<div class="blog-meta">
							<div class="post-date">
								<span><i class="fa fa-calendar"></i> 12 Jul, 2018</span>
							</div>
							<ul class="post-social">
								<li><a href="#"><i class="fa fa-comments"></i>3</a>
								</li>
								<li><a href="#"><i class="fa fa-heart-o"></i>43</a>
								</li>
							</ul>
						</div>
						<div class="blog-post-content">
							<h4>Tips for taking a long-term trip with kids.</h4>
							<p>Lorem ipsum dolor sit amet consepctetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus.</p>
							<!-- <a href="#">Read More <i class="fa fa-angle-right"></i></a> -->
						</div>
					</div>
				</div>
			</div> <!-- single travel guide & security end-->
		</div>
	</div>
</section> <!--End guide and Expert Advice strat -->
	<?php $this->load->view('common/footer'); ?>
	<div class="to-top pos-rtive">
		<a href="#"><i class = "fa fa-angle-up"></i></a>
		</div>
		<?php $this->load->view('common/js'); ?>
		<script>
			function openNav() {
				document.getElementById("mycart").style.width = "400px";
			}

			function closeNav() {
				document.getElementById("mycart").style.width = "0";
			}
		</script>
		<script>
			$(document).ready(function($) {
				$('.btnForgetPwd').click(function(event) {
					$('.frgtpswd').show();
					$('.login_m').hide();
				});
				$('.sup').click(function(event) {
					$('.frgtpswd').hide();
					$('.login_m').show();
				});
			});	
		</script>
		<script>
$(document).ready(function(){
    $('#departing_1').datepicker(
    {
      minDate : 0,
      dateFormat: 'dd-mm-yy',
      
    });

    $('#retirn_1').datepicker(
    {
      minDate : 1
    });

  });
</script> 
<script>
$(document).ready(function(){
    $('#date_tavel_1').datepicker(
    {
      minDate : 0,
      onClose: function()
      {
        var minDate = $(this).datepicker('getDate');
        minDate.setDate(minDate.getDate() + 1);
        date_selected = (minDate.getMonth() + 1) + '/' + (minDate.getDate()) + '/' + minDate.getFullYear();
        $('#date_retun_1').datepicker("option", "minDate", date_selected);
      }
    });

    $('#date_retun_1').datepicker(
    {
      minDate : 1
    });

  });
</script> 

</body>
</html>
