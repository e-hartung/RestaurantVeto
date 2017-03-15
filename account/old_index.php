<?php
require_once('../util/main.php');
require('../model/database.php');
require('../model/user_db.php');

require_once('model/fields.php');
require_once('model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user'])) {
            $action = 'returning_user';
        }
    }
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Registration page and other pages
$fields->addField('username', 'Must be valid username.');
$fields->addField('password_1');
$fields->addField('password_2');

// for the Login page
$fields->addField('password');

switch($action) {
    case 'view_login':
        // Clear login data
        $username = '';
        
        include 'customer_login.php';
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        if (!empty($username) && is_valid_customer_login($username)) {
            $_SESSION['user'] = get_customer_by_email($username);
//            $customer_name = $_SESSION['user']['firstName'] . ' ' .
//                             $_SESSION['user']['lastName'];
//            $products = get_all_products();
//            include 'product_register.php';
            include 'navigation.php';
        } else {
            $error_message = 'Login failed. Missing or invalid username.';
            include 'customer_login.php';
        }
        break;
    case 'returning_user':
        $username = $_SESSION['user']['username'];
        if (!empty($email) && is_valid_customer_login($username)) {
            $_SESSION['user'] = get_customer_by_email($username);
            $customer_name = $_SESSION['user']['firstName'] . ' ' .
                             $_SESSION['user']['lastName'];
            $products = get_all_products();
            include 'product_register.php';
        } else {
            $error_message = 'Login failed. Missing or invalid username.';
            include 'customer_login.php';
        }
        break;
    case 'register_product':
        $customer = $_SESSION['user']['customerID'];
        $code = filter_input(INPUT_POST, 'code');
        $date = date('Y-m-d');
        add_registration($customer, $code, $date);
        include 'registration_confirmation.php';
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
        
        // Return to login page
        $email = '';
        include 'customer_login.php';
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}

?>