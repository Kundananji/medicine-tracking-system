<?php
function autoloadClasses($className) {
    $classFile = __DIR__ . '/../classes/' . strtolower($className) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }

}
spl_autoload_register('autoloadClasses');