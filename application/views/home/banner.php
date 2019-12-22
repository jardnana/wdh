<div id="demo" class="carousel slide" data-ride="carousel">
	  <?php $banner_details = $this->Common_model->get_banner_details(); if($banner_details!=''){  ?>
	  <!-- Indicators -->
	  <ul class="carousel-indicators">
		<?php $bd = 0; foreach($banner_details as $banner){ $bd_class=""; if($bd == 0){ $bd_class="active";} ?>
		<li data-target="#demo" data-slide-to="<?php echo $bd; ?>" class="<?php echo $bd_class; ?>"></li>
		<?php $bd++; } ?>
	  </ul>

	  <!-- The slideshow -->
	  <div class="carousel-inner">
		<?php $bd = 0; foreach($banner_details as $banner){ $bd_class=""; if($bd == 0){ $bd_class="active";} ?>  
		<div class="carousel-item <?php echo $bd_class; ?>">
		 <img src="<?php echo base_url();?>assets/img/<?php echo $banner->banner_image; ?>" alt="" class="img-fluid">
		</div>
		<?php $bd++; } ?>
	  </div>
	  <!-- Left and right controls -->
	  <a class="carousel-control-prev" href="#demo" data-slide="prev">
		<span class="fa fa-chevron-left"></span>
	  </a>
	  <a class="carousel-control-next" href="#demo" data-slide="next">
		<span class="fa fa-chevron-right"></span>
	  </a>
	  <?php } ?>
</div>
