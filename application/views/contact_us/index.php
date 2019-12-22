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
          <div class="col-md-5 intro-info order-md-first order-last">
            <h2 class="ttl">Contact us</h2>
            <div class="abts">
            <h6>Try a more powerful colour im not sure, try something else, for can you make pink a little more pinkish. </h6>
             <div class="form">
              <form action="<?php echo base_url();?>contact_us/add_message" method="post" role="form" class="contactForm">
                <div class="form-group">
                  <label>Your name</label>
                  <input type="text" name="name" class="form-control"  id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email"  id="email"  data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                   <label>Your message</label>
                  <textarea class="form-control" name="message" rows="5"  data-rule="required" data-msg="Please write something for us"></textarea>
                  <div class="validation"></div>
                </div>
                <div id="errormessage"></div>
                <div><input type="submit"  name="submit_btn" id="submit_btn" value="Send Message" class="btc"></div>
              </form>
            </div>
          </div>
          </div>
          <div class="col-md-1 intro-info order-md-first order-last"></div>
          <div class="col-md-6 intro-info order-md-last order-first">
            <img src="<?php echo base_url();?>assets/img/cnt1.png" alt="" class="img-fluid">
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
