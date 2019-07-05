<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title> ADMIN | Zebra Login</title>
    
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('back_assets/'); ?>app-assets/images/ico/apple-icon-60.png">

    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('back_assets/'); ?>app-assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('back_assets/'); ?>app-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('back_assets/'); ?>app-assets/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('back_assets/'); ?>app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('back_assets/'); ?>app-assets/images/ico/favicon-32.png">
    

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>assets/css/style.css">

    <script src="<?php echo base_url('back_assets/'); ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>

    <!-- END Custom CSS-->
</head>

<style type="text/css">
	.errMsg{
		color: red;
	}
</style>

<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header no-border">
                                <div class="card-title text-xs-center">
                                    <div class="p-1"><img src="<?php echo base_url('back_assets/'); ?>app-assets/images/logo/robust-logo-dark.png" alt="branding logo"></div>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>ADMIN</span></h6>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <form class="form-horizontal form-simple" novalidate>
                                        
                                        <fieldset class="form-group position-relative has-icon-left mb-0">
                                            <input type="text" class="form-control form-control-lg input-lg" placeholder="Admin Email" id="loginEmail" required>
                                            <div class="form-control-position">
                                                <i class="icon-head"></i>
                                            </div>
                                            <p class="errMsg" id="loginEmailErr"></p>
                                        </fieldset>
                                        <br>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control form-control-lg input-lg" placeholder="Admin Password" id="loginPassword" required>
                                            <div class="form-control-position">
                                                <i class="icon-key3"></i>
                                            </div>
                                            <p class="errMsg" id="loginPasswordErr"></p>
                                        </fieldset>
                                        
                                        <fieldset class="form-group row">
                                            <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                                <fieldset>
                                                    <input type="checkbox" id="rememberMe" class="chk-remember">
                                                    <label for="remember-me"> Remember Me</label>
                                                </fieldset>
                                            </div>
                                            
                                        </fieldset>

										<button id="loginBtn" type="button" class="btn btn-primary btn-lg btn-block">
											<i class="icon-unlock2"></i>
											Login
										</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>


    <script type="text/javascript">
    	$('#loginBtn').click(function(){

    		$('.errMsg').html('');

    		var loginEmail    = $.trim($('#loginEmail').val());
    		var loginPassword = $.trim($('#loginPassword').val());

    		var checkValidation = true;

    		if(loginEmail == ''){
    			checkValidation = false;
    			$('#loginEmailErr').html('Please Fill Email Field.');
    		}else{
    			if(!isValidEmailAddress(loginEmail)){
    				checkValidation = false;
    				$('#loginEmailErr').html('Please Fill Valid Email.');
    			}
    		}
    		if(loginPassword == ''){
    			checkValidation = false;
    			$('#loginPasswordErr').html('Please Fill Password Field.');
    		}else{
    			if(loginPassword.length < 6){
	    			checkValidation = false;
	    			$('#loginPasswordErr').html('Password Fill at Least 6 Character.');
	    		}
    		}

    		if(checkValidation == true){
    			if ($('#rememberMe').is(':checked')) {
				    localStorage.userName = loginEmail;
				    localStorage.password = loginPassword;
				    localStorage.checkBoxValidation = $('#rememberMe').val();
				} else {
				    localStorage.userName = '';
				    localStorage.password = '';
				    localStorage.checkBoxValidation = '';
				}

				$.ajax({
					url: '<?php echo base_url('admin/admin/loginAdmin'); ?>',
					type : 'POST',
					data : {
						loginEmail : loginEmail,
						loginPassword : loginPassword,
					},
					success: function(result){
				        $('#tableData').html(result);
					}
				});

    		}

    	});

		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		}

		if (localStorage.checkBoxValidation && localStorage.checkBoxValidation != '') {
			$('#rememberMe').attr('checked', 'checked');
			$('#loginEmail').val(localStorage.userName);
			$('#loginPassword').val(localStorage.password);
		} else {
			$('#rememberMe').removeAttr('checked');
			$('#loginEmail').val('');
			$('#loginPassword').val('');
		}

    </script>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?php echo base_url('back_assets/'); ?>app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>