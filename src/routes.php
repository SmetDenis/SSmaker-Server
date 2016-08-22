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

use JBZoo\Utils\Env;
use JBZoo\Utils\Url;
use Slim\Http\Request;
use Slim\Http\Response;

$_SERVER['SCRIPT_NAME'] = '/index.php'; // #FUCK!!! https://bugs.php.net/bug.php?id=61286

if (!isset($app)) { // For PHPUnit reports
    return;
}

/** @var \Slim\App $app */
$app->any('/wsSSMaker.asmx', function (Request $req, Response $resp) {

    $serverHost = Env::get('WEB_HOST', $_SERVER['HTTP_HOST'], Env::VAR_STRING);
    $serverPort = Env::get('WEB_PORT', $_SERVER['SERVER_PORT'], Env::VAR_STRING);
    $cleanHost  = str_replace(':' . $serverPort, '', $serverHost);
    $location   = Url::create(['host' => $cleanHost, 'port' => $serverPort, 'path' => '/wsSSMaker.asmx']);
    $wsdlFile   = __DIR__ . '/ssmaker.wsdl';

    if ($req->getParam('WSDL') === '') {

        /** @var Response $resp */
        $resp = $resp->withHeader('Expires', 'Wed, 11 Jan 1984 05:00:00 GMT');
        $resp = $resp->withHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $resp = $resp->withHeader('Cache-Control', 'no-cache, must-revalidate, max-age=0');
        $resp = $resp->withHeader('Pragma', 'no-cache');
        $resp = $resp->withHeader('Content-type', 'application/wsdl+xm');
        $resp->getBody()->write(file_get_contents($wsdlFile));

        return $resp;
    } else {

        $server = new SoapServer($wsdlFile, ['location' => $location]);
        $server->setClass('JBZoo\SSmakerServer\Soap');
        $server->handle();
    }
});


$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});
