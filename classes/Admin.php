<?php

    class Admin extends User {

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function activateUser(int $user_id) : bool {
            $db = Database::getInstance();

            if (!$db -> update('users', ['status'], 'user_id = ?', ['active', $user_id])) {
                $this -> errors[] = "Could not activate this user's account";
                return false;
            }

            return true;
        }

        public function banUser(int $user_id) : bool {
            $db = Database::getInstance();

            if (!$db -> update('users', ['status'], 'user_id = ?', ['banned', $user_id])) {
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

        // ------------------------------------
        // Static Methods
        // ------------------------------------

        public static function getGlobalStatistics() {
            $db = Database::getInstance();

            $SQL = 
            "SELECT count(*) as courses_count,
            (select count(*) from users where role = 'student') as students_count,
            (select count(*) from users where role = 'teacher') as teachers_count,
            (select count(*) from categories) as categories_count,
            (select count(*) from tags) as tags_count,
            (select count(*) from enrollement) as enrollement_count,
            (SELECT 0) as reviews_count
            from courses;
            ";

            return $db -> select($SQL);  
        }

        public static function getTopCourses() {
            $db = Database::getInstance();

            $SQL = 
            "SELECT C.*, U.user_id, first_name, last_name, if (en_count is null, 0, en_count) as en_count, Cat.*
            from courses C 
            left join (select course_id, count(*) as en_count from enrollement group by course_id) EN on EN.course_id = C.course_id 
            join users U on U.user_id = C.course_owner
            join categories Cat on Cat.cat_id = C.course_category
            order by en_count desc, course_id asc limit 3
            ";

            $result = $db -> selectAll($SQL);
            $courses = [];

            foreach($result as $row) {
                $teacher = new Teacher($row['user_id'], $row['first_name'], $row['last_name']);
                $category = new Category($row['cat_id'], $row['cat_name']);

                if ($row['type'] == "Video") {
                    $course = new VideoCourse($row['course_id'], $row['title'], $row['description'], $category, $teacher, $row['image_path'], $row['file_path'], $row['publish_date'], $row['en_count']);
                } else {
                    $course = new DocumentCourse($row['course_id'], $row['title'], $row['description'], $category, $teacher, $row['image_path'], $row['file_path'], $row['publish_date'], $row['en_count']);
                }
                $courses[] = $course;
            }

            return $courses;
        }

        public static function getTopTeachers() {
            $db = Database::getInstance();

            $SQL = 
            "SELECT U.*, if(courses_count is null, 0, courses_count) as courses_count 
            from users U 
            left join (select course_owner, count(*) as courses_count from courses group by course_owner) C on C.course_owner = U.user_id
            where role = 'teacher'
            order by C.course_owner DESC, user_id ASC
            Limit 3
            ";

            $result = $db -> selectAll($SQL);
            $teachers = [];

            foreach($result as $row) {
                $teacher = new Teacher($row['user_id'], $row['first_name'], $row['last_name'], $row['email'], '', $row['role'], $row['image_url'], '', '', $row['title'], $row['bio']);

                $teachers[] = [$teacher, $row['courses_count']];
            }

            return $teachers;
        }

        public static function getTopStudents() {
            $db = Database::getInstance();

            $SQL = 
            "SELECT U.*, if(en_count is null, 0, en_count) as en_count 
            from users U 
            left join (select user_id, count(*) as en_count from enrollement group by user_id) EN on EN.user_id = U.user_id
            where role = 'student'
            order by EN.en_count DESC, U.user_id ASC
            Limit 3
            ";

            $result = $db -> selectAll($SQL);
            $students = [];

            foreach($result as $row) {
                $student = new Student($row['user_id'], $row['first_name'], $row['last_name'], $row['email'], '', $row['role'], $row['image_url']);

                $students[] = [$student, $row['en_count']];
            }

            return $students;
        }

        public static function getUsersList(string $filter = '') {
            $db = Database::getInstance();

            $SQL = "SELECT * from users ";

            if (in_array($filter, ['Admin', 'Teacher', 'Student'])) {
                $SQL .= "Where role = $filter";
            } else if (in_array($filter, ['Pending', 'Active', 'Banned'])) {
                $SQL .= "Where status = $filter";
            }

            $result = $db -> selectAll($SQL);
            $users = [];

            foreach($result as $row) {
                if ($row['role'] == 'admin') {
                    $user = new Admin($row['user_id'], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row['role'], $row['image_url'], $row['register_date'], $row['status']);
                } else if ($row['role'] == 'teacher') {
                    $user = new Teacher($row['user_id'], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row['role'], $row['image_url'], $row['register_date'], $row['status'], $row['title'], $row['bio']);
                } else {
                    $user = new Student($row['user_id'], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row['role'], $row['image_url'], $row['register_date'], $row['status']);
                }
                
                $users[] = $user;
            }

            return $users;
        }
    }