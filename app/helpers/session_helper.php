<?php
session_start();
function flash($name = '', $message = '', $class = 'alert alert-success alert-dismissible fade show') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION['name'])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name. '_class'])) {
                unset($_SESSION[$name. '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        } elseif (empty($mesage) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash" role="alert">' . $_SESSION[$name] . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>';
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}
function adminIsLoggedIn() {
    if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name']) && isset($_SESSION['admin_email']) && isset($_SESSION['admin_level'])) {
        return true;
    } else {
        return false;
    }
}
function isLoggedIn()
{
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
        return true;
    } else {
        return false;
    }
}