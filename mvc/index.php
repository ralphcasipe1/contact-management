<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use App\Controllers\ContactController;
use App\Models\Database;
use App\Models\Model;
use App\Models\Contact;

$config = require_once 'config.php';

$dsn = "mysql:host=$config[host];dbname=$config[name];charset=$config[charset]";

$pdo = new PDO($dsn, $config['user'], $config['password'], $config['options']);

$db = new Database($pdo);

$controller = new ContactController($db);

$controller->index();