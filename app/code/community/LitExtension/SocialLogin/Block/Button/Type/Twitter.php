<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Block_Button_Type_Twitter extends LitExtension_SocialLogin_Block_Button_Type{

    protected $_class = 'ico-tw';
    protected $_title = 'Twitter';
    protected $_name = 'twitter';
	protected $_name_ico = 'Login With Twitter';
    protected $_width = 700;
    protected $_height = 500;
    protected $_disconnect = 'le_sociallogin/twitter/disconnect';

    public function __construct($name = null, $class = null,$title=null){
        parent::__construct();

        $this->client = Mage::getSingleton('le_sociallogin/twitter_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('le_sociallogin_twitter_userinfo');

        if(!($redirect = Mage::getSingleton('customer/session')->getBeforeAuthUrl())) {
            $redirect = Mage::helper('core/url')->getCurrentUrl();
        }

        // Redirect uri
        Mage::getSingleton('core/session')->setTwitterRedirect($redirect);
    }

}