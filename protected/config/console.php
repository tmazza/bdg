<?php
require(dirname(__FILE__) . '/__config.php');

return [
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'import' => [
      'application.models.*',
      'application.helpers.*',
      'application.vendor.SimpleHTMLDOM.*'
      // 'application.components.*',
      // 'application.extensions.*',
	],
	'components' => [
		'db' => require(dirname(__FILE__) . '/database.php'),
	]
];
