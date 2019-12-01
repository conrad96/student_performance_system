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
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>index.php/User/index">Home</a></li>
              <li><i class="fa fa-cog"></i> Process</li>
              <li><i class="fa fa-upload"></i>Upload</li>
            </ol>
          </div>
        </div>   
        <div class="row">
          <div class="col-lg-6">
            <section class="panel">
              <header class="panel-heading">
                Student records upload
              </header>
              <div class="panel-body">
                <form role="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/User/upload" method="POST">
                  <div class="form-group">
                    <label for="recordTitle">Record title</label>
                    <input type="text" class="form-control" name="record_file" id="recordTitle" placeholder="Enter Record title">
                  </div>                  
                  <div class="form-group">
                    <label for="fileUpload">File upload</label>
                    <input name="recordFile" type="file" id="fileUpload">
                    <p class="help-block">.xls files allowed</p>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" checked> keep students records
                    </label>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
              </div>
            </section>
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
