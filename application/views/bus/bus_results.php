<!DOCTYPE html>
<html class="no-js" lang="zxx">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="description" content="TRABBLE - Tour, Travel, Travel Agency Template">
      <meta name="keywords" content="Tour, Travel, Travel Agency Template">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>:: WDH ::</title>
      <?php $this->load->view('common/css'); ?>
      <!-- <script src="js/vendor/modernizr-2.8.3.min.js"></script> -->
   </head>
   <body>
      <!-- Preloader -->
      <!-- <div id="preloader">
         <div id="status">&nbsp;</div>
         </div> -->  
      <!-- login end here -->
      <header>
         <div class="header-top-area">
            <div class="container">
               <div class="row">
                  <div class="header-top-left">
                     <div class="col-md-8 col-sm-8 col-xs-12">
                        <ul class="header-top-contact">
                           <li><i class="fa fa-envelope-o" aria-hidden="true"></i>technicalsupport@i2space.com</li>
                           <li><i class="fa fa-phone" aria-hidden="true"></i> +91 - 888 621 6947</li>
                        </ul>
                     </div>
                  </div>
                  <div class="header-top-right text-right">
                     <div class="col-md-4 col-xs-12 book-tab">
                        <ul class="lge">
                           <li></li>
                           <li>
                              <div class="book-btn">
                                 <a href="#" data-toggle="modal" data-target="#login"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="header-bottom-area" id="stick-header">
            <div class="container">
               <nav class="navbar navbar-inverse">
                  <div class="container-fluid">
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
                     </div>
                     <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                           <li><a href="#">HOME</a></li>
                           <li><a href="#">ABOUT US</a></li>
                           <li><a href="#"> HOTEL</a></li>
                           <li><a href="#"> FLIGHT</a></li>
                           <li><a href="#"> BUS</a></li>
                           <li><a href="#"> TRAIN</a></li>
                        </ul>
                     </div>
                  </div>
               </nav>
            </div>
         </div>
         <!-- header-bottom area end here -->
      </header>
      <!-- header area end here -->
      <section class="popular-packages">
         <div class="htlbg">
            <div class="mask1">
               <section class="tabbased-search-area tabsrch">
                  <div class="container">
                     <div class="lst">
                        <ul>
                           <li><a class="link-blue-2" href="#">home</a> / </li>
                           <li><a class="link-blue-2" href="#">Bus</a> / </li>
                           <li><span class="glod">Bus List</span></li>
                        </ul>
                        <h2 class="color-white"> ALL BUS FOR YOU</h2>
                        <h4 class="color-white1">WE FOUND: 150 BUS</h4>
                     </div>
                  </div>
               </section>
            </div>
         </div>
         <section class="section-wrapper grey-color-bg view-section">
            <div class="container">
               <div class="row">
                  <!-- Start Sidebar Filter  -->
                  <div class="col-md-3">
                     <div class="filter-head text-center">
                        <h5>Filter By</h5>
                     </div>
                     <div class="filter-area">
                        <!-- Start Filter Widget -->
                        <div class="price-filter filter">
                           <h6>Price</h6>
                           <p>
                              <input type="text" id="amount" readonly="" style="border:0; color:#343132; font-weight:400;">
                           </p>
                           <div id="slider-range"></div>
                        </div>
                        <!-- End Filter Widget -->
                        <!-- Start Filter Widget -->
                        <div class="filter">
                           <h6>Bus Type <small>Filter</small></h6>
                           <ul>
                              <li><label class="chck">AC 
                                 <input type="checkbox">
                                 <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li><label class="chck">Luxury
                                 <input type="checkbox">
                                 <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li><label class="chck">Non AC
                                 <input type="checkbox">
                                 <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li><label class="chck">Seater
                                 <input type="checkbox">
                                 <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li><label class="chck">Semi Sleeper
                                 <input type="checkbox">
                                 <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li><label class="chck">Sleeper
                                 <input type="checkbox">
                                 <span class="checkmark"></span>
                                 </label>
                              </li>
                           </ul>
                        </div>
                        <div class="filter">
                           <h6>Departure Time </h6>
                           <ul class="mrng">
                              <li><span class="ih"><img src="images/m1.png" alt=""></span>
                                 <span class="mg">5:00am <br/?>11:59am</span>
                              </li>
                              <li><span class="ih"><img src="images/m2.png" alt=""></span>
                                 <span class="mg">11:00 am <br/?>05:00 pm</span>
                              </li>
                              <li><span class="ih"><img src="images/m3.png" alt=""></span>
                                 <span class="mg">05:00 pm <br/?>11:00 pm</span>
                              </li>
                              <li><span class="ih"><img src="images/m4.png" alt=""></span>
                                 <span class="mg">11:00 pm <br/?>05:00 am</span>
                              </li>
                           </ul>
                        </div>
                        <div class="filter">
                           <div class="scrollbar" id="style-3">
                              <div class="force-overflow">
                                 <h6>Boarding Point <small>Filter</small></h6>
                                 <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="BOARDING POINT">
                                 </div>
                                 <ul>
                                    <li><label class="chck">Viyayanagar opp bmtc bus 
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Dr. Rajkumar road, rajaji 
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Majestic opp sit mayur 
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Majestic opp sit mayur 
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <!-- End Filter Widget -->
                        <!-- Start Filter Widget -->
                        <div class="filter">
                           <div class="scrollbar" id="style-3">
                              <div class="force-overflow">
                                 <h6>Dropping Point <small>Filter</small></h6>
                                 <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Dropping Point">
                                 </div>
                                 <ul>
                                    <li><label class="chck">Namakkal - karur highway
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Near Bus Stand
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Namakkal RKT
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Namakkal
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Namakkal
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                    <li><label class="chck">Near Kumaran Bakery
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                       </label>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <!-- End Filter Widget -->
                        <!-- Start Filter Widget -->
                        <!-- End Filter Widget -->
                     </div>
                  </div>
                  <!-- End Sidebar Filter  -->
                  <!-- Start Hotel Listing -->
                  <div class="col-md-9 text-center">
                     <div class="row">
                        <div class="col-lg-12 srt">
                           <div class="col-lg-3 col-sm-3 col-xs-6">
                              <div class="demo">
                                 <select>
                                    <option>Price</option>
                                    <option>Low to High </option>
                                    <option>High to Low</option>
                                 </select>
                                 <!-- select box end here -->
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-xs-6">
                              <div class="demo">
                                 <select>
                                    <option>Start Rating</option>
                                    <option>Low to High </option>
                                    <option>High to Low</option>
                                 </select>
                                 <!-- select box end here -->
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-xs-6">
                              <div class="demo">
                                 <select>
                                    <option>Name</option>
                                    <option>Ascending A-Z </option>
                                    <option>Descending Z-A </option>
                                 </select>
                                 <!-- select box end here -->
                              </div>
                           </div>
                           <div class="col-md-3"><i class="fa fa-list lstm"></i></div>
                        </div>
                        <div class="col-md-12 pad0">
                           
                           <div id="result"></div>

                        </div>
                     </div>
                     <!-- End List View  -->
                  </div>
                  <!-- End Hotel Listing -->
               </div>
            </div>
         </section>
      </section>
      <div class="all_loading imgLoader" id="search_loader">
   <div class="full_bg bg_relative">
      <div class="load_inner" style="padding:0px 15px;">
         <div class="flight_animation">
            <div class="flight_window1">
               <!-- <div class="window_wrap"></div> -->
               <div class="loader">
                  <div class="loader__bar"></div>
                  <div class="loader__bar"></div>
                  <div class="loader__bar"></div>
                  <div class="loader__bar"></div>
                  <div class="loader__bar"></div>
                  <div class="loader__ball"></div>
               </div>
               <div class="cloud_anim1"></div>
               <!-- <div class="window_shadow"></div> -->
            </div>
         </div>
         <div class="relativetop">
            <div class="paraload"> Results for Bus </div>
              <img src="<?php echo base_url();?>assets/images/logo.png" alt="logo" width="200px"> 
             <div class="gid">
              <div class="col-md-12 nopad"><img class="img-responsive" src="<?php echo base_url();?>assets/images/loader_img.gif"></div>
              </div>

            <div class="spinner">
            </div>
            <div class="clearfix"></div>
             <div class="scl252">

            <div class="sckintload ">
            
            
               <div class="ffty">
                  <div class="borddo brdrit"> <span class="lblbk"><?php echo $input_details[0]->departure_city; ?></span> </div>
               </div>
               
               <div class="ffty">
                  <div class="borddo"> <span class="lblbk"><?php echo $input_details[0]->arrival_city; ?></span> </div>
               </div>
               <div class="clearfix"></div>
               <div class="tabledates">
                  <div class="tablecelfty">
                     <div class="borddo brdrit">
                        <div class="fuldate">
                           <div class="fuldate">
                              <span class="bigdate"> <?php echo date('d', strtotime($input_details[0]->departure_date)) ?></span>
                              <div class="biginre"> <?php 


                                     $mont = date('M', strtotime($input_details[0]->departure_date));

                                     echo $mont;



                               ?><br><?php echo date('Y', strtotime($input_details[0]->departure_date)) ?> </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
                           

               
               <div class="clearfix"></div>
               <div class="nigthcunt"><?php
               
                
                    echo 'OneWay';
                


                 ?></div>
             
              </div>
         
             




<div class="clearfix"></div>
            
         </div>
        
         </div>

        

         <div class="bg_loader"></div>
      </div>
       <br/>

<p class="text-center"> <a style="color:#333;" href="<?php echo base_url(); ?>home" class="cancel_search"><span class="fa fa-long-arrow-left"></span>Back To Home</a></p>

   </div>
</div>
      <!--end  popular packajge -->
      <?php  $this->load->view('common/footer'); ?>
      <!-- end footer -->
      <div class="to-top pos-rtive">
         <a href="#"><i class = "fa fa-angle-up"></i></a>
      </div>
      <!-- Scroll to top-->
      <?php $this->load->view('common/js'); ?>
      <script>

   
   $(document).ready(function(){
      //if close button is clicked  
      var a = ['bus']; var i = 0; var random_id="";
      function nextCall() { alert("hello");
         
         if(i == a.length) {
            $('#loading').fadeOut();
            $('#loading_image').hide();
   
            $('#loading_result').fadeIn();
            $('#loading_imagea').fadeIn();
            return; 
         }  

         $.ajax({
            
            url:'<?php echo base_url(); ?>bus/results/<?php echo base64_encode(json_encode($input_details[0]->search_parameter_details_id)).'/'.$input_details[0]->session_id.'/'.$input_details[0]->rand_id;?>',
            dataType: "json",
            success: function(data){
            $('#search_loader').hide();
               $('#result').html(data.bus_search_result);
               var flight_arrl = $(".flight_arrl:visible").length;
               var flight_deprt = $(".flight_deprt:visible").length;
               var total_div = flight_arrl + flight_deprt;
               $("#total_records").html(total_div);

                 
            },error:function(request, status, error){}
         });            
      }              
      
      
      nextCall();
      return false;
   });


      </script>
      <script>
         $( function() {
            $( "#slider-range" ).slider({
               range: true,
               min: 0,
               max: 500,
               values: [ 75, 300 ],
               slide: function( event, ui ) {
                  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
               }
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
               " - $" + $( "#slider-range" ).slider( "values", 1 ) );
         } );
      </script>
      <script>
         function openNav() {
            document.getElementById("mycart").style.width = "400px";
         }
         
         function closeNav() {
            document.getElementById("mycart").style.width = "0";
         }
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
            $('.setsm ul li').click(function(){
               $('.setsm ul li').removeClass('active');
               $(this).addClass('active');
            });
         });
      </script>
   </body>
   <!-- Mirrored from getnajmul.com/theme/trabble/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Apr 2019 09:45:47 GMT -->
</html>