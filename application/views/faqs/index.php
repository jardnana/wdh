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
  <section id="faq">
      <div class="container">
        <header class="section-header">
          <h2>F.A.Q.</h2>
          <h3>Popular FAQ’s</h3>
          <p>This is a big one and i consider it one of the most <br/>important things for a designer to get right.</p>
        </header>
        <ul id="faq-list" class="wow fadeInUp">
		   <?php 
		   $faqs_details = $this->Common_model->get_faqs_details(); 
		   if($faqs_details!=''){ $hd = 0; foreach($faqs_details as $faqs){ $add_class=""; if($hd == 0){ $add_class="show";} ?>
          <li>
            <a data-toggle="collapse" class="collapsed" href="#faq<?php echo $hd; ?>"><?php echo $faqs->question; ?><i class="ion-android-remove"></i></a>
            <div id="faq<?php echo $hd; ?>" class="in collapse <?php echo $add_class; ?>" data-parent="#faq-list">
              <p>
                <?php echo $faqs->answer; ?>
              </p>
            </div>
          </li>
          <?php $hd++; } } ?>
        </ul>
      </div>
    </section>
    <!-- #faq -->
<?php $this->load->view('common/footer'); ?>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<?php $this->load->view('common/js'); ?>
<script src="<?php echo base_url();?>assets/js/contactform.js"></script>
</body>
</html>
