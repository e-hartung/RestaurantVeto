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
        $restaurants = RestaurantDB::get_all_restaurants();
        $location_name = "";
        $locations = RestaurantDB::get_all_locations();
        include('restaurant_list.php');
        break;
    case 'search_restaurants':
        $search_query = filter_input(INPUT_POST, 'restaurant_name');
        if ($search_query == NULL || $search_query == FALSE) {
            display_error("Missing or incorrect query.");
        } else { 
            $restaurants = RestaurantDB::search_restaurants($search_query);
            include('restaurant_list.php');
        }   
        break;
    case 'show_add_edit_form':
        // call page to add or edit restaurant information
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $restaurant = RestaurantDB::get_restaurant($id);
        $categories = RestaurantDB::get_all_categories();
        $locations = RestaurantDB::get_all_locations();
        $name = $restaurant['restaurant_name'];
        $category = $restaurant['category'];
        $speed = $restaurant['speed'];
        $to_go = $restaurant['to_go'];
        $delivery = $restaurant['delivery'];
        $location_name = $restaurant['location'];
        include('restaurant_add_edit.php');
        break;
    case 'add_restaurant':
        // create new restaurant
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $restaurant = RestaurantDB::get_restaurant($id);
        $categories = RestaurantDB::get_all_categories();
        $locations = RestaurantDB::get_all_locations();
        $name = trim(filter_input(INPUT_POST, 'restaurant_name'));
        $category = filter_input(INPUT_POST, 'category');
        $speed = filter_input(INPUT_POST, 'speed');
        $to_go = filter_input(INPUT_POST, 'to_go');
        $delivery = filter_input(INPUT_POST, 'delivery');
        $location_name = filter_input(INPUT_POST, 'location');
        
        if ($name == NULL || $name == FALSE) {
            display_error("Missing or incorrect restaurant name.");
        } else { 
            RestaurantDB::add_restaurant($id, $name, $category, $speed, $to_go, $delivery, $location_name);
            header("Location: .");
        }
        break;  
    case 'update_restaurant':
        // update restaurant information
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $restaurant = RestaurantDB::get_restaurant($id);
        $categories = RestaurantDB::get_all_categories();
        $locations = RestaurantDB::get_all_locations();
        $name = trim(filter_input(INPUT_POST, 'restaurant_name'));
        $category = filter_input(INPUT_POST, 'category');
        $speed = filter_input(INPUT_POST, 'speed');
        $to_go = filter_input(INPUT_POST, 'to_go');
        $delivery = filter_input(INPUT_POST, 'delivery');
        $location_name = filter_input(INPUT_POST, 'location');
        
        if ($name == NULL || $name == FALSE) {
            display_error("Missing or incorrect restaurant name.");
        } else { 
            RestaurantDB::update_restaurant($id, $name, $category, $speed, $to_go, $delivery, $location_name);
            header("Location: .");
        }
        break; 
    default:
        display_error("Unknown action: " . $action);
        break;
}
?>