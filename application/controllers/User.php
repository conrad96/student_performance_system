<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
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
}
