<?php

/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */
class LitExtension_SocialLogin_Model_System_Config_Source_Position {

    public function toOptionArray() {
        return array(
            array('value' => 'top', 'label' => Mage::helper('adminhtml')->__('Top')),
            array('value' => 'inloginbox', 'label' => Mage::helper('adminhtml')->__('In Login Box')),
            array('value' => 'belowloginbox', 'label' => Mage::helper('adminhtml')->__('Bottom')),
            array('value' => 'dontshow', 'label' => Mage::helper('adminhtml')->__("Don't Show")),
        );
    }

}
