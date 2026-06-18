<?php
# Supressing errors & warnings
// error_reporting(0);
// ini_set('display_errors', 0);

# Include the necessary files for booting the web app
require __DIR__ . '/../src/core/config.php'; # For defining the constants for the project
require __DIR__ . '/../src/core/connect.php'; # For connecting to the database
require __DIR__ . '/../src/templates/index.php'; # For loading the main template of the project