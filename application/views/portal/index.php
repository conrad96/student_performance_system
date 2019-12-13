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
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cloud-download"></i>
              <div class="count"><?php echo number_format($samples); ?></div>
              <div class="title">Samples</div>
            </div>            
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-group"></i>
              <div class="count"><?php echo number_format($students); ?></div>
              <div class="title">Students</div>
            </div>            
          </div>          

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-user"></i>
              <div class="count"><?php echo number_format($users); ?></div>
              <div class="title">Users</div>
            </div>
            <!--/.info-box-->
          </div>          

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-cubes"></i>
              <div class="count">0</div>
              <div class="title">Threshold</div>
            </div>
            <!--/.info-box-->
          </div>
          
        </div>
        <!-- datatable showing students -->        
        <div class="row">
        <!-- datatable -->
          <div class="col-md-12">
          <?php 
          if(!empty($results)){
            ?>
            <table id="student-table" class="display" style="width:100%;">
              <thead>
                <tr>
                  <td>Student</td>
                  <td>Sex</td>
                  <td>Regno</td>
                  <td>Class</td>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($results as $result){
                    print '<tr>'. 
                          '<td>'.$result->student.'</td>'.
                          '<td>'.$result->sex.'</td>'.
                          '<td>'.$result->regno.'</td>'.
                          '<td>'.$result->class.'</td>'. 
                          '</tr>';
                  }
                ?>
              </tbody>
            </table>
            <?php 
          }else{
            print '<div class="col-md-12">
            <h3 class="alert alert-danger">No records found.</h3>
            </div>';
          }
          ?>            
          </div>
        <div>
        
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
