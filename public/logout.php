<?php

require_once("../src/session.php");
$_SESSION = new session();
$_SESSION->forgetSession();