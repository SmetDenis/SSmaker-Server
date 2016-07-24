<?php
/**
 * JBZoo SSmaker-Server
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   SSmaker-Server
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/SSmaker-Server
 */

define('PATH_PUBLIC', __DIR__);
define('PATH_ROOT', realpath(PATH_PUBLIC . '/..'));

$_SERVER['SCRIPT_NAME'] = '/index.php'; // #FUCK!!! https://bugs.php.net/bug.php?id=61286

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = PATH_PUBLIC . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require_once PATH_ROOT . '/vendor/autoload.php';

// Instantiate the app
$settings = require_once PATH_ROOT . '/src/config.php';
$app      = new \Slim\App($settings);

require_once PATH_ROOT . '/src/depends.php';
require_once PATH_ROOT . '/src/routes.php';

// Run app
$app->run();
