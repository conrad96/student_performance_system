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
           <?php if(!empty($student)){ ?>
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
          <div class="col-md-4">
              <ul class="list-group">
              <li class="list-group-item">Record: <b><label for="yearly">Yearly:</label>&nbsp;&nbsp;<input type="checkbox" value="yearly" name="yearly" id="yearly" /></b>&nbsp;<b><label for="termly">Termly:</label> &nbsp;&nbsp;<input type="checkbox" value="termly" name="termly" id="termly" checked="checked" /></b></li>
                  <li class="list-group-item">Term: &nbsp;&nbsp;<b><?php echo $term_title; ?></b></li>
                  <li class="list-group-item">Exam: &nbsp;&nbsp;<b><?php echo $exam_type_title; ?></b></li>
                  <li class="list-group-item subjects">Subject: &nbsp;&nbsp;<label for="all">All</label>&nbsp;&nbsp;<input type="checkbox" name="all" id="all" /> &nbsp;&nbsp;<label for="mtc">Math</label>&nbsp;&nbsp;<input type="checkbox" class="chk-sub" name="mtc" id="mtc" />&nbsp;&nbsp;<label for="eng">English</label>&nbsp;&nbsp;<input type="checkbox" name="eng" id="eng" class="chk-sub" />&nbsp;&nbsp;<label for="sci">Science</label>&nbsp;&nbsp;<input type="checkbox" name="sci" id="sci" class="chk-sub" />&nbsp;&nbsp;<label for="sst">SST</label>&nbsp;&nbsp;<input type="checkbox" name="sst" id="sst" class="chk-sub" /></li>
                  <li class="list-group-item">Term:  &nbsp;&nbsp;<label for="allTerms">All</label>&nbsp;&nbsp;<input type="checkbox" name="all" id="allTerms" /> &nbsp;&nbsp;<label for="t1">Term 1</label>&nbsp;&nbsp;<input type="radio" name="term" id="t1" <?php echo (($term == 't1')? 'checked' : ''); ?> />&nbsp;&nbsp;<label for="t2">Term 2</label>&nbsp;&nbsp;<input type="radio" name="term" id="t2" <?php echo (($term == 't2')? 'checked' : ''); ?> />&nbsp;&nbsp;<label for="t3">Term 3</label>&nbsp;&nbsp;<input type="radio" name="term" id="t3" <?php echo (($term == 't3')? 'checked' : ''); ?> /></li>
              </ul>
          </div>
            
        </div>
        <div class="row">
              <!-- <pre>
              <?php //print_r($student); ?>
              </pre> -->
              <?php 
              if(!empty($student)){
                $math = array();
                $english = array();
                $science = array();
                $sst = array();

                $obj_mtc = $term.'_'.strtolower($exam_type_title).'_mtc';
                $obj_eng = $term.'_'.strtolower($exam_type_title).'_eng';
                $obj_sci = $term.'_'.strtolower($exam_type_title).'_sci';
                $obj_sst = $term.'_'.strtolower($exam_type_title).'_sst';
                $counter = 0;

                //initialise
                $math['x'] = 100;
                $math['y'] = $student[$counter][$obj_mtc];

                $english['x'] = 100;
                $english['y'] = $student[$counter][$obj_eng];

                $science['x'] = 100;
                $science['y'] = $student[$counter][$obj_sci];

                $sst['x'] = 100;
                $sst['y'] = $student[$counter][$obj_sst];                                                                                           
              }
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
