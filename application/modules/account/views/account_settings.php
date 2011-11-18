		<p><?php echo sprintf(lang('settings_privacy_statement'), anchor('page/privacy-policy', lang('settings_privacy_policy'))); ?></p>
        <div class="span16">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
			<div class="clearfix<?php form_error('settings_email') ? ' error' : ''; ?>">
				<?php echo form_label(lang('settings_email')); ?>
				<div class="input">
					<?php echo form_input(array(
						'id' => 'settings_email',
						'name' => 'settings_email',
						'value' => (set_value('settings_email') ? set_value('settings_email') : (isset($account->email) ? $account->email : '')),
						'maxlength' => '160',
						'class' => 'xlarge'
					)); ?>
					<?php echo form_error('settings_email'); ?>
				</div>
			</div>
			<div class="clearfix<?php form_error('settings_fullname') ? ' error' : ''; ?>">
				<?php echo form_label(lang('settings_fullname')); ?>
				<div class="input">
					<?php echo form_input(array(
						'id' => 'settings_fullname',
						'name' => 'settings_fullname',
						'value' => (set_value('settings_fullname') ? set_value('settings_fullname') : (isset($account_details->fullname) ? $account_details->fullname : '')),
						'maxlength' => '160',
						'class' => 'xlarge'
					)); ?>
					<?php echo form_error('settings_fullname'); ?>
				</div>
			</div>
			<div class="clearfix<?php form_error('settings_firstname') ? ' error' : ''; ?>">
				<?php echo form_label(lang('settings_firstname')); ?>
				<div class="input">
					<?php echo form_input(array(
						'id' => 'settings_firstname',
						'name' => 'settings_firstname',
						'value' => (set_value('settings_firstname') ? set_value('settings_firstname') : (isset($account_details->firstname) ? $account_details->firstname : '')),
						'maxlength' => '80',
						'class' => 'medium'
					)); ?>
					<?php echo form_error('settings_firstname'); ?>
				</div>
			</div>
			<div class="clearfix<?php form_error('settings_firstname') ? ' error' : ''; ?>">
				<?php echo form_label(lang('settings_lastname')); ?>
				<div class="input">
					<?php echo form_input(array(
						'id' => 'settings_lastname',
						'name' => 'settings_lastname',
						'value' => (set_value('settings_lastname') ? set_value('settings_lastname') : (isset($account_details->lastname) ? $account_details->lastname : '')),
						'maxlength' => '80',
						'class' => 'medium'
					)); ?>
					<?php echo form_error('settings_lastname'); ?>
				</div>
			</div>
            <div class="clearfix<?php echo (isset($settings_dob_error) ? ' error': ''); ?>">
				<?php echo form_label(lang('settings_dateofbirth')); ?>
				<div class="input">
					<?php 
						$m = $this->input->post('settings_dob_month') ? $this->input->post('settings_dob_month') : (isset($account_details->dob_month) ? $account_details->dob_month : '');
						echo form_dropdown('settings_dob_month', array(
							'' => lang('dateofbirth_month'),
							'1' => lang('month_jan'),
							'2' => lang('month_feb'),
							'3' => lang('month_mar'),
							'4' => lang('month_apr'),
							'5' => lang('month_may'),
							'6' => lang('month_jun'),
							'7' => lang('month_jul'),
							'8' => lang('month_aug'),
							'9' => lang('month_sep'),
							'10' => lang('month_oct'),
							'11' => lang('month_nov'),
							'12' => lang('month_dec')
						), $m, 'class="small"');

						$d = $this->input->post('settings_dob_day') ? $this->input->post('settings_dob_day') : (isset($account_details->dob_day) ? $account_details->dob_day : '');
						$dates = array('' => lang('dateofbirth_day'));
						for ($i=1; $i<32; $i++) $dates[$i] = $i;
						echo form_dropdown('settings_dob_day', $dates, $d, 'class="small"');

						$y = $this->input->post('settings_dob_year') ? $this->input->post('settings_dob_year') : (isset($account_details->dob_year) ? $account_details->dob_year : ''); 
						$years = array('' => lang('dateofbirth_year'));
						for ($i = mdate('%Y', now()); $i > 1900; $i--) $years[$i] = $i;
						echo form_dropdown('settings_dob_year', $years, $y, 'class="small"');
					?>
					<?php if (isset($settings_dob_error)) : ?>
					<span class="help-block"><?php echo $settings_dob_error; ?></span>
					<?php endif; ?>
				</div>
            </div>
			<div class="clearfix">
				<?php echo form_label(lang('settings_gender')); ?>
				<div class="input">
					<?php $s = ($this->input->post('settings_gender') ? $this->input->post('settings_gender') : (isset($account_details->gender) ? $account_details->gender : '')); ?>
					<select name="settings_gender" class="small">
						<option value=""><?php echo lang('settings_select'); ?></option>
						<option value="m"<?php if ($s == 'm') echo ' selected="selected"'; ?>><?php echo lang('gender_male'); ?></option>
						<option value="f"<?php if ($s == 'f') echo ' selected="selected"'; ?>><?php echo lang('gender_female'); ?></option>
					</select>
				</div>
            </div>
			<div class="clearfix<?php form_error('settings_postalcode') ? ' error' : ''; ?>">
				<?php echo form_label(lang('settings_postalcode')); ?>
				<div class="input">
					<?php echo form_input(array(
						'id' => 'settings_postalcode',
						'name' => 'settings_postalcode',
						'value' => (set_value('settings_postalcode') ? set_value('settings_postalcode') : (isset($account_details->postalcode) ? $account_details->postalcode : '')),
						'maxlength' => '40',
						'class' => 'small'
					)); ?>
					<?php echo form_error('settings_postalcode'); ?>
				</div>
			</div>
			<div class="clearfix">
				<?php echo form_label(lang('settings_country'), 'settings_country'); ?>
				<div class="input">
					<?php $account_country = ($this->input->post('settings_country') ? $this->input->post('settings_country') : (isset($account_details->country) ? $account_details->country : '')); ?>
					<select id="settings_country" name="settings_country" class="select">
						<option value=""><?php echo lang('settings_select'); ?></option>
						<?php foreach ($countries as $country) : ?>
						<option value="<?php echo $country->alpha2; ?>"<?php if ($account_country == $country->alpha2) echo ' selected="selected"'; ?>>
							<?php echo $country->country; ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
            <div class="clearfix">
                <?php echo form_label(lang('settings_language'), 'settings_language'); ?>
				<div class="input">
					<?php $account_language = ($this->input->post('settings_language') ? $this->input->post('settings_language') : (isset($account_details->language) ? $account_details->language : '')); ?>
					<select id="settings_language" name="settings_language" class="select">
						<option value=""><?php echo lang('settings_select'); ?></option>
						<?php foreach ($languages as $language) : ?>
						<option value="<?php echo $language->one; ?>"<?php if ($account_language == $language->one) echo ' selected="selected"'; ?>>
							<?php echo $language->language; ?><?php if ($language->native && $language->native != $language->language) echo ' ('.$language->native.')'; ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
            </div>
            <div class="clearfix">
                <?php echo form_label(lang('settings_timezone'), 'settings_timezone'); ?>
				<div class="input">
					<?php $account_timezone = ($this->input->post('settings_timezone') ? $this->input->post('settings_timezone') : (isset($account_details->timezone) ? $account_details->timezone : '')); ?>
					<select id="settings_timezone" name="settings_timezone" class="select">
						<option value=""><?php echo lang('settings_select'); ?></option>
						<?php foreach ($zoneinfos as $zoneinfo) : ?>
						<option value="<?php echo $zoneinfo->zoneinfo; ?>"<?php if ($account_timezone == $zoneinfo->zoneinfo) echo ' selected="selected"'; ?>>
							<?php echo $zoneinfo->zoneinfo; ?><?php if ($zoneinfo->offset) echo ' ('.$zoneinfo->offset.')'; ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
            <div class="actions">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'btn primary',
                        'content' => lang('settings_save')
                    )); ?>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>