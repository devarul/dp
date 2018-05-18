<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Block_Button_Type_Yahoo extends LitExtension_SocialLogin_Block_Button_Type{

    protected $_class = 'ico-yh';
    protected $_title = 'Yahoo';
    protected $_name = 'yahoo';
	protected $_name_ico = 'Login With Yahoo';
    protected $_width = 700;
    protected $_height = 500;
    protected $_disconnect = 'le_sociallogin/yahoo/disconnect';

    public function __construct($name = null, $class = null,$title=null){
        parent::__construct();

        $this->client = Mage::getSingleton('le_sociallogin/yahoo_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('le_sociallogin_yahoo_userinfo');

        if(!($redirect = Mage::getSingleton('customer/session')->getBeforeAuthUrl())) {
            $redirect = Mage::helper('core/url')->getCurrentUrl();
        }

        // Redirect uri
        Mage::getSingleton('core/session')->setYahooRedirect($redirect);
    }

}