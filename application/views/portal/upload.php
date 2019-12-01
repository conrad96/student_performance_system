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
        <?php 
        print '<pre>';
        print_r();
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
