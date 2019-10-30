<?php require APPROOT . '/views/inc/headerAdmin.php' ?>
<div class="row">
   <div class="col-md-4 mx-auto">
      <div class="card card-body bg-light mt-5">
         <h3>Create an account</h3>
         <p>Please fill out this form to register with us</p>
         <form action="<?php echo URLROOT; ?>/users/register" method="post">
            <div class="form-group">
               <label for="first_name">firstname <span class="red">*</span></label>
               <input type="text" name="firstname"
                       class="form-control <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : ''; ?>"
                       id="first_name" placeholder="First name"
                       value="<?php echo $data['firstname']; ?>">
                <span class="invalid-feedback"><?php echo $data['firstname_err']; ?></span>
            </div>
            <div class="form-group">
               <label for="lastname">lastname <span class="red">*</span></label>
               <input type="text" name="lastname"
                       class="form-control <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : ''; ?>"
                       id="lastname" placeholder="Last name"
                       value="<?php echo $data['lastname']; ?>">
                <span class="invalid-feedback"><?php echo $data['lastname_err']; ?></span>
            </div>
            <div class="form-group">
               <label for="email">Email <span class="red">*</span></label>
                <input type="text" name="email" class="form-control"
                       id="email <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" placeholder="Email"
                       value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
               <label for="password">Password <span class="red">*</span></label>
               <input type="password" name="password"
                       class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                       id="password" placeholder="Password"
                       value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="form-group">
               <label for="password2">Re-Password <span class="red">*</span></label>
               <input type="password" name="rePassword"
                       class="form-control <?php echo (!empty($data['rePassword_err'])) ? 'is-invalid' : ''; ?>"
                       id="password2" placeholder="Re-Password"
                       value="<?php echo $data['rePassword']; ?>">
                <span class="invalid-feedback"><?php echo $data['rePassword_err']; ?></span>
            </div>
            <div class="row">
               <div class="col">
                  <input type="submit" value="Register" class="btn btn-success"/>
               </div>
               <div class="col">
                  <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>


