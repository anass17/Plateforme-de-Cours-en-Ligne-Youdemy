<?php

    class Student extends User {

        private $subscriptions = [];

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function register() {

            $db = Database::getInstance();

            // Validate Data

            !Security::validateName($this -> first_name) ? ($this -> errors[] = "First Name is too short") : '';
            !Security::validateName($this -> last_name) ? ($this -> errors[] = "First Name is too short") : '';
            !Security::validateEmail($this -> email) ? ($this -> errors[] = "Email Address is invalid") : '';
            !Security::validatePassword($this -> password) ? ($this -> errors[] = "Password must contain at least 8 characters") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // check if email already exists

            if ($this -> isEmailExists()) {
                $this -> errors[] = "This email already Exists";
                return false;
            }

            // If not, insert new row in users table

            $this -> role = 'student';
            $this -> status = 'active';

            $columns = [
                'first_name',
                'last_name',
                'email',
                'password',
                'role',
                'status',
                'title',
                'bio'
            ];

            $data = [
                $this -> first_name,
                $this -> last_name,
                $this -> email,
                password_hash($this -> password, PASSWORD_BCRYPT),
                $this -> role,
                $this -> status,
                '',
                ''
            ];

            $insert_id = $db -> insert('users', $columns, $data);        // The id of inserted row, or False

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            // Create access token

            $this -> user_id = $insert_id;

            if (!Security::createAccessToken($this -> user_id)) {
                return false;
            }

            return true;
        }

        public function loadUser(int $user_id) : bool {
            $db = Database::getInstance();

            $result = $db -> select('SELECT * FROM users WHERE user_id = ?', [$user_id]);

            if (!$result) {
                $this -> errors[] = "This user does not exist";
                return false;
            }

            if ($result["role"] != "student") {
                $this -> errors[] = "This user is not a user";
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

        public function subscribeToCourse(int|string $course_id): bool {
            $db = Database::getInstance();

            $columns = [
                'user_id',
                'course_id'
            ];

            $paramaters = [
                $this -> user_id,
                $course_id
            ];

            if ($db -> insert('enrollement', $columns, $paramaters) === false) {
                $this -> errors[] = "Could not enroll you in this course";
                return false;
            }

            return true;
        }

        public function loadMySubscriptions() {
            $db = Database::getInstance();

            $results = $db -> selectAll('SELECT * FROM enrollements WHERE user_id = ?', [$this -> user_id]);

        }
    }

?>