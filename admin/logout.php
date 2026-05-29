<?php
require "../setting.php";
session_start();
session_unset();
session_destroy();

redirect('admin/login.php');
