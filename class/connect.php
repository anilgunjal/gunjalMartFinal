<?php
/* define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'naprevie_admin' );
define ( 'DB_PASSWORD', 'admin@123' );
define ( 'DB_DB', 'naprevie_db' );
 */
define ( 'DB_USER', 'root' );
define ( 'DB_PASSWORD', '' );
define ( 'DB_DB', 'gunjalmart' );
define ( 'DB_HOST', 'localhost' );

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

?>