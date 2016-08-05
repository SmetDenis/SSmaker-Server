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

require_once __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require_once __DIR__ . '/../src/config.php';
$app      = new \Slim\App($settings);

require_once __DIR__ . '/../src/depends.php';
require_once __DIR__ . '/../src/routes.php';

// Run app
$app->run();
