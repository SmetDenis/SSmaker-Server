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

/** @var \Slim\App $app */
$app->any('/wsSSMaker.asmx', function () {
    $server = new SoapServer(PATH_PUBLIC . '/ssmaker.wsdl');
    $server->setClass('JBZoo\SSmakerServer\Soap');
    $server->handle();
});

$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});
