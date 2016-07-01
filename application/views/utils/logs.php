<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $panel_title ?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php echo messages(); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div class="row m-b-md">
					<div class="col-md-12">
						<?php echo form_dropdown('log_files', $log_files, $selected_log, 'style="min-width: 200px"'); ?>
					</div>
				</div>
				<table id="logs" class="table table-bordered">
					<thead>
						<tr>
							<?php foreach ($setting['columns'] as $index => $column): ?>
								<th<?php echo ($setting['widths'][$index] > 0) ? ' style="width: ' . $setting['widths'][$index] . 'px"' : ''; ?>><?php echo lang($column); ?></th>
								<?php if ($column == 'username'): ?>
									<th><?php echo lang('full_name'); ?></th>
								<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($rows as $row): ?>
							<tr>
								<?php foreach ($setting['columns'] as $column): ?>
									<td><?php echo $row[$column]; ?></td>
									<?php if ($column == 'username'): ?>
										<td><?php echo $row['full_name']; ?></td>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>