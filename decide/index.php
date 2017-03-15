<?php
require_once('../util/main.php');
require('../model/database.php');
require('../model/restaurant_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_restaurants';
    }
}

// restaurants
switch($action) {
    case 'list_restaurants':
        // list all restaurants
        $restaurants = RestaurantDB::get_all_unvetoed_restaurants();
        $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
        $location_name = "";
        $locations = RestaurantDB::get_all_locations();
        include('restaurant_list.php');
        break;
    case 'filter_restaurants_by_location':
        // filter restaurants
        $location_name = filter_input(INPUT_POST, 'location');
        $locations = RestaurantDB::get_all_locations();
        if ($location_name == NULL || $location_name == FALSE) {
            $error_message = "Missing or incorrect location.";
            include('restaurant_list.php');
        } else if ($location_name == 'all') {
            $restaurants = RestaurantDB::get_all_unvetoed_restaurants();
            $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
            include('restaurant_list.php');
        } else { 
            $restaurants = RestaurantDB::get_restaurant_by_location($location_name);
            $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
            include('restaurant_list.php');
        }   
        break;
    case 'filter_restaurants_by_speed':
        // filter restaurants
        $speed = filter_input(INPUT_POST, 'speed');
        $location_name = filter_input(INPUT_POST, 'location');
//        $locations = RestaurantDB::get_all_locations();
        if ($speed == NULL || $speed == FALSE) {
            $error_message = "Missing or incorrect speed.";
            include('restaurant_list.php');
        } else if ($speed == 'all') {
            $restaurants = RestaurantDB::get_all_unvetoed_restaurants();
            $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
            $locations = RestaurantDB::get_all_locations();
            include('restaurant_list.php');
        } else { 
            $restaurants = RestaurantDB::get_restaurant_by_speed($speed);
            $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
            $locations = RestaurantDB::get_all_locations();
            include('restaurant_list.php');
        }   
        break;
//    case 'filter_restaurants':
//        $location_name = filter_input(INPUT_POST, 'location');
//        $speed = filter_input(INPUT_POST, 'speed');
//        $locations = RestaurantDB::get_all_locations();
//        if ($location_name == NULL || $location_name == FALSE) {
//            $error_message = "Missing or incorrect location.";
//            include('restaurant_list.php');
//        } else if ($speed == NULL || $speed == FALSE) {
//            $error_message = "Missing or incorrect speed.";
//            include('restaurant_list.php');
//        } else { 
//            $restaurants = RestaurantDB::get_restaurant_by_filter($location_name, $speed);
//            include('restaurant_list.php');
//        }  
//        break;
    case 'veto':
        $id = filter_input(INPUT_POST, 'id');
        RestaurantDB::set_veto($id);
        // this doesn't get the unvetoed restaurants when filtered by location (and probably speed too)
        // because location name is not being set (filter form not being submitted)
        // once this is fixed, need to apply to unveto action too
        $speed = filter_input(INPUT_GET, 'speed');
        $location_name = filter_input(INPUT_GET, 'location');
        $restaurants = RestaurantDB::get_restaurant_by_location($location_name);
        $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
        $locations = RestaurantDB::get_all_locations();
        include('restaurant_list.php');
        break;
    case 'unveto':
        $id = filter_input(INPUT_POST, 'id');
        RestaurantDB::undo_veto($id);
        $restaurants = RestaurantDB::get_all_unvetoed_restaurants();
        $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
        $locations = RestaurantDB::get_all_locations();
        $speed = filter_input(INPUT_POST, 'speed');
        $location_name = filter_input(INPUT_POST, 'location');
        include('restaurant_list.php');
        break;
    case 'reset':
        RestaurantDB::reset_all();
        $restaurants = RestaurantDB::get_all_unvetoed_restaurants();
        $vetoed_restaurants = RestaurantDB::get_all_vetoed_restaurants();
        $locations = RestaurantDB::get_all_locations();
        $location_name = "";
        include('restaurant_list.php');
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}
?>