<h1>
	<?php echo lang('resource_page_name'); ?>
	<?php if($acl->is_allowed('acl/resource/add')){ ?>
	<a href="<?php echo site_url('acl/resource/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn" title="<?php echo lang('resource_add_title'); ?>">
		<i class="icon-plus"></i>
	</a>
	<?php } ?>
</h1>
<?php echo messages(); ?>
<div class="row-fluid">
	<div class="span6">
		<?php
		function display_tree($tree, $curr_id = 0, $acl)
		{
			foreach($tree as $node)
			{
				echo '<li>';
				if (isset($node['children']))
					echo '<span class="toggle"></span>';
				$class = $node['type'];
				if ($node['id'] == $curr_id)
					$class .= ' current';
					if($acl->is_allowed('acl/resource/edit')){
						echo '<a href="' . site_url('acl/resource/edit') . '/' . $node['id'] . '?redirect=' . urlencode(site_url('acl/resource')) . '" class="' . $class . '">';
						echo '<span>' . $node['name'] . '</span>';
						echo '</a>';
					}else{
						echo '<span>' . $node['name'] . '</span>';
					}
				if (isset($node['children']))
				{
					echo '<ul>';
					display_tree($node['children'], $curr_id, $acl);
					echo '</ul>';
				}
				echo '</li>';
			}
		}
		?>
		<ul class="arbo">
			<?php display_tree($resource_tree, (isset($resource->id) ? $resource->id : 0), $acl); ?>
		</ul>
	</div>
</div>
