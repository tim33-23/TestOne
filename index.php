<?php

define('VG_ACCESS', true);

header('Content-Type:text/html;charset=utf-8');
session_start();

require_once ("dao/Dao.php");
require_once ("dto/User.php");
require_once 'internal_settings.php';

require 'templates/header.php';
require 'templates/body.php';
require_once 'templates/footer.php';

