						<!-- end:: Content -->
						</div>
	<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
		YouAccounts Software is developed by SajidTech.com +923004157815
	</div>

<!-- begin:: Footer -->
<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-footer__copyright">
			<?php echo @date('Y')?>&nbsp;&copy;&nbsp;<a href="http://www.youaccounts.com" target="_blank" class="kt-link"><?php echo $title;?></a>
		</div>
		<div class="kt-footer__menu">
			<a href="<?php echo base_url();?>" target="_blank" class="kt-footer__menu-link kt-link">About</a>
			<a href="<?php echo base_url();?>" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
			<a href="<?php echo base_url();?>" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
		</div>
	</div>
</div>

<!-- end:: Footer -->
</div>
</div>
</div>

<!-- end:: Page -->



<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
<i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!-- begin::Sticky Toolbar -->

<!-- end::Sticky Toolbar -->

<!-- begin::Demo Panel -->

<!-- end::Demo Panel -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
var KTAppOptions = {
"colors": {
"state": {
	"brand": "#5d78ff",
	"dark": "#282a3c",
	"light": "#ffffff",
	"primary": "#5867dd",
	"success": "#34bfa3",
	"info": "#36a3f7",
	"warning": "#ffb822",
	"danger": "#fd3995"
},
"base": {
	"label": [
		"#c5cbe3",
		"#a1a8c3",
		"#3d4465",
		"#3e4466"
	],
	"shape": [
		"#f0f3ff",
		"#d9dffa",
		"#afb4d4",
		"#646c9a"
	]
}
}
};
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->

<!--begin:: Vendor Plugins -->
<script src="<?php themeUrl()?>assets/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/morris.js/morris.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<!--end:: Vendor Plugins -->
<script src="<?php themeUrl()?>assets/js/scripts.bundle.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php themeUrl()?>assets/js/angular.js" type="text/javascript"></script>
<script src="<?php echo getApiUrl('module.js')?>" type="text/javascript"></script>
<script src="<?php echo getApiUrl('custom.js')?>" type="text/javascript"></script>


<?php roJsBinds();?>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-3P6069GD3B"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3P6069GD3B');
</script>
<?php /*?>
<script data-ad-client="ca-pub-1311423644371083" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php */?>
<script data-ad-client="ca-pub-1040321871253714" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</body>

<!-- end::Body -->
</html>