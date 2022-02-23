<?php

require_once('ayarlar.php');
require_once(system_dir . "Autoload.php");
$SessionManager = new SessionManager();
add_hook('title', 'pageTitle');
include_once(view_dir . "Home.view.php");