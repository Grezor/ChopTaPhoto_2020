<?php

$port = 5465;

echo "Running server on http://localhost:{$port} ...\n";
shell_exec("set LOCAL=true && php -S localhost:{$port}");
