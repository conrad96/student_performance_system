
<?php $this->load->view("shared/header"); ?>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" action="<?php echo base_url(); ?>index.php/Login/login" method="POST">
      <div class="login-wrap">
        <?php 
          if(!empty($msg)){
            print '<p style="color: red;">'.$msg.'</p>';
          }
        ?>
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <!-- <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button> -->
      </div>
    </form>
    <!-- <div class="text-right">
      <div class="credits">
        
        </div>
    </div> -->
  </div>

</body>

<?php $this->load->view("shared/footer"); ?>
