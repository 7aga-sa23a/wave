<?php
# Define the important paths for the project (used in Frontend code)
# Reminder:
# Backend code uses relative paths
# Frontend uses absolute paths (defined here)

if (!defined('PUBLIC_URL')) {
    define('PUBLIC_URL', '/wave/public');
    define('DATABASE_URL', '/wave/database');
    define('CORE_URL', '/wave/src/core');
    define('TEMPLATES_URL', '/wave/src/templates');
    define('LOGIC_URL', '/wave/src/logic');

    define('CSS_URL', "/wave/public/css/");
    define('IMG_URL', "/wave/public/assets/img");
    define('JS_URL', '/wave/public/js');
    define('COMPONENTS_URL', '/wave/public/components');
    define('HELPERS_URL', '/wave/src/helpers');
}
