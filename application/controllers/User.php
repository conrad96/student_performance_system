<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
        parent::__construct();
        $isloggedin = $this->isLoggedin();
        if(!$isloggedin) redirect("Login/index");
    }

    function index(){
        $data['page_title'] = 'Dashboard';
        $data['samples'] = $this->db->get("sample_data")->num_rows();
        $data['students'] = $this->db->get("bulk_data")->num_rows();
        $data['users'] = $this->db->get("users")->num_rows();
        $data['results'] = $this->db->query("
        SELECT BD.student, BD.sex, BD.regno, BD.class
        FROM bulk_data BD        
        ")->result();
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
            $status = null;
            for($num = 0; $num < $num_sheets; $num++){
              $counter_max = 40;
              $row = 4;
              for($counter = 0; $counter < $counter_max; $counter++){
                $student = $objPHPExcel->getSheet($num)->getCell('A'.$row)->getValue();
                $sex = $objPHPExcel->getSheet($num)->getCell('B'.$row)->getValue();
                $regno = $objPHPExcel->getSheet($num)->getCell('C'.$row)->getValue();
                $class = $objPHPExcel->getSheet($num)->getCell('A1')->getValue()->__toString();
                //insert results
                //term 1
                $t1_bot_mtc = $objPHPExcel->getSheet($num)->getCell('D'.$row)->getValue();
                $t1_bot_eng = $objPHPExcel->getSheet($num)->getCell('E'.$row)->getValue();
                $t1_bot_sci = $objPHPExcel->getSheet($num)->getCell('F'.$row)->getValue();
                $t1_bot_sst = $objPHPExcel->getSheet($num)->getCell('G'.$row)->getValue();
                //mot
                $t1_mot_mtc = $objPHPExcel->getSheet($num)->getCell('H'.$row)->getValue();
                $t1_mot_eng = $objPHPExcel->getSheet($num)->getCell('I'.$row)->getValue();
                $t1_mot_sci = $objPHPExcel->getSheet($num)->getCell('J'.$row)->getValue();
                $t1_mot_sst = $objPHPExcel->getSheet($num)->getCell('K'.$row)->getValue();
                //eot
                $t1_eot_mtc = $objPHPExcel->getSheet($num)->getCell('L'.$row)->getValue();
                $t1_eot_eng = $objPHPExcel->getSheet($num)->getCell('M'.$row)->getValue();
                $t1_eot_sci = $objPHPExcel->getSheet($num)->getCell('N'.$row)->getValue();
                $t1_eot_sst = $objPHPExcel->getSheet($num)->getCell('O'.$row)->getValue();
                //Term 2
                $t2_bot_mtc = $objPHPExcel->getSheet($num)->getCell('Q'.$row)->getValue();
                $t2_bot_eng = $objPHPExcel->getSheet($num)->getCell('R'.$row)->getValue();
                $t2_bot_sci = $objPHPExcel->getSheet($num)->getCell('S'.$row)->getValue();
                $t2_bot_sst = $objPHPExcel->getSheet($num)->getCell('T'.$row)->getValue();
                //mot
                $t2_mot_mtc = $objPHPExcel->getSheet($num)->getCell('U'.$row)->getValue();
                $t2_mot_eng = $objPHPExcel->getSheet($num)->getCell('V'.$row)->getValue();
                $t2_mot_sci = $objPHPExcel->getSheet($num)->getCell('W'.$row)->getValue();
                $t2_mot_sst = $objPHPExcel->getSheet($num)->getCell('X'.$row)->getValue();
                //eot
                $t2_eot_mtc = $objPHPExcel->getSheet($num)->getCell('Y'.$row)->getValue();
                $t2_eot_eng = $objPHPExcel->getSheet($num)->getCell('Z'.$row)->getValue();
                $t2_eot_sci = $objPHPExcel->getSheet($num)->getCell('AA'.$row)->getValue();
                $t2_eot_sst = $objPHPExcel->getSheet($num)->getCell('AB'.$row)->getValue();
                //Term 3
                $t3_bot_mtc = $objPHPExcel->getSheet($num)->getCell('AD'.$row)->getValue();
                $t3_bot_eng = $objPHPExcel->getSheet($num)->getCell('AE'.$row)->getValue();
                $t3_bot_sci = $objPHPExcel->getSheet($num)->getCell('AF'.$row)->getValue();
                $t3_bot_sst = $objPHPExcel->getSheet($num)->getCell('AG'.$row)->getValue();
                //mot
                $t3_mot_mtc = $objPHPExcel->getSheet($num)->getCell('AH'.$row)->getValue();
                $t3_mot_eng = $objPHPExcel->getSheet($num)->getCell('AI'.$row)->getValue();
                $t3_mot_sci = $objPHPExcel->getSheet($num)->getCell('AJ'.$row)->getValue();
                $t3_mot_sst = $objPHPExcel->getSheet($num)->getCell('AK'.$row)->getValue();
                //eot
                $t3_eot_mtc = $objPHPExcel->getSheet($num)->getCell('AL'.$row)->getValue();
                $t3_eot_eng = $objPHPExcel->getSheet($num)->getCell('AM'.$row)->getValue();
                $t3_eot_sci = $objPHPExcel->getSheet($num)->getCell('AN'.$row)->getValue();
                $t3_eot_sst = $objPHPExcel->getSheet($num)->getCell('AO'.$row)->getValue();
                //insert into database
                $status = $this->db->insert("bulk_data", array(
                  "sample_id"=> $sample_id,
                  "student"=> $student,
                  "sex"=> $sex,
                  "regno"=> $regno,
                  "class"=> $class,
                  "t1_bot_mtc"=> $t1_bot_mtc,
                  "t1_bot_eng"=> $t1_bot_eng,
                  "t1_bot_sci"=> $t1_bot_sci,
                  "t1_bot_sst"=> $t1_bot_sst,
                  "t1_mot_mtc"=> $t1_mot_mtc,
                  "t1_mot_eng"=> $t1_mot_eng,
                  "t1_mot_sci"=> $t1_mot_sci,
                  "t1_mot_sst"=> $t1_mot_sst,
                  "t1_eot_mtc"=> $t1_eot_mtc,
                  "t1_eot_eng"=> $t1_eot_eng,
                  "t1_eot_sci"=> $t1_eot_sci,
                  "t1_eot_sst"=> $t1_eot_sst,
                  "t2_bot_mtc"=> $t2_bot_mtc,
                  "t2_bot_eng"=> $t2_bot_eng,
                  "t2_bot_sci"=> $t2_bot_sci,
                  "t2_bot_sst"=> $t2_bot_sst,
                  "t2_mot_mtc"=> $t2_mot_mtc,
                  "t2_mot_eng"=> $t2_mot_eng,
                  "t2_mot_sci"=> $t2_mot_sci,
                  "t2_mot_sst"=> $t2_mot_sst,
                  "t2_eot_mtc"=> $t2_eot_mtc,
                  "t2_eot_eng"=> $t2_eot_eng,
                  "t2_eot_sci"=> $t2_eot_sci,
                  "t2_eot_sst"=> $t2_eot_sst,
                  "t3_bot_mtc"=> $t3_bot_mtc,
                  "t3_bot_eng"=> $t3_bot_eng,
                  "t3_bot_sci"=> $t3_bot_sci,
                  "t3_bot_sst"=> $t3_bot_sst,
                  "t3_mot_mtc"=> $t3_mot_mtc,
                  "t3_mot_eng"=> $t3_mot_eng,
                  "t3_mot_sci"=> $t3_mot_sci,
                  "t3_mot_sst"=> $t3_mot_sst,
                  "t3_eot_mtc"=> $t3_bot_mtc,
                  "t3_eot_eng"=> $t3_bot_eng,
                  "t3_eot_sci"=> $t3_bot_sci,
                  "t3_eot_sst"=> $t3_bot_sst
                ));


                $row++;
              }
            }
            
          }//move_uploaded_file
          $data['msg'] = ($status != null)? "success__Upload successfully. <a href='".base_url()."index.php/User/index'>Lookup students records here... </a>" : "danger__Upload failed";   
        }        
        
        $this->load->view("portal/upload", $data);
    }
    function history(){
        $this->load->view("portal/history");
    }
    function results(){
      $data['page_title'] = 'Results';
      $data['samples'] = $this->db->get("sample_data")->result();
      //use first sample data record
      $sample_ids = array();
      if(!empty($data['samples'])){
        foreach($data['samples'] as $sample){
          array_push($sample_ids, $sample->id); 
        }
      }
      $data['examtype'] = 'BOT';
      $data['term'] = array('title'=>'Term 1', 'type'=> 't1');
      $data['performance'] = $this->db->query("SELECT BD.id, BD.sample_id,
      BD.student, 
      BD.".$data['term']['type']."_".strtolower($data['examtype'])."_mtc, 
      BD.".$data['term']['type']."_".strtolower($data['examtype'])."_eng,
      BD.".$data['term']['type']."_".strtolower($data['examtype'])."_sci,
      BD.".$data['term']['type']."_".strtolower($data['examtype'])."_sst
      FROM bulk_data BD WHERE BD.sample_id IN (".implode(",", $sample_ids).") ")->result_array();
      $this->load->view("portal/results", $data);
    }
    function filter(){
      $data = array();            
        if(!empty($_POST)){          
          $sql = "SELECT  BD.id, BD.student, BD.sample_id, ". 
           $_POST['field']."_mtc, ".
           $_POST['field']."_eng, ".
           $_POST['field']."_sci, ".
           $_POST['field']."_sst ".
           "FROM bulk_data BD WHERE BD.sample_id = '".$_POST['sampleId']."' ";
          $data['examtype'] = strtoupper($_POST['examType']);

          if($_POST['term'] == 't1'){
            $data['term'] = 'Term 1';
            $data['termtype'] = 't1';
          }else
          if($_POST['term'] == 't2'){
            $data['term'] = 'Term 2';
            $data['termtype'] = 't2';
          }else
          if($_POST['term'] == 't3'){
            $data['term'] = 'Term 3';
            $data['termtype'] = 't3';
          }
          $data['performance'] = $this->db->query($sql)->result_array();          
        }      
        $this->load->view("portal/datatable", $data);
    }
    function student($term_type, $exam_type, $student_id, $sample_id){
      $data['page_title'] = 'Analysis';
      $data['student_id'] = $student_id;
      $data['sample_id'] = $sample_id;
      $data['term'] = $term_type;
      $data['exam_type_title'] = strtoupper($exam_type);
      if($term_type == 't1'){
        $data['term_title'] = 'Term 1';
      }else if($term_type == 't2'){
        $data['term_title'] = 'Term 2';
      }else if($term_type == 't3'){
        $data['term_title'] = 'Term 3';
      }

      $data['student'] = $this->db->query("SELECT BD.student, BD.sex, BD.regno, BD.class, BD.dateadded,
      ".$term_type."_".$exam_type."_mtc, 
      ".$term_type."_".$exam_type."_eng, 
      ".$term_type."_".$exam_type."_sci, 
      ".$term_type."_".$exam_type."_sst 
      FROM bulk_data BD WHERE BD.id = '".$student_id."' AND BD.sample_id = '".$sample_id."' ")->result_array();
      $this->load->view("portal/student", $data);
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
