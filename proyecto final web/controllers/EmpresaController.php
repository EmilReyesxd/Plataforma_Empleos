<?php

require_once '../config/db.php';
require_once '../helpers/session.php';
session_start();
if (!isEmpresa()) header("Location: ../views/auth/login.php");

?>
