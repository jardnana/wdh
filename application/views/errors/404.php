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
    <section id="intro" class="clearfix notfnd">
      <div class="container d-flex h-100">
        <div class="row justify-content-center align-self-center">
          <div class="col-md-5 intro-info order-md-first order-last pdt15">
            <div class="notf">
               <h2>Page Not Found</h2>
            <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</h6>
            <div>
              <a href="<?php if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=''){ echo $_SERVER['HTTP_REFERER']; } else { echo base_url(); } ?>">BACK</a>
            </div>
          </div>
          </div>
          <div class="col-md-6 intro-img order-md-last order-first">
          </div>
        </div>
      </div>
    </section>
<?php $this->load->view('common/footer'); ?>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<?php $this->load->view('common/js'); ?>
<script src="<?php echo base_url();?>assets/js/contactform.js"></script>
</body>
</html>
