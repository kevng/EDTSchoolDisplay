<?php

# $host = '127.0.0.1';
$host = '10.4.69.147';
$port = 8000;
// $sock = socket_create_listen($port);
$sock = socket_create(AF_INET, SOCK_STREAM, 0);
socket_bind($sock, $host, $port);
socket_listen($sock);
// socket_accept($sock);
// $client = socket_accept($sock);
// $var = socket_read($client, 1024);
while($client = socket_accept($sock)){
	$var = socket_read($client, 1024);
	echo $var ."\n";
}
socket_close($sock);

?>

<!-- Connect to the python code in order to get UID of the card -->

<!DOCTYPE html>

<html>
	<head>
		<title>Page d'accueil</title>
	</head>
	<link rel="stylesheet" type="text/css" href="css/style-extended.css"/>

	<body>

		<div class="events-header">
			<h1>Events</h1>
		</div>
		<div class="sandbox">
		<form method="post" action="main.php">
			<p>test</p>
			<input name="test" value="<?php $var ?>"/>
			<input type="button" name="Submit" value="Submit"/>

		</form>
	</div>
	</body>
</html>
