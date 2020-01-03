<?php $this->load->view("shared/header", array("page_title"=> $page_title)); ?>
<body>
  <!-- container section start -->
  <section id="container" class="">


   <?php $this->load->view("shared/body_header"); ?>
    <!--header end-->

    <!--sidebar start-->
   <?php $this->load->view("shared/sidebar"); ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper"> 
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Process</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>index.php/User/results">Results</a></li>
              <li><i class="fa fa-list-alt"></i><a href="<?php echo base_url(); ?>index.php/User/student/<?php echo $term; ?>/<?php echo strtolower($exam_type_title); ?>/<?php echo $student_id; ?>/<?php echo $sample_id; ?>">Analytics</a></li>
            </ol>
          </div>
        </div>  
        <div class="row">
           <div class="col-md-4">
           <?php 
           if(!empty($student)){  ?>
              <ul class="list-group">
                <?php 
                  foreach($student as $stud){
                    ?>
                    <li class="list-group-item">Name: <b><?php echo $stud['student']; ?></b></li>
                    <li class="list-group-item">Sex: <b><?php echo $stud['sex']; ?></b></li>
                    <li class="list-group-item">Regno: <b><?php echo $stud['regno']; ?></b></li>
                    <li class="list-group-item">Class: <b><?php echo $stud['class']; ?></b></li>
                    <li class="list-group-item">Date registered: <b><?php echo $stud['dateadded']; ?></b></li>
                    <?php 
                    $class_extract = explode(' ', $stud['class']);
                    if($class_extract[0] == 'P.7'){
                      ?>
                      <li class="list-group-item">Prediction stats: &nbsp;&nbsp;<i class="fa fa-eye"></i> <a data-backdrop="static" data-toggle="modal" href="#prediction">View</a> </li>
                    <div class="modal fade" id="prediction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Prediction statistics</h4>
                          </div>
                          <div class="modal-body">
                              <!-- use yearly data to compile statistics getting averages and present grading system -->                              
                             <?php $get_entire_students_record = $this->db->query("SELECT * FROM bulk_data S WHERE S.id = '".$student_id."' ")->result_array(); ?>
                             <?php if(!empty($get_entire_students_record)){
                                      foreach($get_entire_students_record as $studn){
                                        ?>
                                        <div class="row">
                                              <div class="col-md-4">
                                                <h4>Term 1 Results: </h4>
                                                <?php $term_1_mtc = $term_2_mtc = $term_3_mtc = $term_1_eng = $term_2_eng = $term_3_eng = $term_1_sci = $term_2_sci = $term_3_sci = $term_1_sst = $term_2_sst = ''; ?>
                                                <ul class="list-group">
                                                  <?php $term_1_mtc = round((($studn['t1_bot_mtc'] + $studn['t1_mot_mtc'] + $studn['t1_eot_mtc']) / 3), 2); 
                                                        $term_2_mtc = round((($studn['t2_bot_mtc'] + $studn['t2_mot_mtc'] + $studn['t2_eot_mtc']) / 3), 2);
                                                        $term_3_mtc = round((($studn['t3_bot_mtc'] + $studn['t3_mot_mtc'] + $studn['t3_eot_mtc']) / 3), 2);
                                                        //eng
                                                        $term_2_eng = round((($studn['t2_bot_eng'] + $studn['t2_mot_eng'] + $studn['t2_eot_eng']) / 3), 2);
                                                        $term_1_eng = round((($studn['t1_bot_eng'] + $studn['t1_mot_eng'] + $studn['t1_eot_eng']) / 3), 2);
                                                        $term_3_eng = round((($studn['t3_bot_eng'] + $studn['t3_mot_eng'] + $studn['t3_eot_eng']) / 3), 2);
                                                        //sci
                                                        $term_1_sci = round((($studn['t1_bot_sci'] + $studn['t1_mot_sci'] + $studn['t1_eot_sci']) / 3), 2);
                                                        $term_2_sci = round((($studn['t2_bot_sci'] + $studn['t2_mot_sci'] + $studn['t2_eot_sci']) / 3), 2);
                                                        $term_3_sci = round((($studn['t3_bot_sci'] + $studn['t3_mot_sci'] + $studn['t3_eot_sci']) / 3), 2);
                                                        //sst
                                                        $term_1_sst = round((($studn['t1_bot_sst'] + $studn['t1_mot_sst'] + $studn['t1_eot_sst']) / 3), 2);
                                                        $term_2_sst = round((($studn['t2_bot_sst'] + $studn['t2_mot_sst'] + $studn['t2_eot_sst']) / 3), 2);
                                                        $term_3_sst = round((($studn['t3_bot_sst'] + $studn['t3_mot_sst'] + $studn['t3_eot_sst']) / 3), 2); 

                                                  ?>
                                                  <li class="list-group-item">Math: <?php echo $term_1_mtc ; ?></li>
                                                  <li class="list-group-item">English: <?php echo $term_1_eng; ?></li>
                                                  <li class="list-group-item">Science: <?php echo $term_1_sci; ?></li>
                                                  <li class="list-group-item">SST: <?php echo $term_1_sst; ?></li>
                                                </ul>
                                              </div>
                                              <div class="col-md-4">
                                                <h4>Term 2 Results: </h4>
                                                <ul class="list-group">
                                                <li class="list-group-item">Math: <?php echo $term_2_mtc; ?></li>
                                                  <li class="list-group-item">English: <?php echo $term_2_eng; ?></li>
                                                  <li class="list-group-item">Science: <?php echo $term_2_sci; ?></li>
                                                  <li class="list-group-item">SST: <?php echo  $term_2_sst; ?></li>
                                                </ul>
                                              </div>
                                              <div class="col-md-4">
                                                <h4>Term 3 Results: </h4>
                                                <ul class="list-group">
                                                <li class="list-group-item">Math: <?php echo $term_3_mtc; ?></li>
                                                  <li class="list-group-item">English: <?php echo $term_3_eng; ?></li>
                                                  <li class="list-group-item">Science: <?php echo $term_3_sci; ?></li>
                                                  <li class="list-group-item">SST: <?php echo $term_3_sst; ?></li>
                                                </ul>
                                              </div>                                
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                              <h4>Predicted Results:</h4>
                                              <ul class="list-group">
                                                <li class="list-group-item">Math: <?php echo round((($term_1_mtc + $term_2_mtc + $term_3_mtc) / 3), 2); ?></li>
                                                <li class="list-group-item">English: <?php echo round((($term_1_eng + $term_2_eng + $term_3_eng) / 3), 2); ?></li>
                                                <li class="list-group-item">Science: <?php echo round((($term_1_sci + $term_2_sci + $term_3_sci) / 3), 2); ?></li>
                                                <li class="list-group-item">SST: <?php echo round((($term_1_sst + $term_2_sst + $term_3_sst) / 3), 2); ?></li>
                                              </ul>
                                          </div>
                                          <div class="col-md-6">
                                            <h4>Grades:</h4>
                                            <ul class="list-group">                                              
                                              <?php //term => subjects 
                                                $term_mtc_avg =  round((($term_1_mtc + $term_2_mtc + $term_3_mtc) / 3), 2);
                                                $grades_mtc = $grades_eng = $grades_sci = $grades_sst = '';
                                                if($term_mtc_avg >= 80){
                                                  $grades_mtc = 1;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 75){
                                                  $grades_mtc = 2;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 70){
                                                  $grades_mtc = 3;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 60){
                                                  $grades_mtc = 4;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 55){
                                                  $grades_mtc = 5;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 50){
                                                  $grades_mtc = 6;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 45){
                                                  $grades_mtc = 7;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg >= 40){
                                                  $grades_mtc = 8;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }else if($term_mtc_avg < 40){
                                                  $grades_mtc = 9;
                                                  echo '<li class="list-group-item">'.$grades_mtc.'</li>';
                                                }
                                                //eng
                                                $term_eng_avg = round((($term_1_eng + $term_2_eng + $term_3_eng) / 3), 2);
                                                if($term_eng_avg >= 80){
                                                  $grades_eng = 1;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 75){
                                                  $grades_eng = 2;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 70){
                                                  $grades_eng = 3;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 60){
                                                  $grades_eng = 4;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 55){
                                                  $grades_eng = 5;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 50){
                                                  $grades_eng = 6;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 45){
                                                  $grades_eng = 7;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg >= 40){
                                                  $grades_eng = 8;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }else if($term_eng_avg < 40){
                                                  $grades_eng = 9;
                                                  echo '<li class="list-group-item">'.$grades_eng.'</li>';
                                                }
                                                //sci avg
                                                $term_sci_avg = round((($term_1_sci + $term_2_sci + $term_3_sci) / 3), 2);
                                                if($term_sci_avg >= 80){
                                                  $grades_sci = 1;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 75){
                                                  $grades_sci = 2;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 70){
                                                  $grades_sci = 3;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 60){
                                                  $grades_sci = 4;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 55){
                                                  $grades_sci = 5;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 50){
                                                  $grades_sci = 6;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 45){
                                                  $grades_sci = 7;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg >= 40){
                                                  $grades_sci = 8;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }else if($term_sci_avg < 40){
                                                  $grades_sci = 9;
                                                  echo '<li class="list-group-item">'.$grades_sci.'</li>';
                                                }
                                                //sst avg
                                                $term_sst_avg = round((($term_1_sst + $term_2_sst + $term_3_sst) / 3), 2);
                                                if($term_sst_avg >= 80){
                                                  $grades_sst = 1;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 75){
                                                  $grades_sst = 2;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 70){
                                                  $grades_sst = 3;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 60){
                                                  $grades_sst = 4;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 55){
                                                  $grades_sst = 5;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 50){
                                                  $grades_sst = 6;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 45){
                                                  $grades_sst = 7;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg >= 40){
                                                  $grades_sst = 8;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }else if($term_sst_avg < 40){
                                                  $grades_sst = 9;
                                                  echo '<li class="list-group-item">'.$grades_sst.'</li>';
                                                }
                                              ?>
                                            </ul>
                                          </div>
                                          <div class="col-md-12">
                                                <h4>PLE Grade Prediction: <?php $sum_grade = ($grades_mtc + $grades_eng + $grades_sci + $grades_sst); 
                                                echo $sum_grade;
                                                if($sum_grade <= 12){
                                                  echo '&nbsp;&nbsp;&nbsp;Grade: <b>First Grade</b>';
                                                }else if($sum_grade <= 24){
                                                  echo '&nbsp;&nbsp;&nbsp;Grade: <b>Second Grade</b>';
                                                }else if($sum_grade < 24){
                                                  echo '&nbsp;&nbsp;&nbsp;Grade: <b>Third Grade</b>';
                                                }
                                                
                                                ?></h4>
                                          </div>
                                        </div>
                                        <?php 
                                      }
                             } ?>
                          </div>
                          <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                            <button class="btn btn-success" type="button">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                      <?php 
                    }
                  }
                  ?>                
              </ul>
              <?php }else{
                ?>
                <div class="alert alert-danger">
                  <h4 class="smalltext">Students' records not found.</h4>
                </div>
                <?php 
              } ?>
           </div>
           <div class="col-md-4">&nbsp;</div>
          <input type="hidden" id="student_id" value="<?php echo !empty($student_id)? $student_id : ''; ?>" />
          <input type="hidden" id="sample_id" value="<?php echo !empty($sample_id)? $sample_id : ''; ?>" />
          <div class="col-md-4">
              <ul class="list-group">
              <li class="list-group-item">Record: <b><label for="yearly">Yearly:</label>&nbsp;&nbsp;<input type="radio" value="yearly" name="display" id="yearly" /></b>&nbsp;<b><label for="termly">Termly:</label> &nbsp;&nbsp;<input type="radio" value="termly" name="display" id="termly" checked="checked" /></b></li>
                  <li class="list-group-item">Term: &nbsp;&nbsp;<b><?php echo $term_title; ?></b></li>
                  <li class="list-group-item">Exam: &nbsp;&nbsp;<b><?php echo $exam_type_title; ?></b></li>
                  <li class="list-group-item subjects">Subject: &nbsp;&nbsp;<label for="all">All</label>&nbsp;&nbsp;<input type="checkbox" name="all" id="all" class="chk-sub" value="all" /> &nbsp;&nbsp;<label for="mtc">Math</label>&nbsp;&nbsp;<input type="checkbox" class="chk-sub" name="mtc" id="mtc" value="mtc" />&nbsp;&nbsp;<label for="eng">English</label>&nbsp;&nbsp;<input type="checkbox" name="eng" id="eng" class="chk-sub" value="eng" />&nbsp;&nbsp;<label for="sci">Science</label>&nbsp;&nbsp;<input type="checkbox" name="sci" id="sci" class="chk-sub" value="sci" />&nbsp;&nbsp;<label for="sst">SST</label>&nbsp;&nbsp;<input type="checkbox" name="sst" id="sst" value="sst" class="chk-sub" /></li>
                  <li id="terms" class="list-group-item terms">Term:  &nbsp;&nbsp;<label for="allTerms">All</label>&nbsp;&nbsp;<input type="radio" id="allTerms" name="term" value="allTerms" class="termSelected" /> &nbsp;&nbsp;<label for="t1">Term 1</label>&nbsp;&nbsp;<input type="radio" name="term" id="t1" value="Term 1" class="termSelected" <?php echo (($term == 't1')? 'checked' : ''); ?> />&nbsp;&nbsp;<label for="t2">Term 2</label>&nbsp;&nbsp;<input type="radio" name="term" class="termSelected" value="Term 2" id="t2" <?php echo (($term == 't2')? 'checked' : ''); ?> />&nbsp;&nbsp;<label for="t3">Term 3</label>&nbsp;&nbsp;<input type="radio" name="term" class="termSelected" value="Term 3" id="t3" <?php echo (($term == 't3')? 'checked' : ''); ?> /></li>
                  <li class="list-group-item exams"id="examTypeRow">Exam:  &nbsp;&nbsp;<label for="allExam">All</label>&nbsp;&nbsp;<input type="radio" id="allExam" name="exam_type" value="allExam" class="examSelected" /> &nbsp;&nbsp;<label for="bot">B.O.T</label>&nbsp;&nbsp;<input type="radio" name="exam_type" id="bot" value="BOT" class="examSelected" <?php echo ((strtolower($exam_type_title) == 'bot')? 'checked' : ''); ?> />  &nbsp;&nbsp;<label for="mot">M.O.T</label>&nbsp;&nbsp;<input type="radio" name="exam_type" class="examSelected" value="MOT" id="mot" <?php echo ((strtolower($exam_type_title) == 'mot')? 'checked' : ''); ?> /> &nbsp;&nbsp;<label for="eot">E.O.T</label>&nbsp;&nbsp;<input type="radio" name="exam_type" class="examSelected" value="EOT" id="eot" <?php echo ((strtolower($exam_type_title) == 'eot')? 'checked' : ''); ?> /></li>
              </ul>
          </div>
            
        </div>
        <div class="row">
          <div class="col-md-12" id="resultsCanvas"></div>                    
             <?php 
             $this->load->view("portal/student_results", 
                    array('student'=> $student)
                  ); 
             ?>
        </div>         
       
      </section>
      <div class="text-right">
        <div class="credits">        
          Designed by Athena</a>
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

<?php $this->load->view("shared/footer"); ?>
<script src="<?php echo base_url(); ?>assets/js/canvasjs.min.js"></script>
