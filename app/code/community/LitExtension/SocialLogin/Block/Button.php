<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Block_Button extends Mage_Core_Block_Template{

    protected $_buttons;

    protected function _construct(){
        parent::_construct();
        $this->_addButtons();
        $this->setTemplate('le_sociallogin/button.phtml');
    }

    protected function _addButtons(){
        $this->_addButton(new LitExtension_SocialLogin_Block_Button_Type_Facebook());
        $this->_addButton(new LitExtension_SocialLogin_Block_Button_Type_Google());
        $this->_addButton(new LitExtension_SocialLogin_Block_Button_Type_Linkedin());
        $this->_addButton(new LitExtension_SocialLogin_Block_Button_Type_Twitter());
        $this->_addButton(new LitExtension_SocialLogin_Block_Button_Type_Yahoo());
    }

    protected function _addButton(LitExtension_SocialLogin_Block_Button_Type $button){
        $this->_buttons[] = $button;
    }

    protected function getButtons(){
        return $this->_buttons;
    }

}