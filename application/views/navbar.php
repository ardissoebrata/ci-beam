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
						$menus = $this->config->item('main_nav');
						?>
						<ul class="nav">
							<?php
							foreach($menus as $url => $label):
								if (!$this->acl->is_allowed($url)) continue;
								if (is_array($label)):
							?>
							<li class="dropdown<?php if (substr(uri_string(), 0, strlen($url)) == $url) echo ' active'; ?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ucwords($url); ?><b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php foreach($label as $sub_url => $sub_label): ?>
									<?php if (!$this->acl->is_allowed($sub_url)) continue; ?>
									<li <?php if (substr(uri_string(), 0, strlen($sub_url)) == $sub_url) echo 'class="active"'; ?>>
										<a href="<?php echo site_url($sub_url); ?>"><?php echo $sub_label; ?></a>
									</li>
								<?php endforeach; ?>
								</ul>
							</li>
							<?php
								else:
							?>
							<li <?php if (substr(uri_string(), 0, strlen($url)) == $url) echo 'class="active"'; ?>>
								<a href="<?php echo site_url($url); ?>"><?php echo $label; ?></a>
							</li>
							<?php endif; ?>
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
								<a href="<?php echo site_url('auth/user/profile'); ?>"><?php echo $name; ?></a>
							</li>
							<li class="divider-vertical"></li>
							<li>
								<a href="<?php echo site_url('auth/logout'); ?>"><?php echo lang('logout'); ?></a>
							</li>
						</ul>
						<?php else: ?>
						<ul class="nav pull-right">
							<li>
								<a href="<?php echo site_url('auth/login'); ?>"><?php echo lang('login'); ?></a>
							</li>
						</ul>
						<?php endif; ?>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>