<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function index()
    {
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
                $userAuthenticated = $this->userModel->login($data['email'], $data['pass']);
                // 1 :admin
                // 2: user
                if ($userAuthenticated && $userAuthenticated->user_level == 2) {
                    $this->createUserSession($userAuthenticated);
                } else {
                    $data = [
                        'email' => $data['email'],
                        'pass' => '',
                        'email_err' => 'Email or Password are incorrect',
                        'pass_err' => 'Email or Password are incorrect',
                    ];
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'pass' => '',
                'email_err' => '',
                'pass_err' => ''
            ];
            return $this->view('users/login', $data);
        }
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_level']);
        session_destroy();
        redirect('users/login');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'password' => trim($_POST['password']),
                'rePassword' => trim($_POST['rePassword']),
                'email_err' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'password_err' => '',
                'rePassword_err' => ''
            ];
            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                if ($this->userModel->getUserByEmail($data['email'])) {
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
            if (empty($data['email_err']) && empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['password_err']) && empty($data['rePassword_err'])) {
                // Validated
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // insert user to database
                if ($this->userModel->addUser($data)) {
                    flash('user_message', 'Add user success');
                    redirect('users/login');
                } else {
                    die('Something wrong');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'email' => '',
                'firstname' => '',
                'lastname' => '',
                'password' => '',
                'rePassword' => '',
                'email_err' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'password_err' => '',
                'rePassword_err' => ''
            ];
            return $this->view('users/register', $data);
        }
    }
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->userid;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->first_name;
        $_SESSION['user_level'] = $user->user_level;
        redirect('');
    }
}