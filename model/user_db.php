<?php
class UserDB {
    public static function get_user($id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM users
                  WHERE userID = :id';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            return $user;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        } 
    }

    public static function get_user_by_username($username) {
        $db = Database::getDB();
        $query = 'SELECT * FROM users WHERE username = :username';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            return $user;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function add_user($username, $password) {
        $db = Database::getDB();
        $query = 'INSERT INTO users
                    (username, password)
                  VALUES
                    (:username, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function is_valid_user_login($username, $password) {
        $db = Database::getDB();
        $query = '
            SELECT * FROM users
            WHERE username = :username AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    }
}
?>