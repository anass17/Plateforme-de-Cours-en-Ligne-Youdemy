<?php


    abstract class User {
        protected int $user_id;
        protected string $first_name;
        protected string $last_name;
        protected string $email;
        protected string $password;
        protected string $role;
        protected string $image_url;
        protected string $register_date;
        protected string $status;
        protected array $errors = [];


        public function __construct(int $user_id = 0, string $first_name = '', string $last_name = '', string $email = '', string $password = '', string $role = '', string $image_url = '', string $register_date = '', string $status = '') {
            $this -> user_id = $user_id;
            $this -> first_name = $first_name;
            $this -> last_name = $last_name;
            $this -> email = $email;
            $this -> password = $password;
            $this -> role = $role;
            $this -> image_url = $image_url;
            $this -> register_date = $register_date;
            $this -> status = $status;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setFirstName(string $first_name) : void {
            $this -> first_name = $first_name;
        }

        public function setLastName(string $last_name) : void {
            $this -> last_name = $last_name;
        }

        public function setEmail(string $email) : void {
            $this -> email = $email;
        }

        public function setPassword(string $password) : void {
            $this -> password = $password;
        }

        public function setStatus(string $status) : void {
            $this -> status = $status;
        }

        public function setImageUrl(string $image_url) : void {
            $this -> image_url = $image_url;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getUserId() {
            return $this -> user_id;
        }

        public function getFirstName() {
            return htmlspecialchars($this -> first_name);
        }

        public function getLastName() {
            return htmlspecialchars($this -> last_name);
        }

        public function getEmail() {
            return htmlspecialchars($this -> email);
        }

        public function getPassword() {
            return $this -> password;
        }

        public function getRegisterDate() {
            return htmlspecialchars($this -> register_date);
        }

        public function getStatus() {
            return htmlspecialchars($this -> status);
        }

        public function getRole() {
            return $this -> role;
        }

        public function getImageUrl() {
            if ($this -> image_url == "") {
                return "/assets/imgs/users/default.webp";
            }

            return $this -> image_url;
        }

        public function getErrors() {
            return $this -> errors;
        }

        // ------------------------------------
        // Static Methods
        // ------------------------------------


        public static function logout() : void {   

            Security::deleteAccessToken();

            session_destroy();
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function login() : bool {

            $db = Database::getInstance();

            if (!empty($this -> error)) {
                return false;
            }

            if (
                empty($this -> email) ||
                empty($this -> password)
            ) {
                $this -> errors[] = "Please fill in the form";
                return false;
            }

            // Check if the email exists

            $parameters = [
                $this -> email
            ];

            $result = $db -> select("SELECT * from users WHERE email = ?", $parameters);

            if (!$result) {
                $this -> errors[] = "Incorrect email address or password";
                return false;
            }

            // Verify Password

            if (!password_verify($this -> password, $result['password'])) {
                $this -> errors[] = "Incorrect email address or password";
                return false;
            }

            // Create access token

            $this -> user_id = $result['user_id'];

            if (!Security::createAccessToken($this -> user_id)) {
                return false;
            }

            return true;
        }

        public function searchTeachers(int $user_id): bool {
            return true;
        }

        public function isEmailExists() : bool|int {

            $db = Database::getInstance();

            $result = $db -> select("SELECT * from users WHERE email = ?", [$this -> email]);

            // If email exists, return user ID

            if ($result) {
                return $result[0]['user_id'];
            }

            return false;
        }

        // ------------------------------------
        // Abstract Methods
        // ------------------------------------

        public abstract function loadUser(int $user_id) : bool;

    }
