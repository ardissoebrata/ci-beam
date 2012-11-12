<h1>
	<?php echo lang('role_page_name'); ?>
	<?php if($acl->is_allowed('acl/role/add')){ ?>
	<a href="<?php echo site_url('acl/role/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn" title="<?php echo lang('role_add_title'); ?>">
		<i class="icon-plus"></i>
	</a>
	<?php } ?>
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
						if($acl->is_allowed('acl/role/edit')){
							echo '<a href="' . site_url('acl/role/edit') . '/' . $node['id'] . '?redirect=' . urlencode(current_url_params()) . '" class="users">';
							echo '<span>' . $node['name'] . '</span>';
							echo '</a>';
						}else{
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
