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
     * @return Soap|\SoapClient
     */
    protected function _getClient()
    {
        $host = Env::get('WEB_HOST', '127.0.0.1', Env::VAR_STRING);
        $port = Env::get('WEB_PORT', '8081', Env::VAR_STRING);
        $loc  = Url::create(['host' => $host, 'port' => $port, 'path' => 'wsSSMaker.asmx']);

        /** @var Soap $client */
        $client = new \SoapClient($loc . '?WSDL', [
            'trace'    => true,
            'location' => $loc
        ]);

        return $client;
    }

    public function testGetLastBuild()
    {
        $result = (array)$this->_getClient()->getLastBuild();

        isSame(5290, $result['GetLastBuildResult']);
    }

    public function testUploadScreenShot3()
    {
        $file = (object)[
            'UserCode'     => '7917e727-5057-4cd9-ad19-b8637e8121d6',
            'image'        => file_get_contents(PROJECT_TESTS . '/images/butterfly.png'),
            'ext'          => 'png',
            'ProgramBuild' => 5462,
            'IsFavorite'   => false
        ];

        $result = (array)$this->_getClient()->uploadScreenShot3($file);

        isTrue($result['UploadScreenShot3Result']);
    }
}
