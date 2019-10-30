<?php
class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
    }
    public function index()
    {
        $users = $this->adminModel->getUsers();
        $data = [
            'first_name' => $_SESSION['admin_name'],
            'users' => $users
        ];
        if (!adminIsLoggedIn()) {
            redirect('admins/login');
        }
        return $this->view('admins/index', $data);
    }
        public function products()
            {
            if (!adminIsLoggedIn()) {
                    redirect('admins/login');
                }
                $products = $this->adminModel->getProducts();
                $data = [
                   
                    'products' => $products
                ];
                
                return $this->view('admins/products', $data);
            }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize Post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Process form
            $data = [
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),
                'email_err' => '',
                'pass_err' => ''
            ];
            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            }
            // Validate password
            if (empty($data['pass'])) {
                $data['pass_err'] = 'Please enter your password';
            }
            if (empty($data['email_err']) && empty($data['pass_err'])) {
                // Validated
                // Check and set logged in user
                $adminAuthenticated = $this->adminModel->login($data['email'], $data['pass']);
                // 1 :admin
                // 2: user
                if ($adminAuthenticated && $adminAuthenticated->user_level == 1) {
                    $this->createAdminSession($adminAuthenticated);
                } else {
                    $data = [
                        'email' => $data['email'],
                        'pass' => '',
                        'email_err' => 'Email or Password are incorrect',
                        'pass_err' => 'Email or Password are incorrect',
                    ];
                    $this->view('admins/login', $data);
                }
            } else {
                $this->view('admins/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'pass' => '',
                'email_err' => '',
                'pass_err' => ''
            ];
            return $this->view('admins/login', $data);
        }
    }
    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_level']);
        session_destroy();
        redirect('admins/login');
    }
    public function createAdminSession($admin)
    {
        $_SESSION['admin_id'] = $admin->userid;
        $_SESSION['admin_email'] = $admin->email;
        $_SESSION['admin_name'] = $admin->first_name;
        $_SESSION['admin_level'] = $admin->user_level;
        redirect('admins');
    }
    public function adduser()
    {
        if (!adminIsLoggedIn()) {
            redirect('admins/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'password' => trim($_POST['password']),
                'rePassword' => trim($_POST['rePassword']),
                'privilege' => trim($_POST['privilege']),
                'email_err' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'password_err' => '',
                'rePassword_err' => '',
                'privilege_err' => '',
            ];
            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                if ($this->adminModel->getUserByEmail($data['email'])) {
                    $data['email_err'] = 'This email already exists in the database.';
                }
            }
            // Validate first name
            if (empty($data['firstname'])) {
                $data['firstname_err'] = 'Please enter first name';
            }
            // Validate Last name
            if (empty($data['lastname'])) {
                $data['lastname_err'] = 'Please enter last name';
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter the password';
            } else if (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            // Validate Confirm Password
            if (empty($data['rePassword'])) {
                $data['rePassword_err'] = 'Please enter re-password';
            } else if ($data['password'] !== $data['rePassword']) {
                $data['rePassword_err'] = 'Password does not match';
            }
            // Validate privilege
            $data['privilege'] = (int)$data['privilege'];
            if (empty($data['privilege']) && is_numeric($data['privilege'])) {
                $data['privilege_err'] = 'Please enter privilege';
            }
            if (empty($data['email_err']) && empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['password_err']) && empty($data['rePassword_err']) && empty($data['privilege_err'])) {
                // Validated
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // insert user to database
                if ($this->adminModel->addUser($data)) {
                    flash('user_message', 'Add user success');
                    redirect('admins');
                } else {
                    die('Something wrong');
                }
            } else {
                $this->view('admins/adduser', $data);
            }
        } else {
            $data = [
                'email' => '',
                'firstname' => '',
                'lastname' => '',
                'password' => '',
                'rePassword' => '',
                'privilege' => '',
                'email_err' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'password_err' => '',
                'rePassword_err' => '',
                'privilege_err' => '',
            ];
            return $this->view('admins/addUser', $data);
        }
    }
    public function edituser($idUser)
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'userId' => $idUser,
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'password' => trim($_POST['password']),
                'rePassword' => trim($_POST['rePassword']),
                'privilege' => trim($_POST['privilege']),
                'email_err' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'password_err' => '',
                'rePassword_err' => '',
                'privilege_err' => '',
            ];
            // Validate first name
            if (empty($data['firstname'])) {
                $data['firstname_err'] = 'Please enter first name';
            }
            // Validate Last name
            if (empty($data['lastname'])) {
                $data['lastname_err'] = 'Please enter last name';
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter the password';
            } else if (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            // Validate Confirm Password
            if (empty($data['rePassword'])) {
                $data['rePassword_err'] = 'Please enter re-password';
            } else if ($data['password'] !== $data['rePassword']) {
                $data['rePassword_err'] = 'Password does not match';
            }
            // Validate privilege
            $data['privilege'] = (int)$data['privilege'];
            if (empty($data['privilege']) && is_numeric($data['privilege'])) {
                $data['privilege_err'] = 'Please enter privilege';
            }
            if (empty($data['email_err']) && empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['password_err']) && empty($data['rePassword_err']) && empty($data['privilege_err'])) {
                // Validated
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // insert user to database
                if ($this->adminModel->editUser($data)) {
                    flash('user_message', 'Add user success');
                    redirect('admins');
                } else {
                    die('Something wrong');
                }
            } else {
                $this->view('admins/edituser', $data);
            }
        } else {
            $user = $this->adminModel->getUserById($idUser);
            $data = [
                'firstname' => $user->first_name,
                'lastname' => $user->last_name,
                'password' => '',
                'rePassword' => '',
                'privilege' => $user->user_level,
                'email_err' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'password_err' => '',
                'rePassword_err' => '',
                'privilege_err' => '',
            ];
            return $this->view('admins/edituser', $data);
        }
    }
    public function deleteuser($idUser)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModel->deleteUser($idUser)) {
                flash('user_message', 'User deleted');
                redirect('admins');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('admins');
        }
    }
    public function editproduct($idProduct)
    {
        if (!adminIsLoggedIn()) {
            redirect('admins/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'productId' => $idProduct,
                'productName' => trim($_POST['productName']),
                'productImage' => trim($_FILES['productImage']['name']),
                'price' => trim($_POST['productPrice']),
                'productName_err' => '',
                'newImage_err' => '',
                'price_err' => '',
                'currentController' => 'products'
            ];
            // Validate first name
            if (empty($data['productName'])) {
                $data['productName_err'] = 'Please enter product name';
            }
            // Validate Last name
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            } else {
                $data['price'] = str_replace(",", "", $data['price']);
            }
            // Validate image
            if (empty($data['productImage'])) {
                $data['productImage'] = $_POST['oldImage'];
            } else {
                // Validate image upload\
                $target_dir = "img/products/";
                $target_file = $target_dir . basename($_FILES['productImage']['name']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $newName = $data['productName'] . '_' . time() . '.' . $imageFileType; //create new name for image
                $newName = htmlspecialchars($newName);
                $newName = str_replace(" ", "-", $newName);
                $newName = str_replace("/", "-", $newName);
                $data['productImage'] = $target_dir . $newName; //create new target_dir for image
                $typeAccept = ["png", "jpg", "jpeg"];
                $check = getimagesize($_FILES['productImage']['tmp_name']);
                if (!$check) {
                    $data['image_err'] = "File is not an image.";
                }
                if ($_FILES['productImage']['size'] > 10000000) { // 100Mb
                    $data['image_err'] = "Sorry, your file is too large.";
                }
                if (!in_array($imageFileType, $typeAccept)) {
                    $data['image_err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
                // End Validate image upload
            }
//            $product = $this->adminModel->getProductById($data['productId']);
//
//            echo '/' . $product->productimage;
//            if (file_exists($product->productimage)) {
//                unlink($product->productimage);
//
//            }
            if (empty($data['productName_err']) && empty($data['price_err']) && empty($data['image_err'])) {
                // Validated
                // insert product to database
                if (!empty($_FILES['productImage']['name'])) {
                    $product = $this->adminModel->getProductById($data['productId']);
                    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $data['productImage'])) {
                        if ($this->adminModel->editProduct($data)) {
                            if (file_exists($product->productimage)) {
                                unlink($product->productimage);
                            }
                            flash('user_message', 'Edit product success');
                            redirect('admins/products');
                        } else {
                            die('Something wrong');
                        }
                    } else {
                        die('File can not upload');
                    }
                } else {
                    if ($this->adminModel->editProduct($data)) {
                        flash('user_message', 'Edit product success');
                        redirect('admins/products');
                    } else {
                        die('Something wrong');
                    }
                }
            } else {
                $this->view('admins/editProduct', $data);
            }
        } else {
            $product = $this->adminModel->getProductById($idProduct);
            $data = [
                'productId' => $idProduct,
                'productName' => $product->productname,
                'img' => $product->productimage,
                'newImage' => '',
                'price' => $product->price,
                'productName_err' => '',
                'newImage_err' => '',
                'price_err' => '',
                'currentController' => 'products'
            ];
            return $this->view('admins/editProduct', $data);
        }
    }
    public function deleteproduct($idProduct)
    {
        if (!adminIsLoggedIn()) {
            redirect('admins/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModel->deleteProduct($idProduct)) {
                flash('user_message', 'Product deleted');
                redirect('admins/products');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('admins/products');
        }
    }
   
    public function addproduct()
    {
        if (!adminIsLoggedIn()) {
            redirect('admins/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'productName' => trim($_POST['productName']),
                'price' => trim($_POST['productPrice']),
                'image' => trim($_FILES['productImage']['name']),
                'productName_err' => '',
                'price_err' => '',
                'image_err' => ''
            ];
            // Validate product name
            if (empty($data['productName'])) {
                $data['productName_err'] = 'Please enter product name';
            }
            // Validate price
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            } else {
                $data['price'] = str_replace(",", "", $data['price']);
            }
            // Validate image upload\
            $target_dir = "img/products/";
            $target_file = $target_dir . basename($_FILES['productImage']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newName = $data['productName'] . '.' . $imageFileType; //create new name for image
            $newName = htmlspecialchars($newName);
            $newName = str_replace(" ", "-", $newName);
            $newName = str_replace("/", "-", $newName);
            $newTarget_dir = $target_dir . $newName; //create new target_dir for image
            $data['image'] = "img/products/" . $newName;
            if (file_exists($target_dir . $newName)) {
                $data['image_err'] = "Sorry, file already exists.";
            }
            $typeAccept = ["png", "jpg", "jpeg"];
            $check = getimagesize($_FILES['productImage']['tmp_name']);
            if (!$check) {
                $data['image_err'] = "File is not an image.";
            }
            if ($_FILES['productImage']['size'] > 10000000) { // 100Mb
                $data['image_err'] = "Sorry, your file is too large.";
            }
            if (!in_array($imageFileType, $typeAccept)) {
                $data['image_err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
//             End Validate image upload
            if (empty($data['productName_err']) && empty($data['price_err']) && empty($data['image_err'])) {
                // validated
                // insert product to database
                if (move_uploaded_file($_FILES['productImage']['tmp_name'], $newTarget_dir)) {
                    if ($this->adminModel->addProduct($data)) {
                        flash('user_message', 'Add product success');
                        redirect('admins');
                    } else {
                        die('Something wrong');
                    }
                } else {
                    die('File cann not  upload');
                }
            } else {
                $this->view('admins/addProduct', $data);
            }
//            $this->view('admins/addProduct', $data);
        } else {
            $data = [
                'productName' => '',
                'image' => '',
                'price' => '',
                'productName_err' => '',
                'image_err' => '',
                'price_err' => ''
            ];
            return $this->view('admins/addProduct', $data);
        }
    }
}