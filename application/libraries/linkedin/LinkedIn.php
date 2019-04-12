<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Imran
 * Date: 4/3/2018
 * Time: 1:58 PM
 */

class LinkedIn
{
    public $userinfo;
    public $redirectURL;
    public $client;
    public function __construct() {

        $CI =& get_instance();
        $CI->config->load('linkedin');
        $userData = array();

        require  'http.php';
        require  'oauth_client.php';

        $this->client = new oauth_client_class;
        $this->client->client_id = $CI->config->item('linkedin_api_key');
        $this->client->client_secret = $CI->config->item('linkedin_api_secret');
        $this->client->redirect_uri = base_url().$CI->config->item('linkedin_redirect_url');
        $redirectURL=$this->client->redirect_uri;
        $this->client->scope = $CI->config->item('linkedin_scope');
        $this->client->debug = false;
        $this->client->debug_http = true;

        //$this->client->Process();
        $application_line = __LINE__;


    }

    public function getLoginUrl() {
        //If authentication returns success

        $params = array(
            'response_type=code',
            'client_id=' . urlencode($this->client->client_id),
            'scope=' . urlencode($this->client->scope),
            'redirect_uri=' . $this->client->redirect_uri,
            'oauth_init=' . '1'

        );


        $params = implode('&', $params);
      //response_type=code&client_id=e
        return "https://www.linkedin.com/oauth/v2/authorization?".$params;


//        $this->client->Initialize();
//            if(($success = $this->client->Process())){
//                if(strlen($this->client->authorization_error)){
//                    $this->client->error = $this->client->authorization_error;
//                    $success = false;
//                }elseif(strlen($this->client->access_token)){
//                    $success = $this->client->CallAPI('http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)',
//                        'GET',
//                        array('format'=>'json'),
//                        array('FailOnAccessError'=>true), $userInfo);
//                }
//            }
//            //$success = $this->client->Finalize($success);
//            $this->redirectURL=$success;



    }

    public function getAuthenticate() {
        if($success =$this->client->Initialize()){
            if(($success = $this->client->Process())){
                if(strlen($this->client->authorization_error)){
                    $this->client->error =$this->client->authorization_error;
                    return false;
                }elseif(strlen($this->client->access_token)){
                    return $this->client->CallAPI('https://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)',
                        'GET',
                        array('format'=>'json'),
                        array('FailOnAccessError'=>true), $this->userinfo);
                }
            }
            return $this->client->Finalize($success);
        }else{
            return 'Some problem occurred, please try again later!';
        }


    }

    public function getAccessToken() {
        return $this->client->access_token();
    }



    public function getUserInfo() {
        return $this->userinfo;
    }

}