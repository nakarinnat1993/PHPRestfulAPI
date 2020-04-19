<?php
require_once __DIR__."/app/autoload.php";

use BasicAPI\User;

$user = new User();
$user->first_name="Nakarin";
$user->last_name="Jaiseengam";

$user->login();
