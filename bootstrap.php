<?php
require_once(__DIR__ . '/database/database.php');
/**
 * @param $name
 * @param array $params
 * @return void
 */
function partial($name, $params = [])
{
    require(__DIR__ . "/html_partials/{$name}.html.php");
}
