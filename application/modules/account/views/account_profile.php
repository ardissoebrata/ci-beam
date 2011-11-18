        <div class="span11">
			<p><?php echo lang('profile_instructions'); ?></p>
            <?php echo form_open_multipart(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <div class="clearfix<?php echo (form_error('profile_username') || isset($profile_username_error)) ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_username'), 'profile_username'); ?>
				<div class="input">
					<?php echo form_input(array(
							'name' => 'profile_username',
							'id' => 'profile_username',
							'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''),
							'maxlength' => '24',
							'class' => 'medium'
						)); ?>
					<?php echo form_error('profile_username'); ?>
					<?php if (isset($profile_username_error)) : ?>
					<span class="help-block"><?php echo $profile_username_error; ?></span>
					<?php endif; ?>
				</div>
			</div>
            <div class="clearfix<?php echo (isset($profile_picture_error)) ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_picture'), 'profile_picture'); ?>
				<div class="input">
					<p>
						<?php if (isset($account_details->picture)) : ?>
						<img src="resource/user/profile/<?php echo $account_details->picture; ?>?t=<?php echo md5(time()); ?>" alt="" /> <?php echo anchor('account/account_profile/index/delete', lang('profile_delete_picture')); ?>
						<?php else : ?>
						<img src="resource/img/default-picture.gif" alt="" />
						<?php endif; ?>
					</p>
				</div>
				<div class="input">
					<?php echo form_upload(array(
						'name' => 'account_picture_upload',
						'id' => 'account_picture_upload'
					)); ?>
					<p><small><?php echo lang('profile_picture_guidelines'); ?></small></p>
					<?php if (isset($profile_picture_error)) : ?>
					<span class="help-block"><?php echo $profile_picture_error; ?></span>
					<?php endif; ?>
				</div>
            </div>
            <div class="actions">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'btn primary',
                        'content' => lang('profile_save')
                    )); ?>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>