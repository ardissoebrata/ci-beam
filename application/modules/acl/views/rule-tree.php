<h1>
	<?php echo lang('rule_page_name'); ?>
</h1>
<?php echo messages(); ?>
<div class="row-fluid">
	<div class="span6">
		<?php
			function display_tree($tree, $acl)
			{
				foreach($tree as $node)
				{
					echo '<li>';
					if (isset($node['children']))
						echo '<span class="toggle"></span>';
						if($acl->is_allowed('acl/rule/edit'))
						{
							echo '<a href="' . site_url('acl/rule/edit') . '/' . $node['id'] . '?redirect=' . urlencode(current_url_params()) . '" class="users">';
							echo '<span>' . $node['name'] . '</span>';
							echo '</a>';
						} else {
							echo '<span>' . $node['name'] . '</span>';
						}
					if (isset($node['children']))
					{
						echo '<ul>';
						display_tree($node['children'], $acl);
						echo '</ul>';
					}
					echo '</li>';
				}
			}
		?>
		<ul class="arbo">
			<?php display_tree($role_tree, $acl); ?>
		</ul>
	</div>
</div>
