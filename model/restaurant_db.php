<?php
class RestaurantDB {
    public static function get_all_restaurants() {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants
                  ORDER BY id_num';
        $statement = $db->prepare($query);
        $statement->execute();
        $restaurants = $statement->fetchAll();
        return $restaurants;
    }
    
    public static function get_all_unvetoed_restaurants() {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants WHERE veto IS NULL
                  ORDER BY id_num';
        $statement = $db->prepare($query);
        $statement->execute();
        $restaurants = $statement->fetchAll();
        return $restaurants;
    }
    
    public static function get_all_vetoed_restaurants() {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants WHERE veto IS NOT NULL
                  ORDER BY id_num';
        $statement = $db->prepare($query);
        $statement->execute();
        $restaurants = $statement->fetchAll();
        return $restaurants;
    }
    
    public static function get_all_categories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  ORDER BY category';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        return $categories;
    }
    
    public static function get_all_locations() {
        $db = Database::getDB();
        $query = 'SELECT * FROM locations
                  ORDER BY loc_id';
        $statement = $db->prepare($query);
        $statement->execute();
        $locations = $statement->fetchAll();
        return $locations;
    }

    public static function get_restaurant($id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants
                  WHERE id_num = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $restaurant = $statement->fetch();
        $statement->closeCursor();
        return $restaurant;
    }

    public static function get_restaurant_by_location($location) {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants WHERE location = :location';
        $statement = $db->prepare($query);
        $statement->bindValue(':location', $location);
        $statement->execute();
        $restaurant = $statement->fetchAll();
        return $restaurant;
    }
    
    public static function get_restaurant_by_speed($speed) {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants WHERE speed = :speed';
        $statement = $db->prepare($query);
        $statement->bindValue(':speed', $speed);
        $statement->execute();
        $restaurant = $statement->fetchAll();
        return $restaurant;
    }
    
    public static function set_veto($id) {
        $db = Database::getDB();
        $query = 'UPDATE restaurants SET veto = "Y" WHERE id_num = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function undo_veto($id) {
        $db = Database::getDB();
        $query = 'UPDATE restaurants SET veto = NULL WHERE id_num = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function reset_all() {
        $db = Database::getDB();
        $query = 'UPDATE restaurants SET veto = NULL';
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function search_restaurants($name) {
        $db = Database::getDB();
        $query = 'SELECT * FROM restaurants
                  WHERE restaurant_name LIKE :name';
        $statement = $db->prepare($query);
        $statement->bindValue(":name", '%'.$name.'%');
        $statement->execute();
        $restaurants = $statement->fetchAll();
        return $restaurants;
    }
    
    public static function add_restaurant($id, $name, $category, $speed, $to_go, $delivery, $location) {
        $db = Database::getDB();
        $query = 'INSERT INTO restaurants 
                    (id_num, restaurant_name, category, speed, to_go, delivery, location)
                  VALUES 
                    (:id, :name, :category, :speed, :to_go, :delivery, :location)';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':speed', $speed);
        $statement->bindValue(':to_go', $to_go);
        $statement->bindValue(':delivery', $delivery);
        $statement->bindValue(':location', $location);
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function update_restaurant($id, $name, $category, $speed, $to_go, $delivery, $location) {
        $db = Database::getDB();
        $query = 'UPDATE restaurants 
                  SET restaurant_name = :name, category = :category, 
                      speed = :speed, to_go = :to_go, 
                      delivery = :delivery, location = :location
                  WHERE id_num = :id'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':speed', $speed);
        $statement->bindValue(':to_go', $to_go);
        $statement->bindValue(':delivery', $delivery);
        $statement->bindValue(':location', $location);
        $statement->execute();
        $statement->closeCursor();
    }
}

//function update_customer($id, $fname, $lname, $address, $city, $state, $zip, $country, $phone, $email, $password) {
//    global $db;
//    $query = 'UPDATE customers
//              SET firstName = :fname, lastName = :lname,
//                  address = :address, city = :city, state = :state, postalCode = :zip, countryCode = :country,
//                  phone = :phone, email = :email, password = :password
//              WHERE customerID = :id';
//    $statement = $db->prepare($query);
//    $statement->bindValue(':id', $id);
//    $statement->bindValue(':fname', $fname);
//    $statement->bindValue(':lname', $lname);
//    $statement->bindValue(':address', $address);
//    $statement->bindValue(':city', $city);
//    $statement->bindValue(':state', $state);
//    $statement->bindValue(':zip', $zip);
//    $statement->bindValue(':country', $country);
//    $statement->bindValue(':phone', $phone);
//    $statement->bindValue(':email', $email);
//    $statement->bindValue(':password', $password);
//    $statement->execute();
//    $statement->closeCursor();
//}
//
//function is_valid_customer_login($email) {
//    global $db;
//    $query = '
//        SELECT * FROM customers
//        WHERE email = :email';
//    $statement = $db->prepare($query);
//    $statement->bindValue(':email', $email);
//    $statement->execute();
//    $valid = ($statement->rowCount() == 1);
//    $statement->closeCursor();
//    return $valid;
//}
?>