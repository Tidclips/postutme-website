<?php
// php/auth/logout.php

require '../config.php';

session_destroy();
sendResponse(true, 'Logout successful');
?>
