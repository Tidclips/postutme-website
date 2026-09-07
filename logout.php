<?php
require __DIR__ . '/db_connect.php';

session_unset();
session_destroy();
redirect('index.php');
