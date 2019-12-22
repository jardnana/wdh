<script src="<?php echo base_url();?>assets/js/vendor/jquery-3.2.0.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/slick.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.meanmenu.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.counterup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.countdown.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url();?>assets/js/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.actions.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.kenburn.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.migration.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.navigation.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.parallax.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.slideanims.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/revolution.extension.video.min.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/revolution.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>    
<script src="<?php echo base_url();?>assets/js/colors.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-customselect.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>
<script src="<?php echo base_url();?>assets/js/assets/revolution/extensions/jquery-ui.js"></script>

<script>
	$("#from_city,#to_city").autocomplete({
	source: "<?php echo site_url(); ?>home/get_busDestinations",
	minLength: 2, //search after two characters
	autoFocus: true, // first item will automatically be focused
	change: function (event, ui) {
	if (ui.item == null){ 
	//here is null if entered value is not match in suggestion list
	$(this).val((ui.item ? ui.item.id : ""));
			  }
			}
		});
</script>