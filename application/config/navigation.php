<?php

/**
 * Main Navigation.
 * Primarily being used in views/layouts/admin.php
 * 
 */
$config['navigation'] = array(
	'dashboard' => array(
		'uri' => 'dashboard/home',
		'title' => 'Dashboard',
		'icon' => 'fa fa-dashboard',
	),
	'samples' => array(
		'title' => 'Theme Pages',
		'icon' => 'fa fa-paint-brush',
		'children' => array(
			'charts' => array(
				'title' => 'Charts',
				'children' => array(
					'flot-charts' => array(
						'uri' => 'samples/charts/flot',
						'title' => 'Flot Charts'
					),
					'morris-charts' => array(
						'uri' => 'samples/charts/morris',
						'title' => 'Morris.js Charts'
					)
				)
			),
			'tables' => array(
				'uri' => 'samples/tables',
				'title' => 'Tables'
			),
			'forms' => array(
				'uri' => 'samples/forms',
				'title' => 'Forms'
			),
			'ui_elements' => array(
				'title' => 'UI Elements',
				'children' => array(
					'panels-wells' => array(
						'uri' => 'samples/ui_elements/panels_wells',
						'title' => 'Panels and Wells'
					),
					'buttons' => array(
						'uri' => 'samples/ui_elements/buttons',
						'title' => 'Buttons'
					),
					'notifications' => array(
						'uri' => 'samples/ui_elements/notifications',
						'title' => 'Natifications'
					),
					'typography' => array(
						'uri' => 'samples/ui_elements/typography',
						'title' => 'Typography'
					),
					'icons' => array(
						'uri' => 'samples/ui_elements/icons',
						'title' => 'Icons'
					),
					'grid' => array(
						'uri' => 'samples/ui_elements/grid',
						'title' => 'Grid'
					)
				),
			),
			'blank-page' => array(
				'uri' => 'samples/blank_page',
				'title' => 'Blank Page'
			)
		)
	),
	'user-management' => array(
		'uri' => 'auth/user',
		'title' => 'User Management',
		'icon' => 'fa fa-user'
	),
	'acl' => array(
		'title' => 'ACL',
		'icon' => 'fa fa-unlock-alt',
		'children' => array(
			'rules' => array(
				'uri' => 'acl/rule',
				'title' => 'Rules'
			),
			'roles' => array(
				'uri' => 'acl/role',
				'title' => 'Roles'
			),
			'resources' => array(
				'uri' => 'acl/resource',
				'title' => 'Resources'
			)
		)
	),
	'utils' => array(
		'title' => 'Utils',
		'icon' => 'fa fa-wrench',
		'children' => array(
			'system_logs' => array(
				'uri' => 'utils/logs/system',
				'title' => 'System Logs'
			),
			'deploy_logs' => array(
				'uri' => 'utils/logs/deploy',
				'title' => 'Deploy Logs'
			),
			'info' => array(
				'uri' => 'utils/info',
				'title' => 'Info'
			)
		)
	)
);