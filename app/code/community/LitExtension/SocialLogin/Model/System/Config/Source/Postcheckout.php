<?php

/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */
class LitExtension_SocialLogin_Model_System_Config_Source_Postcheckout {

    public function toOptionArray() {
        return array(
            array('value' => '1', 'label' => Mage::helper('adminhtml')->__('Top')),
            array('value' => 'bottom', 'label' => Mage::helper('adminhtml')->__('Bottom')),
            array('value' => '0', 'label' => Mage::helper('adminhtml')->__("Don't Show")),
        );
    }

}
