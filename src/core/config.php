<?php
# Define the important paths for the project (used in Frontend code)
# Reminder:
# Backend code uses relative paths
# Frontend uses absolute paths (defined here)

if (!defined('PUBLIC_URL')) {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $baseUrl = '';
    if (($pos = strpos($scriptName, '/public/')) !== false) {
        $baseUrl = substr($scriptName, 0, $pos);
    } elseif (($pos = strpos($scriptName, '/src/')) !== false) {
        $baseUrl = substr($scriptName, 0, $pos);
    }

    define('BASE_URL', $baseUrl);
    define('PUBLIC_URL', BASE_URL . '/public');
    define('DATABASE_URL', BASE_URL . '/database');
    define('CORE_URL', BASE_URL . '/src/core');
    define('TEMPLATES_URL', BASE_URL . '/src/templates');
    define('LOGIC_URL', BASE_URL . '/src/logic');

    define('CSS_URL', BASE_URL . '/public/css');
    define('IMG_URL', BASE_URL . '/public/assets/img');
    define('JS_URL', BASE_URL . '/public/js');
    define('COMPONENTS_URL', BASE_URL . '/public/components');
    define('HELPERS_URL', BASE_URL . '/src/helpers');
}
