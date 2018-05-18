<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Block_Button_Type_Google extends LitExtension_SocialLogin_Block_Button_Type{

    protected $_class = 'ico-go';
    protected $_title = 'Google';
    protected $_name = 'google';
	protected $_name_ico = 'Login With Google';
    protected $_width = 700;
    protected $_height = 500;
    protected $_disconnect = 'le_sociallogin/google/disconnect';

    public function __construct($name = null, $class = null,$title=null){
        parent::__construct();

        $this->client = Mage::getSingleton('le_sociallogin/google_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('le_sociallogin_google_userinfo');

//        // CSRF protection
//        Mage::getSingleton('core/session')->setGoogleCsrf($csrf = md5(uniqid(rand(), TRUE)));
//        $this->client->setState($csrf);

        if(!($redirect = Mage::getSingleton('customer/session')->getBeforeAuthUrl())) {
            $redirect = Mage::helper('core/url')->getCurrentUrl();
        }

        // Redirect uri
        Mage::getSingleton('core/session')->setGoogleRedirect($redirect);
    }

}