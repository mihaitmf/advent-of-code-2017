<?php

use AdventOfCode\Common\Container;
use AdventOfCode\Common\SolutionRunner;

$startTime = microtime(true);

require_once __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php";

$configFile = "config.ini";

// all 3 command line arguments
if ($argc === 4) {
    $year = $argv[1];
    $day = $argv[2];
    $part = $argv[3];

// no command line arguments, read defaults from config file
} elseif ($argc === 1 && is_file($configFile)) {
    $config = parse_ini_file($configFile, true);
    $year = $config["runner-default"]["year"];
    $day = $config["runner-default"]["day"];
    $part = $config["runner-default"]["part"];

} else {
    print("The solution runner requires three integer arguments: the year of the event, the day and the part of the problem. Example run solution for the 2017 event, day 9, part 2: php run.php 2017 9 2");
    exit(1);
}

try {
    $output = Container::get(SolutionRunner::class)->run($year, $day, $part);
    print("Result is: {$output}");

} catch (\Exception $exception) {
    print("Exception: {$exception->getMessage()}");
}

print(sprintf(
    "\n\nExecution time: %.4f seconds\nMemory peak usage: %.2f MB\n",
    microtime(true) - $startTime,
    memory_get_peak_usage(true) / 1024 / 1024
));
