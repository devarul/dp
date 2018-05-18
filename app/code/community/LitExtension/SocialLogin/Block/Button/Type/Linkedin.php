<?php
/**
 * @project     SocialLogin
 * @package     LitExtension_SocialLogin
 * @author      LitExtension
 * @email       litextension@gmail.com
 */

class LitExtension_SocialLogin_Block_Button_Type_Linkedin extends LitExtension_SocialLogin_Block_Button_Type{

    protected $_class = 'ico-li';
    protected $_title = 'Linkedin';
    protected $_name = 'linkedin';
	protected $_name_ico = 'Login With Linkedin';
    protected $_width = 600;
    protected $_height = 500;
    protected $_disconnect = 'le_sociallogin/linkedin/disconnect';

    public function __construct($name = null, $class = null,$title=null){
        parent::__construct();

        $this->client = Mage::getSingleton('le_sociallogin/linkedin_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('le_sociallogin_linkedin_userinfo');

//        // CSRF protection
//        Mage::getSingleton('core/session')->setLinkedinCsrf($csrf = md5(uniqid(rand(), TRUE)));
//        $this->client->setState($csrf);

        if(!($redirect = Mage::getSingleton('customer/session')->getBeforeAuthUrl())) {
            $redirect = Mage::helper('core/url')->getCurrentUrl();
        }

        // Redirect uri
        Mage::getSingleton('core/session')->setLinkedinRedirect($redirect);
    }

}