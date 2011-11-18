        <div class="span16">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <?php echo lang('password_safe_guard_your_account'); ?>
            <div class="clearfix<?php echo (form_error('password_new_password')) ? ' error' : ''; ?>">
                <?php echo form_label(lang('password_new_password'), 'password_new_password'); ?>
				<div class="input">
					<?php echo form_password(array(
							'name' => 'password_new_password',
							'id' => 'password_new_password',
							'value' => set_value('password_new_password'),
							'autocomplete' => 'off'
						)); ?>
					<?php echo form_error('password_new_password'); ?>
				</div>
			</div>
            <div class="clearfix<?php echo (form_error('password_retype_new_password')) ? ' error' : ''; ?>">
                <?php echo form_label(lang('password_retype_new_password'), 'password_retype_new_password'); ?>
				<div class="input">
					<?php echo form_password(array(
							'name' => 'password_retype_new_password',
							'id' => 'password_retype_new_password',
							'value' => set_value('password_retype_new_password'),
							'autocomplete' => 'off'
						)); ?>
					<?php echo form_error('password_retype_new_password'); ?>
				</div>
			</div>
            <div class="actions">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'btn primary',
                        'content' => lang('password_change_my_password')
                    )); ?>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>