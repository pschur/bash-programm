# bash-programm
This is a demo

## Useage
Download bash file:
```bash
php -r "copy('https://github.com/pschur/bash-programm/raw/main/bash', 'bash');"
```
or
Copy bash file content:
```php
#!/usr/bin/env php
<?php
$commands = json_decode(file_get_contents('https://github.com/pschur/bash-programm/raw/main/index.json'));
function command_exists(string $command, $commands, array $argv){
	if (!isset($commands->{$command})) {
		$arg = "php";
		foreach ($argv as $key) {
			$arg .= " {$key}";
		}
		echo "[ERROR] The command [{$command}] in [{$arg}] does not exists!", PHP_EOL;
		exit();
	}
}
function command(string $command){
	$command = json_decode(file_get_contents($command));
	echo "Downloading Command [{$command->name}] ...", PHP_EOL;
	$command_file = __DIR__.'/setup.php';
	copy($command->command, $command_file);
	shell_exec('php '.$command_file);
	if (file_exists($command_file)) {
		unlink($command_file);
	}
	echo "[OK]", PHP_EOL;
}
command_exists($argv[1], $commands, $argv);
$command = $commands->{$argv[1]};
if (is_string($command)) {
	command($command);
	exit(1);
}
for ($x=2; $x < count($argv); $x++) {
	if (!is_string($command)) {
		command_exists($argv[$x], $command, $argv);
		$command = $command->{$argv[$x]};
	} else {
		$argv = [];
	}
}
command($command);
```
