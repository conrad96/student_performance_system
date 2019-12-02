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
        if(!empty($_POST)){
            //process file uploaded
            //move file to samples folder
            $file_name = $_FILES['recordFile']['name'];
            $file = $_FILES['recordFile']['tmp_name'];
            $sample_name = strtolower(str_replace(' ', '_', $_POST['record_file']));

            $path = $_SERVER['DOCUMENT_ROOT'];
            $fileName = $sample_name.'_'.$file_name;
            if(move_uploaded_file($file, $path.'/sps/assets/samples/'.$fileName)){
                //store in database
                $sample = array();
                $sample['sample_name'] = $_POST['record_file'];
                $sample['sample_file'] = $fileName;
                $sample['author'] = $this->session->userdata['userid'];
                $this->db->insert("sample_data", $sample);
                //store students records
                $sample_id = $this->db->insert_id();
                //load file
                $excel_file = $path.'/sps/assets/samples/'.$fileName;
                $objPHPExcel = PHPExcel_IOFactory::load($excel_file);
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                
            }else{
              $data['msg'] = 'Error!. File upload failed, please try again';
            }
        }
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
