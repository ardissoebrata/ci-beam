		<div class="row">
			<div class="span8">
				<h2>Edit User</h2>
				<form class="form-horizontal box" method="post">
					<input type="hidden" id="id" name="id" value="" />
					<fieldset>
						<legend>Account</legend>
						<?php echo form_inputlabel('username', 'Username', TRUE); ?>
						<?php echo form_emaillabel('email', 'Email', TRUE); ?>
						<?php echo form_passwordlabel('password', 'Password'); ?>
						<?php echo form_passwordlabel('password-confirm', 'Confirm Password'); ?>
					</fieldset>
					<?php echo form_actions(array(
						array(
							'id'	=> 'save-button',
							'value' => 'Save',
							'class' => 'btn-primary'
						),
						array(
							'id'	=> 'cancel-button',
							'value'	=> 'Cancel'
						)
					)); ?>
				</form>
			</div>
		</div>