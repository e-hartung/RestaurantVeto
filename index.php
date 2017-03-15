<?php
require_once('util/main.php');
require('model/database.php');
require('model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        if (isset($_SESSION['user'])) {
            $action = 'returning_user';
        } else {
            $action = 'view_login';
        }
    }
}

switch($action) {
    case 'view_login':
        // Clear login data
        $username = '';
        $password = '';
        include('home_view.php');
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (!empty($username) && !empty($password) && UserDB::is_valid_user_login($username, $password)) {
            $_SESSION['user'] = UserDB::get_user_by_username($username);
            $username = $_SESSION['user']['username'];
            include('account/user_menu.php');
        } else {
            $error_message = 'Login failed. Missing or invalid username/password.';
            $password = '';
            include('home_view.php');
        }
        break;
    case 'returning_user':
        $username = $_SESSION['user']['username'];
        $password = $_SESSION['user']['password'];
        if (!empty($username) && !empty($password) && UserDB::is_valid_user_login($username, $password)) {
            $_SESSION['user'] = UserDB::get_user_by_username($username);
            $username = $_SESSION['user']['username'];
            include('account/user_menu.php');
        } else {
            $error_message = 'Login failed. Missing or invalid username/password.';
            $password = '';
            include('home_view.php');
        }
        break;
    case 'show_register_form':
        $username = '';
        $password = '';
        include('register.php');
        break;
    case 'create_user':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $id = UserDB::get_user_by_username($username);
        if ($username == NULL || $username == FALSE ||
            $password == NULL || $password == FALSE) {
            $error_message = "Invalid. Check all fields and try again.";
            include('register.php');
        } else if ($id == TRUE) { 
            $error_message = "A user with that name already exists.";
            include('register.php');
        } else {
            UserDB::add_user($username, $password);
            $_SESSION['user'] = UserDB::get_user_by_username($username);
            include('account/user_menu.php');
        }
        break;
    case 'logout':
        // End session
        $_SESSION = array();
        session_destroy();
        
        // Delete cookie from browser
        $name = session_name();
        $expire = strtotime('-1 year');
        $params = session_get_cookie_params();
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        
        // Reset username and password and return to main menu
        $username = '';
        $password = '';
        header("Location: ". $app_path);
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}