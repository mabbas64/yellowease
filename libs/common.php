<?php

//set timezone
date_default_timezone_set('America/Los_Angeles');

//include lib files
include 'class-citygrid-places.php';
include 'class-utility.php';

//turn on error reporting if development site
if( defined( 'DEBUG' ) )
{
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
}

?>
