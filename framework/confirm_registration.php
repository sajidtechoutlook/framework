<?php
if(!empty($_POST['registration_code'])){
    $registration_code = $rodb->mysql_real_escape_string($_POST['registration_code']);
    $q = "select uid from user where registration_code='".$registration_code."' and registration_code!=''";
    $uid = $rodb->getCellFromDB($q);
    if(isset($uid) && $uid > 0){
        $one_month_later = time()+(60*60*24*30);
        $licence = base64_encode(base64_encode(base64_encode(@date('Y-m-d', $one_month_later))));
        $update_q = "update user set active=1, licence='".$licence."', registration_code = '' where registration_code='".$registration_code."' and uid = '".$uid."'";
        $rodb->execute($update_q);
        ?>
            You have successfully activated your account.
            <meta http-equiv="refresh" content="0; <?php echo getPageUrl('login')?>" />
        <?php
    }else{
        $err = "Invalid Code";
    }
}
?><!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="<?php themeUrl()?>../../../">
		<meta charset="utf-8" />
		<title>YOUACCOUNTS | Register</title>
		<meta name="description" content="You Accounts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<!-- <link rel="stylesheet" href="<?php themeUrl()?>https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700"> -->
		<link rel="stylesheet" href="<?php echo themeUrl().'assets/css/google.fonts.css'?>">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="<?php themeUrl()?>assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->

		<!--begin:: Vendor Plugins -->
		<!-- <link href="<?php themeUrl()?>assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" /> -->

		<!--end:: Vendor Plugins -->
		<link href="<?php themeUrl()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--begin:: Vendor Plugins for custom pages -->
		<!-- <link href="<?php themeUrl()?>assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/core/main.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/daygrid/main.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/list/main.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/timegrid/main.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/jqvmap.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/plugins/custom/uppy/dist/uppy.min.css" rel="stylesheet" type="text/css" /> -->

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<!-- <link href="<?php themeUrl()?>assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?php themeUrl()?>assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" /> -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php themeUrl()?>assets/media/logos/favicon.png" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

					<!--begin::Aside-->
					<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(<?php themeUrl()?>assets/media//bg/bg-4.jpg);">
						<div class="kt-grid__item">
							<a href="<?php themeUrl()?>#" class="kt-login__logo">
								<img src="<?php themeUrl()?>assets/media/logos/logo-4.png">
							</a>
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
							<div class="kt-grid__item kt-grid__item--middle">
								<h3 class="kt-login__title">Welcome to YOUACCOUNTS!</h3>
								<h4 class="kt-login__subtitle">The ultimate solution for your business problems.</h4>
							</div>
						</div>
						<div class="kt-grid__item">
							<div class="kt-login__info">
								<div class="kt-login__copyright">
									&copy <?php echo @date('Y')?> YOUACCOUNTS
								</div>
								<div class="kt-login__menu">
									<a href="<?php themeUrl()?>" class="kt-link">Privacy</a>
									<a href="<?php themeUrl()?>" class="kt-link">Legal</a>
									<a href="<?php themeUrl()?>" class="kt-link">Contact</a>
								</div>
							</div>
						</div>
					</div>

					<!--begin::Aside-->

					<!--begin::Content-->
					<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

						<!--begin::Head-->
						<div class="kt-login__head">
							<span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
							<a href="<?php echo getPageUrl('register');?>" class="kt-link kt-login__signup-link">Sign Up!</a>
						</div>

						<!--end::Head-->

						<!--begin::Body-->
						<div class="kt-login__body">

							<!--begin::Signin-->
							<div class="kt-login__form">
								<div class="kt-login__title">
									<h3>Code Confirmation</h3>
								</div>

								<!--begin::Form-->
								<form class="kt-form" action="" id="kt_login_form1" method="post">
									<?php if(!empty($errors)){?><div class="alert alert-bold alert-solid-danger alert-dismissible" role="alert">			
									<div class="alert-text"><?php $show_errors = implode('<br />', $errors); echo $show_errors?></div>
									<div class="alert-close">                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>            </div>		</div><?php }?>
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Registration Code" name="registration_code" autocomplete="off" value="<?php echo (isset($_REQUEST['registration_code']))?$_REQUEST['registration_code']:''?>" required>
									</div>
									
									<!--begin::Action-->
									<div class="kt-login__actions">
										<a href="<?php echo base_url()?>" class="kt-link kt-login__link-forgot">
											Forgot Password ?
										</a>
										<button id="kt_login_signin_submit1" class="btn btn-primary btn-elevate kt-login__btn-primary" type="submit" name="confirm" value="Confirm">Confirm</button>
									</div>
									<!--end::Action-->
								</form>
								<!--end::Form-->
								<!--begin::Divider-->
								<div class="kt-login__divider">
									<div class="kt-divider">
										<span></span>
										<span>OR</span>
										<span></span>
									</div>
								</div>

								<!--end::Divider-->

								<!--begin::Options-->
								<div class="kt-login__options">
									<a href="<?php echo base_url();?>" class="btn btn-primary kt-btn">
										<i class="fab fa-facebook-f"></i>
										Facebook
									</a>
									<a href="<?php echo base_url();?>" class="btn btn-info kt-btn">
										<i class="fab fa-twitter"></i>
										Twitter
									</a>
									<a href="<?php echo base_url();?>" class="btn btn-danger kt-btn">
										<i class="fab fa-google"></i>
										Google
									</a>
								</div>

								<!--end::Options-->
							</div>

							<!--end::Signin-->
						</div>

						<!--end::Body-->
					</div>

					<!--end::Content-->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

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
		<!-- <script src="<?php themeUrl()?>assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/wnumb/wNumb.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/autosize/dist/autosize.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/dropzone.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/quill/dist/quill.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/markdown/lib/markdown.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/toastr/build/toastr.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/raphael/raphael.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/morris.js/morris.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/plugins/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/counterup/jquery.counterup.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/general/dompurify/dist/purify.js" type="text/javascript"></script> -->

		<!--end:: Vendor Plugins -->
		<script src="<?php themeUrl()?>assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--begin:: Vendor Plugins for custom pages -->
		<!-- <script src="<?php themeUrl()?>assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/js/global/integration/plugins/datatables.init.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jszip/dist/jszip.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons/js/buttons.colVis.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons/js/buttons.flash.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-buttons/js/buttons.print.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/datatables.net-select/js/dataTables.select.min.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jstree/dist/jstree.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/jquery.vmap.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js" type="text/javascript"></script>
		<script src="<?php themeUrl()?>assets/plugins/custom/uppy/dist/uppy.min.js" type="text/javascript"></script> -->

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="<?php themeUrl()?>assets/js/pages/custom/login/login-1.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>