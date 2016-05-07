<?php
return array(
    'class' => 'CDbConnection',
    'connectionString'    => "mysql:host=$__hostDatabase;dbname=$__nameDatabase;port=$__portDatabase",
    'emulatePrepare'      => true,
    'username'            => $__userDatabase,
    'password'            => $__passDatabase,
    'charset'             => 'utf8',
    'enableProfiling'     => true,
    'enableParamLogging'  => true,
);
