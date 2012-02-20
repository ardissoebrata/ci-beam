		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="<?php echo site_url('/'); ?>"><?php echo $title ?></a>
					<div class="nav-collapse">
						<ul class="nav">
							<?php
							$menus = array(
								'welcome/bootstrap_demo/starter'	=> 'Starter',
								'welcome/bootstrap_demo/fluid'		=> 'Fluid',
								'welcome/bootstrap_demo/marketing'	=> 'Marketing',
							);
							foreach($menus as $url => $label):
							?>
							<li <?php if (uri_string() == $url) echo 'class="active"'; ?>>
								<a href="<?php echo site_url($url); ?>"><?php echo $label; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>