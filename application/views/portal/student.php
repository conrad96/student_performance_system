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
        <div class="row" id="resultsCanvas">                    
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
