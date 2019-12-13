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
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <h2>Filter Records</h2>
                    </div>
                    <div class="col-md-3">&nbsp;</div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <label class="col-md-2" for="sample">Uploaded Samples</label>
                    <div class="col-md-3">
                        <select name="terms" id="sample" class="input-sm form-control">
                            <option disabled>-Select-</option>
                           <?php 
                            if(!empty($samples)){
                                foreach($samples as $sample){
                                    print '<option value="'.$sample->id.'">'.$sample->sample_name.' ('.$sample->sample_file.')</option>';
                                }
                            }
                           ?>
                        </select>
                        <?php echo (empty($samples)? '<div class="alert alert-danger">No samples uploaded</div>' : '');  ?>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <label class="col-md-2" for="term">Term</label>
                    <div class="col-md-3">
                        <select name="terms" id="term" class="input-sm form-control">
                            <option disabled>-Select-</option>
                            <option>Term 1</option>
                            <option>Term 2</option>
                            <option>Term 3</option>
                        </select>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <label class="col-md-2" for="term">Exam</label>
                    <div class="col-md-3">
                        <select name="exam" id="exam" class="input-sm form-control">
                            <option disabled>-Select-</option>
                            <option>BOT</option>
                            <option>MOT</option>
                            <option>EOT</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>  
        <?php if(!empty($samples)){?>     
        <div class="row" id="resultsCanvas">
        <!-- datatable -->
          <?php 
            $this->load->view("portal/datatable", array("performance"=> $performance));
          ?>
        <div>
        <?php }else{
            print '<div class="col-md-12">
            <h3 class="alert alert-danger">No records found.</h3>
            </div>';
        } ?>
        </div>
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
