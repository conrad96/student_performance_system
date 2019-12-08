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
                  //exam type
                  /** BOT TERM 1 */
                  $bot_t_1_1 = $objPHPExcel->getSheet($num)->getCell('D2')->getValue();
                  $this->db->insert("exam_type", array("type"=> $bot_t_1_1, "term_id"=> $term_1_id, "class_id"=> $class_id, "author"=> $this->session->userdata['userid']));
                  $bot_t_1_1_id = $this->db->insert_id();
                  //insert student name, reg, sex etc
                  $name = $objPHPExcel->getSheet($num)->getCell('A4')->getValue();
                  $sex = $objPHPExcel->getSheet($num)->getCell('B4')->getValue();
                  $regno = $objPHPExcel->getSheet($num)->getCell('C4')->getValue();
                  $this->db->insert("students", array("student"=> $name, "sex"=> $sex, "reg_no"=> $regno, "class_id"=> $class_id, "author"=> $this->session->userdata['userid']));
                  $student_id = $this->db->insert_id();
                  //results per subject
                  $mtc_t_1_1 = $this->db->insert("results_tbl", array(
                   "student_id"=> $student_id,
                   "term_id"=> $term_1_id,
                   "exam_type_id"=> $bot_t_1_1_id,
                   "mtc"=>  $objPHPExcel->getSheet($num)->getCell('D4')->getValue(),
                   "eng"=> $objPHPExcel->getSheet($num)->getCell('E4')->getValue(),
                   "sci"=> $objPHPExcel->getSheet($num)->getCell('F4')->getValue(),
                   "sst"=> $objPHPExcel->getSheet($num)->getCell('G4')->getValue(),
                   "author"=> $this->session->userdata['userid']
                   ));
                   /** END BOT TERM 1*/
                  /** MOT TERM 1*/
                  $mot_t_1_2 = $objPHPExcel->getSheet($num)->getCell('H2')->getValue();
                  $this->db->insert("exam_type", array("type"=> $mot_t_1_2, "term_id"=> $term_1_id, "class_id"=> $class_id, "author"=> $this->session->userdata['userid']));
                  $mot_t_1_2_id = $this->db->insert_id();
                  //results
                  $mot_t_1_2 = $this->db->insert("results_tbl", array(
                   "student_id"=> $student_id,
                   "term_id"=> $term_1_id,
                   "exam_type_id"=> $mot_t_1_2_id,
                   "mtc"=>  $objPHPExcel->getSheet($num)->getCell('H4')->getValue(),
                   "eng"=> $objPHPExcel->getSheet($num)->getCell('I4')->getValue(),
                   "sci"=> $objPHPExcel->getSheet($num)->getCell('J4')->getValue(),
                   "sst"=> $objPHPExcel->getSheet($num)->getCell('K4')->getValue(),
                   "author"=> $this->session->userdata['userid']
                  ));
                  /** END MOT TERM 1 */
                  /** EOT TERM 1*/
                  $eot_t_1_3 = $objPHPExcel->getSheet($num)->getCell('L2')->getValue();
                  $this->db->insert("exam_type", array("type"=> $eot_t_1_3, "term_id"=> $term_1_id, "class_id"=> $class_id, "author"=> $this->session->userdata['userid']));
                  $eot_t_1_3_id = $this->db->insert_id();
                  //results
                  $eot_t_1_3 = $this->db->insert("results_tbl", array(
                   "student_id"=> $student_id,
                   "term_id"=> $term_1_id,
                   "exam_type_id"=> $eot_t_1_3_id,
                   "mtc"=>  $objPHPExcel->getSheet($num)->getCell('L4')->getValue(),
                   "eng"=> $objPHPExcel->getSheet($num)->getCell('M4')->getValue(),
                   "sci"=> $objPHPExcel->getSheet($num)->getCell('N4')->getValue(),
                   "sst"=> $objPHPExcel->getSheet($num)->getCell('O4')->getValue(),
                   "author"=> $this->session->userdata['userid']
                  ));
                  /** END EOT TERM 1*/
                  //term 2
                  /** BOT TERM 2 */
                  $bot_t_2_1 = $objPHPExcel->getSheet($num)->getCell('Q2')->getValue();
                  $this->db->insert("exam_type", array("type"=> $bot_t_2_1, "term_id"=> $term_2_id, "class_id"=> $class_id, "author"=> $this->session->userdata['userid']));
                  $bot_t_2_1_id = $this->db->insert_id();
                  //results
                  $bot_t_2_1 = $this->db->insert("results_tbl", array(
                   "student_id"=> $student_id,
                   "term_id"=> $term_2_id,
                   "exam_type_id"=> $eot_t_1_3_id,
                   "mtc"=>  $objPHPExcel->getSheet($num)->getCell('Q4')->getValue(),
                   "eng"=> $objPHPExcel->getSheet($num)->getCell('R4')->getValue(),
                   "sci"=> $objPHPExcel->getSheet($num)->getCell('S4')->getValue(),
                   "sst"=> $objPHPExcel->getSheet($num)->getCell('T4')->getValue(),
                   "author"=> $this->session->userdata['userid']
                  ));
                  /** END BOT TERM 2*/
                  $mot_t_2_2 = $objPHPExcel->getSheet($num)->getCell('U2')->getValue();
                  $eot_t_2_3 = $objPHPExcel->getSheet($num)->getCell('Y2')->getValue();

                  //term 3
                  $bot_t_3_1 = $objPHPExcel->getSheet($num)->getCell('AD2')->getValue();
                  $mot_t_3_2 = $objPHPExcel->getSheet($num)->getCell('AH2')->getValue();
                  $eot_t_3_3 = $objPHPExcel->getSheet($num)->getCell('AL2')->getValue();

                  /*

                  //students
                  $student_name = $objPHPExcel->getSheet($num)->getCell('A3')->getValue()->__toString();
                  $student_sex = $objPHPExcel->getSheet($num)->getCell('B4')->getValue()->__toString();
                  $student_reg = $objPHPExcel->getSheet($num)->getCell('C4')->getValue()->__toString();
                  */
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
