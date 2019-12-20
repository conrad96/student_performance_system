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
              <li><i class="fa fa-list-alt"></i><a href="<?php echo base_url(); ?>index.php/User/student/<?php echo $student_id; ?>/<?php echo $sample_id; ?>">Analytics</a></li>
            </ol>
          </div>
        </div>  
        <div class="row">
           <div class="col-md-4">
              <ul class="list-group">
                <?php if(!empty($student)){ 
                  foreach($student as $stud){
                    ?>
                    <li class="list-group-item">Name: <b><?php echo $stud->student; ?></b></li>
                    <li class="list-group-item">Sex: <b><?php echo $stud->sex; ?></b></li>
                    <li class="list-group-item">Regno: <b><?php echo $stud->regno; ?></b></li>
                    <li class="list-group-item">Class: <b><?php echo $stud->class; ?></b></li>
                    <?php 
                  }
                  ?>
                <?php } ?>
              </ul>
           </div>
           <div class="col-md-4">&nbsp;</div>
          <div class="col-md-4">
              <ul class="list-group">
              <li class="list-group-item">Record: <b>Yearly:&nbsp;&nbsp;<input type="checkbox" value="yearly" name="yearly" id="yearly" /></b>&nbsp;<b>Termly: &nbsp;&nbsp;<input type="checkbox" value="termly" name="termly" id="termly" checked="checked" /></b></li>
                  <li class="list-group-item">Term: &nbsp;&nbsp;<b><?php echo $term_title; ?></b></li>
                  <li class="list-group-item">Exam: &nbsp;&nbsp;<b></b></li>
                  <li class="list-group-item">Subject: &nbsp;&nbsp;<b></b></li>
              </ul>
          </div>
            
        </div>
        <div class="row">
        
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
