<?php
require("config/functions.php");
session_unset();
session_destroy();
redirect_to("index.php");

?>