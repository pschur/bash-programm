<?php

define("SETUP_FILE", __DIR__.'/composer-setup.php');

copy('https://getcomposer.org/installer', SETUP_FILE);
if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') {
	echo "Installer verified \n";
} else {
	echo 'Installer corrupt', "\n"; unlink(SETUP_FILE);
	exit();
}
echo PHP_EOL;

shell_exec('php '.SETUP_FILE.' --filename=composer');
unlink(SETUP_FILE);

echo "Now you can use composer with: 'php composer <COMMAND>";
echo PHP_EOL;
