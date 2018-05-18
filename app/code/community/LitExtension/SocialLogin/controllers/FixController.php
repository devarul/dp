<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_FixController extends Mage_Core_Controller_Front_Action {

    public function indexAction(){
        $this->loadLayout();
//        $this->getLayout()->getBlock('root')->setTemplate('le_sociallogin/fix.phtml');
        $this->renderLayout();
        return $this;
    }

    public function connectAction(){

        $attributeModel = Mage::getModel('eav/entity_attribute');
        $fid = $attributeModel->getIdByCode('customer', 'le_sociallogin_fid');
        $ftoken = $attributeModel->getIdByCode('customer', 'le_sociallogin_ftoken');

        $gid = $attributeModel->getIdByCode('customer', 'le_sociallogin_gid');
        $gtoken = $attributeModel->getIdByCode('customer', 'le_sociallogin_gtoken');

        $tid = $attributeModel->getIdByCode('customer', 'le_sociallogin_tid');
        $ttoken = $attributeModel->getIdByCode('customer', 'le_sociallogin_ttoken');

        $lid = $attributeModel->getIdByCode('customer', 'le_sociallogin_lid');
        $ltoken = $attributeModel->getIdByCode('customer', 'le_sociallogin_ltoken');

        $yid = $attributeModel->getIdByCode('customer', 'le_sociallogin_yid');
        $ytoken = $attributeModel->getIdByCode('customer', 'le_sociallogin_ytoken');

        if($fid == false || $ftoken == false ||
            $gid == false || $gtoken == false ||
            $tid == false || $ttoken  == false ||
            $lid == false || $ltoken == false ||
            $yid == false || $ytoken == false
        ){

            $setup = Mage::getModel('customer/entity_setup','core_setup');
            if($fid == false){
                echo 'le_sociallogin_fid not exits <br />';
                $setup->addAttribute('customer', 'le_sociallogin_fid', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_fid setup ok<br />';
            }
            if($ftoken == false){
                echo 'le_sociallogin_ftoken not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_ftoken', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_ftoken setup ok<br />';
            }
            if($gid == false){
                echo 'le_sociallogin_gid not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_gid', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_gid setup ok<br />';
            }
            if($gtoken == false){
                echo 'le_sociallogin_gtoken not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_gtoken', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_gtoken setup ok<br />';
            }
            if($tid == false){
                echo 'le_sociallogin_tid not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_tid', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_tid setup ok<br />';
            }
            if($ttoken == false){
                echo 'le_sociallogin_ttoken not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_ttoken', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_ttoken setup ok<br />';
            }
            if($lid == false){
                echo 'le_sociallogin_lid not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_lid', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_lid setup ok<br />';
            }
            if($ltoken == false){
                echo 'le_sociallogin_ltoken not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_ltoken', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_ltoken setup ok<br />';
            }
            if($yid == false){
                echo 'le_sociallogin_yid not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_yid', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_yid setup ok<br />';
            }
            if($ytoken == false){
                echo 'le_sociallogin_ytoken not exits<br />';
                $setup->addAttribute('customer', 'le_sociallogin_ytoken', array(
                    'type' => 'text',
                    'visible' => 0,
                    'required' => 0,
                    'user_defined' => 0,
                ));
                echo 'le_sociallogin_ytoken setup ok<br />';
            }

            if (version_compare(Mage::getVersion(), '1.6.0', '<='))
            {
                $customer = Mage::getModel('customer/customer');
                $attrSetId = $customer->getResource()->getEntityType()->getDefaultAttributeSetId();
                $setup->addAttributeToSet('customer', $attrSetId, 'General', 'le_sociallogin_fid');
            }
            if (version_compare(Mage::getVersion(), '1.4.2', '>='))
            {
                Mage::getSingleton('eav/config')
                    ->getAttribute('customer', 'le_sociallogin_fid')
                    ->save();
            }

            echo "Setup complete<br />";
        } else {
            echo 'All attr exits. Nothing to do.';
        }
    }
}