<?php

    class Teacher extends User {

        private string $bio;
        private string $description;

        public function __construct(int $user_id = 0, string $first_name = '', string $last_name = '', string $email = '', string $password = '', string $role = '', string $image_url = '', string $register_date = '', string $status = '', string $bio = '', string $description = '') {
            parent::__construct($user_id, $first_name, $last_name, $email, $password, $role, $image_url, $register_date, $status);

            $this -> bio = $bio;
            $this -> description = $description;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setBio(string $bio) : void {
            $this -> bio = $bio;
        }

        public function setDescription(string $description) : void {
            $this -> $description = $description;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getBio() {
            return htmlspecialchars($this -> bio);
        }

        public function getDescription() {
            return htmlspecialchars($this -> description);
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function register() {

            // Validate Data

            !Security::validateName($this -> first_name) ? ($this -> errors[] = "First Name is too short") : '';
            !Security::validateName($this -> last_name) ? ($this -> errors[] = "First Name is too short") : '';
            !Security::validateName($this -> email) ? ($this -> errors[] = "Email Address is invalid") : '';
            !Security::validateName($this -> password) ? ($this -> errors[] = "Password must contain at least 8 characters") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // check if email already exists

            if ($this -> isEmailExists()) {
                $this -> errors[] = "This email already Exists";
                return false;
            }

            // If not, insert new row in users table

            $this -> role = 'role';
            $this -> status = 'status';

            $columns = [
                'first_name',
                'last_name',
                'email',
                'password',
                'role',
                'status'
            ];

            $data = [
                $this -> first_name,
                $this -> last_name,
                $this -> email,
                password_hash($this -> password, PASSWORD_BCRYPT),
                $this -> role,
                $this -> status
            ];

            $insert_id = $this -> db -> insert('users', $columns, $data);        // The id of inserted row, or False

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            // Create access token

            $this -> id = $insert_id;

            if (!Security::createAccessToken($this -> id)) {
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
        
            if ($result["role"] != "teacher") {
                $this -> errors[] = "This user is not a teacher";
                return false;
            }
            
            $this -> user_id = $result["user_id"];
            $this -> first_name = $result["first_name"];
            $this -> last_name = $result["last_name"];
            $this -> email = $result["email"];
            $this -> register_date = $result["register_date"];
            $this -> image_url = $result["image_url"];
            $this -> role = $result["role"];
            $this -> status = $result["status"];
            $this -> bio = $result["bio"];
            $this -> description = $result["description"];
        
            return true;
        }

        public function getMyCourses() {

        }
    }