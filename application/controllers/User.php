<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    function index(){      
        $data['page_title'] = 'Dashboard';
        $this->load->view("portal/index", $data);
    }
}
