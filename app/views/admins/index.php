<?php require APPROOT . '/views/inc/headerAdmin.php' ?>
<div class="container">
    <div class="col-12">
        <h1 class="text-center">Welcome <?php echo $data['first_name'] ?></h1>
        <h3 class="text-center"><a href="<?php echo URLROOT; ?>/admins/logout">Logout</a></h3>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <a href="<?php echo URLROOT; ?>/admins/adduser" class="btn btn-success mb-3"
                       id="addUserBtn">Add user</a>
                    <a href="<?php echo URLROOT; ?>/admins/addproduct" class="btn btn-info mb-3"
                       id="addUserBtn">Add product</a>
                       <a href="<?php echo URLROOT; ?>/admins/products" class="btn btn-info mb-3"
                       id="addUserBtn">Product</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php flash('user_message'); ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">User Id</th>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Registraion Date</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr>
                                <th class="userid" scope="row"><?php echo $user->userid ?></th>
                                <td class="firstname"><?php echo $user->first_name ?></td>
                                <td class="lastname"><?php echo $user->last_name ?></td>
                                <td><?php echo $user->regdat ?></td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/admins/edituser/<?php echo $user->userid ?>"
                                       class="btn btn-success edit">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="<?php echo URLROOT; ?>/admins/deleteuser/<?php echo $user->userid ?>">
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="overlay"></div>
    </div>
</div>

