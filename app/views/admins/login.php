<?php require APPROOT . '/views/inc/headerAdmin.php' ?>
<div class="row">
<div class="col-md-3 mx-auto">
   <div class="card card-body bg-light mt-5">
      <h3 class="text-center">Welcome Admin</h3>
      <form action="<?php echo URLROOT; ?>/admins/login" method="post" class="login-form">
         <div class="form-group">
            <label for="ename">Email <span class="red">*</span></label>
            <input type="email" name="email" class="form-control form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" 
             id="email" placeholder="Email"
             value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
         </div>
         <div class="form-group">
            <label for="password">Password <span class="red">*</span></label>
            <input type="password" name="pass" class="form-control form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>"
             id="password" placeholder="Password"
             value ="<?php echo $data['pass']; ?>">
            <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
         </div>
         <div class="row">
            <div class="col">
               <input type="submit" value="Login" class="btn btn-success btn-block"/>
            </div>
            <div class="col">
               <a href="<?php echo URLROOT; ?>/pages/index" class="btn btn-light btn-block">Back</a>
            </div>
         </div>
      </form>
   </div>
</div>
</div>