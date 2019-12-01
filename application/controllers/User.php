<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {    

    function __construct(){
        parent::__construct();
        $isloggedin = $this->isLoggedin();
        if(!$isloggedin) redirect("Login/index");
    }

    function index(){      
        $data['page_title'] = 'Dashboard';        
        $this->load->view("portal/index", $data);
    }
    function upload(){
        $data['page_title'] = 'Upload';
        $this->load->view("portal/upload", $data);
    }
    function history(){
        $this->load->view("portal/history");
    }
    function logout(){
        $this->session->sess_destroy();
        redirect("Login/index");
    }
    //check if user is logged in
    function isLoggedin(){
        $state = FALSE;
        if(!empty($this->session->userdata['userid'])){
           $state = TRUE;
        }
        return $state;
    }
}
