<?php require APPROOT . '/views/inc/headerAdmin.php' ?>
    <div class="container bg-light p-5" id="addUserBox">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class="text-center">Add User</h1>
                <form action="<?php echo URLROOT; ?>/admins/addUser" method="post" class="d-flex justify-content-center flex-column">
                    <div class="form-group row">
                        <label for="addEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email"
                                   class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                                   id="addEmail"
                                   placeholder="Email"
                                   value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="addFirstname" class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10">
                            <input type="text" name="firstname"
                                   class="form-control <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : ''; ?>"
                                   id="addFirstname"
                                   placeholder="First name"
                                   value="<?php echo $data['firstname']; ?>">
                            <span class="invalid-feedback"><?php echo $data['firstname_err']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="addLastname" class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10">
                            <input type="text" name="lastname"
                                   class="form-control <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : ''; ?>"
                                   id="addLastname"
                                   placeholder="Last name"
                                   value="<?php echo $data['lastname']; ?>">
                            <span class="invalid-feedback"><?php echo $data['lastname_err']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password1" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password"
                                   class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                                   id="password1"
                                   placeholder="Password"
                                   value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="addPassword2" class="col-sm-2 col-form-label">Re-Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="rePassword"
                                   class="form-control <?php echo (!empty($data['rePassword_err'])) ? 'is-invalid' : ''; ?>"
                                   id="addPassword2"
                                   placeholder="Re-Password"
                                   value="<?php echo $data['rePassword']; ?>">
                            <span class="invalid-feedback"><?php echo $data['rePassword_err']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="privilege" class="col-sm-2 col-form-label">Privilege</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="privilege" name="privilege" value="<?php echo $data['privilege']; ?>">
                                <option value="2">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <span class="invalid-feedback"><?php echo $data['privilege_err']; ?></span>
                    </div>
                    <input type="submit" value="Add" class="btn btn-success mr-2">
                    <a href="<?php echo URLROOT; ?>/admins" class="btn" id="cancelAdd">Cancel</a>
                </form>
            </div>
        </div>
    </div>
