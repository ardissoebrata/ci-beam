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
						<?php 
						$menus = array(
							'welcome/bootstrap_demo/starter'	=> 'Starter',
							'welcome/bootstrap_demo/fluid'		=> 'Fluid',
							'welcome/bootstrap_demo/marketing'	=> 'Marketing',
						);
						if (isset($auth_user))
						{
							$menus['auth/user'] = 'User';
						}
						?>
						<ul class="nav">
							<?php
							foreach($menus as $url => $label):
							?>
							<li <?php if (substr(uri_string(), 0, strlen($url)) == $url) echo 'class="active"'; ?>>
								<a href="<?php echo site_url($url); ?>"><?php echo $label; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php if (isset($auth_user)): ?>
						<ul class="nav pull-right">
							<li>
								<?php
								$name = $auth_user['first_name'] . ' ' . $auth_user['last_name'];
								if (strlen(trim($name)) == 0)
									$name = $auth_user['username'];
								?>
								<a href="<?php echo site_url('auth/user/edit/' . $auth_user['id']); ?>"><?php echo $name; ?></a>
							</li>
							<li class="divider-vertical"></li>
							<li>
								<a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
							</li>
						</ul>
						<?php else: ?>
						<ul class="nav pull-right">
							<li>
								<a href="<?php echo site_url('auth/login'); ?>">Login</a>
							</li>
						</ul>
						<?php endif; ?>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>