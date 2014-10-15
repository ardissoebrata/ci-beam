<div class="modal" style="position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: 1; display: block; margin: 100px auto;">
	<div class="modal-dialog" style="width: 450px; margin-right: auto; margin-left: auto;">
		<div class="modal-content">
			<form class="form-horizontal" method="post" style="margin: 0">
				<div class="modal-header">
					<h3 class="modal-title"><?php echo lang('login'); ?></h3>
				</div>
				<div class="modal-body">
					<?php echo messages(); ?>
					<div class="form-group">
						<label for="username" class="control-label col-sm-2"><?php echo lang('username'); ?></label>
						<div class="col-sm-10">
							<input type="text" name="username" id="username" value="<?php echo (isset($username)) ? $username : ''; ?>" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="control-label col-sm-2"><?php echo lang('password'); ?></label>
						<div class="col-sm-10">
							<input type="password" name="password" id="password" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember" value="1" <?php echo (isset($remember)) ? 'checked="checked"' : ''; ?> />
									<?php echo lang('remember_me'); ?>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="<?php echo site_url('/'); ?>" class="btn btn-default"><?php echo lang('close'); ?></a>
					<input type="submit" name="login-button" value="<?php echo lang('login'); ?>" id="login-button" class="btn-primary btn">
				</div>
			</form>
		</div>
	</div>
</div>