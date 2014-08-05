<?php
Route::set('control_special', 'control(/<action>(/<id>))', array(
	'action' => 'login|logout',
))
	->defaults(array(
		'controller' => 'Control',
		'action'     => 'index',
	));

Route::set('logout', 'logout')
	->defaults(array(
		'controller' => 'Control',
		'action'     => 'logout',
	));

Route::set('control', 'control(/<type>(/<id>(/<operation>)))')
	->defaults(array(
		'controller' => 'Control',
		'action'     => 'index',

	));