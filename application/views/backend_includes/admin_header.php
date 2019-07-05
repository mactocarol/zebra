<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
   
    <title>ADMIN | <?php echo $title; ?></title>
    
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('back_assets/'); ?>assets/css/style.css">
    <!-- END Custom CSS-->

    <script src="<?php echo base_url('back_assets/'); ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>

</head>

<script type="text/javascript">
	var baseUrl = '<?php echo base_url(); ?>';
</script>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    
                    <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>

                    <li class="nav-item">
                    	<a href="<?php echo base_url('admin/dashboard'); ?>" class="navbar-brand nav-link">
                    		<!-- <img alt="branding logo" src="<?php echo base_url('back_assets/'); ?>app-assets/images/logo/robust-logo-light.png" data-expand="<?php echo base_url('back_assets/'); ?>app-assets/images/logo/robust-logo-light.png" data-collapse="<?php echo base_url('back_assets/'); ?>app-assets/images/logo/robust-logo-small.png" class="brand-logo"> -->

                    		<h1 style="color: #FFF" >ZEBRA ADMIN</h1>
                    	</a>
                    </li>

                    <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>

                </ul>
            </div>
            <div class="navbar-container content container-fluid">
                <div id="navbar-mobile" class="collapse navbar-toggleable-sm">

					<ul class="nav navbar-nav">
						<li class="nav-item hidden-sm-down">
							<a class="nav-link nav-menu-main menu-toggle hidden-xs">
								<i class="icon-menu5"></i>
							</a>
						</li>
						<li class="nav-item hidden-sm-down">
							<a href="#" class="nav-link nav-link-expand">
								<i class="ficon icon-expand2"></i>
							</a>
						</li>

					</ul>

                    <ul class="nav navbar-nav float-xs-right">

                        <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="<?php echo base_url('back_assets/'); ?>app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name">John Doe</span></a>
                            <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a><a href="#" class="dropdown-item"><i class="icon-mail6"></i> My Inbox</a><a href="#" class="dropdown-item"><i class="icon-clipboard2"></i> Task</a><a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a>
                                <div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
        <!-- main menu header-->
        <div class="main-menu-header">
            <input type="text" placeholder="Search" class="menu-search form-control round" />
        </div>
        <!-- / main menu header-->
        <!-- main menu content-->

        <?php $twoSeg =  $this->uri->segment(2); ?>
        <?php $threeSeg =  $this->uri->segment(3); ?>

        <div class="main-menu-content">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

                <li class=" nav-item <?php echo ($twoSeg == 'dashboard') ? 'active' : ''; ?> ">
                    <a href="<?php echo base_url('admin/dashboard'); ?>">
                        <i class="icon-home3"></i>
                        <span data-i18n="nav.icons.main" class="menu-title">
						Dashboard
					</span>
                    </a>
                </li>

				
				<li class="nav-item <?php echo ($twoSeg == 'users') ? 'active' : ''; ?> ">
					<a href="index.html">
						<i class="icon-person"></i>
						<span class="menu-title">
							User
						</span>
					</a>
					
					<ul class="menu-content">
						<li class="<?php echo ($threeSeg == 'users') ? 'active' : ''; ?>">
							<a href="<?php echo base_url('admin/users/users'); ?>" data-i18n="nav.dash.main" class="menu-item">
								Users
							</a>
						</li>
						<li class="<?php echo ($threeSeg == 'driver') ? 'active' : ''; ?>">
							<a href="<?php echo base_url('admin/users/driver'); ?>" data-i18n="nav.dash.main" class="menu-item">
								Drivers
							</a>
						</li>
					</ul>

				</li>

            </ul>
        </div>
    </div>