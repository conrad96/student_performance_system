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
                //iterate all sheets and save data for each sheet
                $num_sheets = $objPHPExcel->getSheetCount();

                for($num = 0; $num < $num_sheets; $num++){
                  $class_fields = array();

                  $class = $objPHPExcel->getSheet($num)->getCell('A1')->getValue()->__toString();
                  //store class
                  $class_fields['class'] = $class;
                  $class_fields['author'] = $this->session->userdata['userid'];
                  $this->db->insert("class", $class_fields);
                  $class_id = $this->db->insert_id();
                  //term
                  $term_1 = $objPHPExcel->getSheet($num)->getCell('H1')->getValue();
                  $term_2 = $objPHPExcel->getSheet($num)->getCell('U1')->getValue();
                  $term_3 = $objPHPExcel->getSheet($num)->getCell('AH1')->getValue();
                  //insert terms
                  $terms = array(
                    array(
                      "term"=>$term_1,
                      "class_id"=> $class_id,
                      "author"=> $this->session->userdata['userid']
                    ),
                    array(
                      "term"=>$term_2,
                      "class_id"=> $class_id,
                      "author"=> $this->session->userdata['userid']
                    ),
                    array(
                      "term"=>$term_3,
                      "class_id"=> $class_id,
                      "author"=> $this->session->userdata['userid']
                    )
                  );
                  $terms_inserted = count($terms);
                  $this->db->insert_batch("terms", $terms);
                  $saved_terms_id = $this->db->insert_id();
                  //term ids
                  $term_1_id = $saved_terms_id;
                  $term_2_id = $term_1_id + 1;
                  $term_3_id = $term_2_id + 1;
                  /*
                  //students
                  $student_name = $objPHPExcel->getSheet($num)->getCell('A3')->getValue()->__toString();
                  $student_sex = $objPHPExcel->getSheet($num)->getCell('B4')->getValue()->__toString();
                  $student_reg = $objPHPExcel->getSheet($num)->getCell('C4')->getValue()->__toString();

                  //exam type
                  $bot_exam_type = $objPHPExcel->getSheet($num)->getCell('D2')->getValue()->__toString();
                  $mot_exam_type = $objPHPExcel->getSheet($num)->getCell('H2')->getValue()->__toString();
                  $eot_exam_type = $objPHPExcel->getSheet($num)->getCell('L2')->getValue()->__toString();
                  */
                }exit();
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
