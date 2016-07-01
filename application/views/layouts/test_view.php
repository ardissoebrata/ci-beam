<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Test View</h1>
			<p>This page is used by unit testing. Don't touch this.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>Messages</h2>
			<ul>
			<?php foreach($template['messages'] as $message_type => $message_group): ?>
			<?php foreach($message_group as $message): ?>
				<li><?php echo $message_type . ' : ' . $message ?></li>
			<?php endforeach; ?>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php if (isset($template['partials']['partial_content'])): ?>
	<div class="row">
		<div class="col-md-12">
			<?php echo $template['partials']['partial_content']; ?>
		</div>
	</div>
	<?php endif; ?>
</div>

