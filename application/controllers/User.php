<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    function index(){
        if(!isset($this->session->userid)){
            redirect("Login/index");
        }
        $this->load->view("portal/index");
    }
}
