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

namespace JBZoo\SSmakerServer;

/**
 * Class Soap
 * @package JBZoo\SSmakerServer
 */
class Soap
{
    /**
     * @return array
     */
    public function getLastBuild()
    {
        $result = ['GetLastBuildResult' => 5290];

        return $result;
    }

    /**
     * @param $file
     * @return array
     */
    public function uploadScreenShot3($file)
    {
        $appImage = new AppImage();

        $name = $appImage->saveFile($file);
        $url  = $appImage->getUrlByName($name);

        $this->notifyToEmail(array(
            'name' => $name,
            'url'  => $url,
        ));

        $file->image = 'IMAGE_WAS_HERE';
        $this->_log('UploadScreenShot3', $file);
        $this->_log($url);

        return array('UploadScreenShot3Result' => $url);
    }

    /**
     * @return array
     */
    public function groupsGet()
    {
        return ['GroupsGetResult' => null];
    }

    /**
     * @return array
     */
    public function userGetAccountInfo()
    {
        return [
            'UserGetAccountInfoResult' => [
                'AccountTypeID'   => 0,
                'AccountTypeName' => '',
                'ScreenshotsQuan' => '',
                'SpaceFull'       => '',
                'SpaceOccupied'   => '',
                'AccountDateEnd'  => '',
            ]
        ];
    }

    /**
     * @param $method
     * @param $args
     */
    protected function _log($method, $args = array())
    {
        if (class_exists('jbdump')) {
            \jbdump::log(json_encode($args), 'SSM_SOAP:' . $method);
        }
    }

    /*
    public function ChangePassword() {}
    public function GetLastBuild() {}
    public function GetMyScreenShotsList() {}
    public function GetScreenshotsQuan() {}
    public function GroupAddEdit() {}
    public function GroupGetPossibleSortIDs() {}
    public function GroupGetUsers() {}
    public function GroupLoad() {}
    public function GroupRemove() {}
    public function GroupsGet() {}
    public function LoginUser() {}
    public function MakeWebScreenshot() {}
    public function OneTimeCodeGet() {}
    public function RemindPassword() {}
    public function RegisterUser() {}
    public function RemoveScreenShot() {}
    public function TestX2() {}
    public function UploadScreenShot() {}
    public function UploadScreenShot2() {}
    public function UserAddToGroup() {}
    public function UserGroupChangeSort() {}
    public function UserRemoveFromGroup() {}
    */
}
