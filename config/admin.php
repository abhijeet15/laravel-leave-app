<?php

return [
	'types' => [
		'super_admin',
		'admin',
		'employee',
	],

	'access' => [
		'super_admin' => "*",
		'admin' => "leave",
		'employee' => "add-leave",

	]
];