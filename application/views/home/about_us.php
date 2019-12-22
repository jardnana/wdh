<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>:: KOR TEORI ::</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <?php $this->load->view('common/css'); ?>
</head>
<body>
<?php $this->load->view('common/header'); ?>
    <section id="intro" class="clearfix">
      <div class="container d-flex h-100">
        <div class="row justify-content-center align-self-center">
			<?php 
			  $about_us = $this->Common_model->get_about_us_details(); 
			  if($about_us!=''){  ?>
          <div class="col-md-6 intro-info order-md-last order-last">
            <h2 class="ttl"><?php echo $about_us[0]->title; ?></h2>
				<div class="abts">
				<h5><?php echo $about_us[0]->sub_title; ?></h5>
				<h6><?php echo $about_us[0]->about_us_info; ?></h6>
			  </div>
          </div>
          <div class="col-md-6 intro-img order-md-first order-first">
            <img src="<?php echo base_url();?>assets/img/<?php echo $about_us[0]->image; ?>" alt="" class="img-fluid">
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
<?php $this->load->view('common/footer'); ?>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<?php $this->load->view('common/js'); ?>
<script src="<?php echo base_url();?>assets/js/contactform.js"></script>
</body>
</html>
