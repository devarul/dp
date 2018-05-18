<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function redirect404($frontController)
    {
        $frontController->getResponse()
            ->setHeader('HTTP/1.1', '404 Not Found');
        $frontController->getResponse()
            ->setHeader('Status', '404 File not found');

        $pageId = Mage::getStoreConfig('web/default/cms_no_route');
        if (!Mage::helper('cms/page')->renderPage($frontController, $pageId)) {
            $frontController->_forward('defaultNoRoute');
        }
    }

    public function checkShowSociallogin(){
        $result = false;
        $servers = array(
            'facebook',
            'google',
            'twitter',
            'linkedin',
            'yahoo'
        );
        $count = 0;
        foreach($servers as $server){
            $xml_path = $this->_getXmlPath($server);
            $server_enable = Mage::getStoreConfig($xml_path);
            if($server_enable == 1){
                $count++;
            }
        }

        if($count != 0){
            $result = true;
        }

        return $result;
    }

    protected function _getXmlPath($server_name){
        $data = "le_sociallogin/".$server_name.'/enabled';
        return $data;
    }
}