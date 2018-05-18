<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Helper_Yahoo extends Mage_Core_Helper_Abstract
{

    public function disconnect(Mage_Customer_Model_Customer $customer) {
        Mage::getSingleton('customer/session')
            ->unsLeSocialloginYahooUserinfo();

        $pictureFilename = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA)
            .DS
            .'le'
            .DS
            .'sociallogin'
            .DS
            .'yahoo'
            .DS
            .$customer->getLeSocialloginnYid();

        if(file_exists($pictureFilename)) {
            @unlink($pictureFilename);
        }

        $customer->setLeSocialloginYid(null)
            ->setLeSocialloginTtoken(null)
            ->save();
    }

    public function connectByYahooId(
        Mage_Customer_Model_Customer $customer,
        $yahooId,
        $token)
    {
        $customer->setLeSocialloginYid($yahooId)
            ->setLeSocialloginTtoken($token)
            ->save();

        Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);
    }

    public function connectByCreatingAccount(
        $email,
        $firstName,
        $lastName,
        $yahooId,
        $token)
    {
        $customer = Mage::getModel('customer/customer');
        $customer->setEmail($email)
            ->setFirstname($firstName)
            ->setLastname($lastName)
            ->setLeSocialloginYid($yahooId)
            ->setLeSocialloginTtoken($token)
            ->setPassword($customer->generatePassword(10))
            ->save();

        $customer->setConfirmation(null);
        $customer->save();

        Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);

    }

    public function loginByCustomer(Mage_Customer_Model_Customer $customer)
    {
        if($customer->getConfirmation()) {
            $customer->setConfirmation(null);
            $customer->save();
        }

        Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);
    }

    public function getCustomersByYahooId($yahooId)
    {
        $customer = Mage::getModel('customer/customer');

        $collection = $customer->getCollection()
            ->addAttributeToFilter('le_sociallogin_yid', $yahooId)
            ->setPageSize(1);

        if($customer->getSharingConfig()->isWebsiteScope()) {
            $collection->addAttributeToFilter(
                'website_id',
                Mage::app()->getWebsite()->getId()
            );
        }

        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            $collection->addFieldToFilter(
                'entity_id',
                array('neq' => Mage::getSingleton('customer/session')->getCustomerId())
            );
        }

        return $collection;
    }

    public function getCustomersByEmail($email)
    {
        $customer = Mage::getModel('customer/customer');

        $collection = $customer->getCollection()
            ->addFieldToFilter('email', $email)
            ->setPageSize(1);

        if($customer->getSharingConfig()->isWebsiteScope()) {
            $collection->addAttributeToFilter(
                'website_id',
                Mage::app()->getWebsite()->getId()
            );
        }

        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            $collection->addFieldToFilter(
                'entity_id',
                array('neq' => Mage::getSingleton('customer/session')->getCustomerId())
            );
        }

        return $collection;
    }

    public function getProperDimensionsPictureUrl($yahooId, $pictureUrl)
    {
        $pictureUrl = str_replace('_normal', '', $pictureUrl);

        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)
            .'le'
            .'/'
            .'sociallogin'
            .'/'
            .'yahoo'
            .'/'
            .$yahooId;

        $filename = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA)
            .DS
            .'le'
            .DS
            .'sociallogin'
            .DS
            .'yahoo'
            .DS
            .$yahooId;

        $directory = dirname($filename);

        if (!file_exists($directory) || !is_dir($directory)) {
            if (!@mkdir($directory, 0777, true))
                return null;
        }

        if(!file_exists($filename) ||
            (file_exists($filename) && (time() - filemtime($filename) >= 3600))){
            $client = new Zend_Http_Client($pictureUrl);
            $client->setStream();
            $response = $client->request('GET');
            stream_copy_to_stream($response->getStream(), fopen($filename, 'w'));

            $imageObj = new Varien_Image($filename);
            $imageObj->constrainOnly(true);
            $imageObj->keepAspectRatio(true);
            $imageObj->keepFrame(false);
            $imageObj->resize(150, 150);
            $imageObj->save($filename);
        }

        return $url;
    }

}
