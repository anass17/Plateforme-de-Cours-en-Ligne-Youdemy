<?php

    class Teacher extends User {

        private string $title;
        private string $bio;
        private array $courses = [];

        public function __construct(int $user_id = 0, string $first_name = '', string $last_name = '', string $email = '', string $password = '', string $role = '', string $image_url = '', string $register_date = '', string $status = '', string $title = '', string $bio = '') {
            parent::__construct($user_id, $first_name, $last_name, $email, $password, $role, $image_url, $register_date, $status);

            $this -> title = $title;
            $this -> bio = $bio;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setTitle(string $title) : void {
            $this -> $title = $title;
        }
        
        public function setBio(string $bio) : void {
            $this -> bio = $bio;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getTitle() {
            return htmlspecialchars($this -> title);
        }
        
        public function getBio() {
            return htmlspecialchars($this -> bio);
        }

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
            !Security::validateName($this -> title) ? ($this -> errors[] = "Title is too short") : '';
            !Security::validateName($this -> bio) ? ($this -> errors[] = "Bio is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // check if email already exists

            if ($this -> isEmailExists()) {
                $this -> errors[] = "This email already Exists";
                return false;
            }

            // If not, insert new row in users table

            $this -> role = 'teacher';
            $this -> status = 'pending';

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
                $this -> title,
                $this -> bio
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
            $this -> title = $result["title"];
            $this -> bio = $result["bio"];
        
            return true;
        }

        public function getMyCourses() {

            $db = Database::getInstance();

            if (empty($this -> courses)) {
                $courses_list = $db -> selectAll("SELECT * FROM courses WHERE course_owner = ?", [$this -> user_id]);
                $categories = Category::getAllCategories();

                foreach ($courses_list as $course) {
                    if ($course['type'] == "Video") {
                        $instance = new VideoCourse($course['course_id'], $course['title'], $course['description'], null, $this, $course['image_path'], $course['file_path'], $course['publish_date']);
                    } else {
                        $instance = new DocumentCourse($course['course_id'], $course['title'], $course['description'], null, $this, $course['image_path'], $course['file_path'], $course['publish_date']);
                    }

                    foreach($categories as $category) {
                        if ($course['course_category'] == $category -> getCategoryId()) {
                            $instance -> setCategory($category);
                        }
                    }

                    array_push($this -> courses, $instance);
                }
            }

            return $this -> courses;
        }
    }