<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Block_Button_Type_Facebook extends LitExtension_SocialLogin_Block_Button_Type{

    protected $_class = 'ico-fb';
    protected $_title = 'Facebook';
    protected $_name = 'facebook';
	protected $_name_ico = 'Login With Facebook';
    protected $_width = 500;
    protected $_height = 270;
    protected $_disconnect = 'le_sociallogin/facebook/disconnect';

    public function __construct($name = null, $class = null,$title=null){
        parent::__construct();

        $this->client = Mage::getSingleton('le_sociallogin/facebook_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('le_sociallogin_facebook_userinfo');

        // CSRF protection
        //Mage::getSingleton('core/session')->setFacebookCsrf($csrf = md5(uniqid(rand(), TRUE)));
        //$this->client->setState($csrf);

        if(!($redirect = Mage::getSingleton('customer/session')->getBeforeAuthUrl())) {
            $redirect = Mage::helper('core/url')->getCurrentUrl();
        }

        // Redirect uri
        Mage::getSingleton('core/session')->setFacebookRedirect($redirect);

    }

}