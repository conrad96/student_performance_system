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
                  $first_term_db_entry = $this->db->insert_id();
                  //term ids
                  $term_1_id = $first_term_db_entry;
                  $term_2_id = $term_1_id + 1;
                  $term_3_id = $term_2_id + 1;
                  //exam typess
                 $exam_types = array();
                 $exam_types['bot_t_1_1'] = $objPHPExcel->getSheet($num)->getCell('D2')->getValue();
                 $exam_types['mot_t_1_2'] = $objPHPExcel->getSheet($num)->getCell('H2')->getValue();
                 $exam_types['eot_t_1_3'] = $objPHPExcel->getSheet($num)->getCell('L2')->getValue();
                 $exam_types['bot_t_2_1'] = $objPHPExcel->getSheet($num)->getCell('Q2')->getValue();
                 $exam_types['mot_t_2_2'] = $objPHPExcel->getSheet($num)->getCell('U2')->getValue();
                 $exam_types['eot_t_2_3'] = $objPHPExcel->getSheet($num)->getCell('Y2')->getValue();
                 $exam_types['bot_t_3_1'] = $objPHPExcel->getSheet($num)->getCell('AD2')->getValue();
                 $exam_types['mot_t_3_2'] = $objPHPExcel->getSheet($num)->getCell('AH2')->getValue();
                 $exam_types['eot_t_3_3'] = $objPHPExcel->getSheet($num)->getCell('AL2')->getValue();
                 $types_count = count($exam_types);

                 $this->db->insert_batch("exam_type", array(
                 array("term_id"=> $term_1_id, "type"=>  $exam_types['bot_t_1_1'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_1_id, "type"=>  $exam_types['mot_t_1_2'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_1_id, "type"=>  $exam_types['eot_t_1_3'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_2_id, "type"=>  $exam_types['bot_t_2_1'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_2_id, "type"=>  $exam_types['mot_t_2_2'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_2_id, "type"=>  $exam_types['eot_t_2_3'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_3_id, "type"=>  $exam_types['bot_t_3_1'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_3_id, "type"=>  $exam_types['mot_t_3_2'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 array("term_id"=> $term_3_id, "type"=>  $exam_types['eot_t_3_3'], "class_id"=> $class_id, "author"=> $this->session->userdata['userid']),
                 ));
                 $exam_type_id = $this->db->insert_id();

                 //students extract
                 $students = 48;
                 for($stud = 4; $stud < $students; $stud++){
                    $student_name = $objPHPExcel->getSheet($num)->getCell('A'.$stud)->getValue();
                    $student_sex = $objPHPExcel->getSheet($num)->getCell('B'.$stud)->getValue();
                    $student_reg = $objPHPExcel->getSheet($num)->getCell('C'.$stud)->getValue();
                    //save student
                    $this->db->insert('students', array(
                      'student'=> $student_name,
                      'sex'=> $student_sex,
                      'reg_no'=> $student_reg,
                      'class_id'=> $class_id,
                      'author'=> $this->session->userdata['userid']
                    ));
                    //get term and exam type id
                   for($type = 0; $type <= $types_count; $type++){
                    //insert students performance for each exam type with id
                    
                   }
                 }

                }//exit();
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
