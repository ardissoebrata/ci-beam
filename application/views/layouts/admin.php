<!DOCTYPE html>
<html lang="<?php echo $this->session->userdata('lang') ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $template['metas']; ?>

    <title><?php echo $template['title']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo bower_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo bower_url('metisMenu/dist/metisMenu.min.css') ?>" rel="stylesheet">
	
	<link href="<?php echo bower_url('select2/dist/css/select2.min.css') ?>" rel="stylesheet">
	
	<?php echo $template['css']; ?>

    <!-- Custom CSS -->
    <link href="<?php echo css_url('sb-admin-2') ?>" rel="stylesheet">
	<link href="<?php echo css_url('custom') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo bower_url('font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo bower_url('jquery/dist/jquery.min.js') ?>"></script>
	
	<?php echo $template['js_header']; ?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('/') ?>"><?php echo $template['title']; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<?php
						$this->load->config('navigation');
						$navigation = $this->config->item('navigation');
						foreach($navigation as $nav_lvl_1):
						?>
                        <li>
							<?php $has_children = isset($nav_lvl_1['children']) && is_array($nav_lvl_1['children']); ?>
                            <a href="<?php echo (isset($nav_lvl_1['uri']) ? site_url($nav_lvl_1['uri']) : '#') ?>">
								<i class="<?php echo $nav_lvl_1['icon'] ?>"></i>
								<?php echo $nav_lvl_1['title'] ?>
								<?php if ($has_children): ?><span class="fa arrow"></span><?php endif; ?>
							</a>
							
							<?php if ($has_children): ?>
							<ul class="nav nav-second-level">
								<?php foreach($nav_lvl_1['children'] as $nav_lvl_2): ?>
								<li>
									<?php $has_children_2 = isset($nav_lvl_2['children']) && is_array($nav_lvl_2['children']); ?>
                                    <a href="<?php echo (isset($nav_lvl_2['uri']) ? site_url($nav_lvl_2['uri']) : '#') ?>">
										<?php echo $nav_lvl_2['title'] ?>
										<?php if ($has_children_2): ?><span class="fa arrow"></span><?php endif; ?>
									</a>
									
									<?php if ($has_children_2): ?>
									<ul class="nav nav-third-level">
										<?php foreach ($nav_lvl_2['children'] as $nav_lvl_3): ?>
										<li>
											<a href="<?php echo (isset($nav_lvl_3['uri']) ? site_url($nav_lvl_3['uri']) : '#') ?>">
												<?php echo $nav_lvl_3['title'] ?>
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
                                    <!-- /.nav-third-level -->
									<?php endif; ?>
                                </li>
								<?php endforeach; ?>
							</ul>
                            <!-- /.nav-second-level -->
							<?php endif; ?>
                        </li>
						<?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php echo $template['content']; ?>
			
			
			<!-- Footer -->
			<footer id="page-footer">
				<div class="row">
					<div class="col-lg-6">
						<p class="copyright text-muted small" style="margin-bottom: 0;">Copyright &copy; Your Company 2016. All Rights Reserved</p>
					</div>
					<div class="col-lg-6">
						<p class="text-right text-muted small" style="margin-bottom: 0;">
							Theme <a href="http://startbootstrap.com/template-overviews/sb-admin-2/" target="_blank">SB Admin 2</a> from <a href="http://startbootstrap.com/" target="_blank">startbootstrap.com</a>
						</p>
					</div>
				</div>
			</footer>
		</div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo bower_url('bootstrap/dist/js/bootstrap.min.js') ?>"></script>

     <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo bower_url('metisMenu/dist/metisMenu.min.js') ?>"></script>

    <script src="<?php echo bower_url('select2/dist/js/select2.min.js') ?>"></script>	

    <?php echo $template['js_footer']; ?>
	
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo js_url('sb-admin-2.js') ?>"></script>

</body>

</html>
