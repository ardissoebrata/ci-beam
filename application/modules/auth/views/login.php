<div class="modal" style="position: relative; top: auto; left: auto; margin: 100px auto; z-index: 1;  width: 500px;">
	<form class="form-horizontal box" method="post" style="margin: 0">
		<div class="modal-header">
			<h3><?php echo lang('login'); ?></h3>
		</div>
		<div class="modal-body">
			<?php echo messages(); ?>
			<div class="control-group">
				<label for="username" class="control-label"><?php echo lang('username'); ?></label>
				<div class="controls">
					<input type="text" name="username" id="username" value="<?php echo (isset($username)) ? $username : ''; ?>" />
				</div>
			</div>
			<div class="control-group">
				<label for="password" class="control-label"><?php echo lang('password'); ?></label>
				<div class="controls">
					<input type="password" name="password" id="password">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"></label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" name="remember" value="1" <?php echo (isset($remember)) ? 'checked="checked"' : ''; ?> />
						<?php echo lang('remember_me'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<a href="<?php echo site_url('/'); ?>" class="btn"><?php echo lang('close'); ?></a>
			<input type="submit" name="login-button" value="<?php echo lang('login'); ?>" id="login-button" class="btn-primary btn">
		</div>
	</form>
</div>