<?php

function class_autoload($class_name)
{
    // List all the class directories in the array.
    $array_paths = array(
        ROOT . '/models/'
    );

    $classes_path = ROOT . '/classes/';
    $content = scandir($classes_path);

    foreach ($content as $item) {

        if (strpos($item, '.') !== false) continue;

        if (is_dir($classes_path .  $item)) {
            array_push($array_paths, $classes_path . $item . '/');
        }
    }

    foreach ($array_paths as $path) {
        $path = $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}
spl_autoload_register('class_autoload');