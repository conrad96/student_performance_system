<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
    }
    function index(){
       $this->load->view("login/index");       
    }
    function login(){
        $data = array();
        if(!empty($_POST)){
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $fetch_user = $this->db->query("SELECT * FROM users u WHERE u.uname LIKE '".$username."' AND u.password LIKE '".$password."'")->result();
            if(!empty($fetch_user)){
                //set session
                $userdata = array();
                foreach($fetch_user as $user){
                    $userdata['userid'] = $user->id;
                    $userdata['names'] = $user->full_names;
                    $userdata['role'] = $user->role;
                }
                $this->session->set_userdata($userdata);
            }else{
                $data['msg'] = "incorrect username or password";
            }
        }
        $this->load->view("login/index", $data);
    }

}
