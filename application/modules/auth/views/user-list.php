		<h2>Users</h2>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Registered</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user['first_name'] ?></td>
					<td><?php echo $user['last_name'] ?></td>
					<td><?php echo $user['username'] ?></td>
					<td><?php echo $user['email'] ?></td>
					<td><?php echo date_format($user['registered'], 'd M Y H:i:s'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>