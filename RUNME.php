#!/usr/bin/env php
<?php

if (!is_dir('./vendor')) {
    shell_exec('composer install');
}

echo shell_exec('php ./src/index.php');
