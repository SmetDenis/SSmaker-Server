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

namespace JBZoo\PHPUnit;

use JBZoo\SSmakerServer\Soap;
use JBZoo\Utils\Env;
use JBZoo\Utils\Url;

/**
 * Class SoapTest
 * @package JBZoo\PHPUnit
 */
class SoapTest extends PHPUnit
{
    /**
     * @return Soap
     */
    protected function _getClient()
    {
        $host = Env::get('WEB_HOST', '127.0.0.1', Env::VAR_STRING);
        $port = Env::get('WEB_PORT', '8081', Env::VAR_STRING);
        $wsdl = Url::create(['host' => $host, 'port' => $port, 'path' => 'ssmaker.wsdl']);

        /** @var Soap $client */
        $client = new \SoapClient($wsdl);

        return $client;
    }

    public function testGetLastBuild()
    {
        $result = (array)$this->_getClient()->getLastBuild();

        isTrue(5290, $result['GetLastBuildResult'] > 0);
    }
}
