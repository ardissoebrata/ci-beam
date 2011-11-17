<header class="topbar">
	<div class="fill">
        <div class="container">
			<?php echo anchor('', lang('website_name'), array('class' => 'brand')); ?>
			<ul class="nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
			<ul class="nav secondary-nav">
				<?php if ($this->authentication->is_signed_in()) : ?>
				<li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
				<li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
				<?php else : ?>
				<li><?php echo anchor('account/sign_up', lang('website_sign_up')); ?></li>
				<li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
				<?php endif; ?>
			</ul>
			<?php if ($this->authentication->is_signed_in()) : ?>
			<p class="pull-right"><?php echo sprintf(lang('website_welcome_username'), '<strong>'.$account->username.'</strong>'); ?></p>
			<?php endif; ?>
        </div>
	</div>
</header>