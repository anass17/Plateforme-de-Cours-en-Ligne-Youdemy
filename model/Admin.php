<?php

    class Admin extends User {

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function approveTeacher(int $user_id) : bool {
            $db = Database::getInstance();

            if ($db -> update('users', ['status'], 'user_id = ?', ['active', $user_id])) {
                $this -> errors[] = "Could not approve this teacher";
                return false;
            }

            return true;
        }

        public function activateUser(int $user_id) : bool {
            $db = Database::getInstance();

            if ($db -> update('users', ['status'], 'user_id = ?', ['active', $user_id])) {
                $this -> errors[] = "Could not activate this user's account";
                return false;
            }

            return true;
        }

        public function banUser(int $user_id) : bool {
            $db = Database::getInstance();

            if ($db -> update('users', ['status'], 'user_id = ?', ['banned', $user_id])) {
                $this -> errors[] = "Could not ban this user's account";
                return false;
            }

            return true;
        }

        public function deleteUser(int $user_id): bool {
            $db = Database::getInstance();

            if ($db -> update('users', ['status'], 'user_id = ?', ['deleted', $user_id])) {
                $this -> errors[] = "Could not delete this user's account";
                return false;
            }

            return true;
        }

        public function loadUser(int $user_id) : bool {
            $db = Database::getInstance();
        
            $result = $db -> select('SELECT * FROM users WHERE user_id = ?', [$this -> $user_id]);
        
            if (!$result) {
                $this -> errors[] = "This user does not exist";
                return false;
            }
        
            if ($result["role"] != "admin") {
                $this -> errors[] = "This user is not a admin";
            }
            
            $this -> user_id = $result["user_id"];
            $this -> first_name = $result["first_name"];
            $this -> last_name = $result["last_name"];
            $this -> email = $result["email"];
            $this -> register_date = $result["register_date"];
            $this -> image_url = $result["image_url"];
            $this -> role = $result["role"];
            $this -> status = $result["status"];
        
            return true;
        }
    }