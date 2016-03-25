<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo lang('login'); ?></h3>
			</div>
			<div class="panel-body">
				<?php echo messages(); ?>
				<form role="form" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="<?php echo lang('username'); ?>" name="username" type="text" autofocus value="<?php echo (isset($username)) ? $username : ''; ?>">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="<?php echo lang('password'); ?>" name="password" type="password" value="">
						</div>
						<div class="checkbox">
							<label>
								<input name="remember" type="checkbox" value="1" <?php echo (isset($remember)) ? 'checked="checked"' : ''; ?>><?php echo lang('remember_me'); ?>
							</label>
						</div>
						<!-- Change this to a button or input when using this as a form -->
						<input type="submit" name="login-button" value="<?php echo lang('login'); ?>" id="login-button" class="btn btn-lg btn-success btn-block">
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
