<?php

    abstract class Course {
        protected int $course_id;
        protected string $title;
        protected string $description;
        protected string $image_path;
        protected string $publish_date;
        protected string $type;
        protected string $file_path;
        protected string $enrollements_count;
        protected Category|null $category;
        protected User|null $teacher;
        protected array $errors = [];

        public function __construct(int $course_id = 0, string $course_title = '', string $description = '', Category|null $category = null, User|null $teacher = null, string $image_path = '', string $file_path = '', string $publish_date = '', int $enrollements_count = 0) {
            $this -> course_id = $course_id;
            $this -> title = $course_title;
            $this -> description = $description;
            $this -> image_path = $image_path;
            $this -> publish_date = $publish_date;
            $this -> category = $category;
            $this -> teacher = $teacher;
            $this -> file_path = $file_path;
            $this -> enrollements_count = $enrollements_count;
        }
        
        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setTitle(string $title) : void {
            $this -> title = $title;
        }

        public function setDescription(string $description) : void {
            $this -> description = $description;
        }

        public function setImagePath(string $image_path) : void {
            $this -> image_path = $image_path;
        }

        public function setType(string $type) : void {
            $this -> type = $type;
        }

        public function setFilePath(string $file_path) : void {
            $this -> file_path = $file_path;
        }

        public function setCategory(Category $category) : void {
            $this -> category = $category;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getCourseId() {
            return $this -> course_id;
        }

        public function getTitle() {
            return htmlspecialchars($this -> title);
        }

        public function getDescription() {
            return htmlspecialchars($this -> description);
        }

        public function getImagePath() {
            if ($this -> image_path == "") {
                return "/uploads/images/courses/default.jpg";
            }
            return htmlspecialchars($this -> image_path);
        }

        public function getType() {
            return $this -> type;
        }

        public function getPublishDate() {
            return htmlspecialchars($this -> publish_date);
        }

        public function getFilePath() {
            return htmlspecialchars($this -> file_path);
        }

        public function getCategory() : Category {
            return $this -> category;
        }

        public function getTeacher() : Teacher {
            return $this -> teacher;
        }

        public function getEnrollementsCount() {
            return $this -> enrollements_count;
        }

        public function getErrors() {
            return $this -> errors;
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function uploadImage(array $file) : bool {

            $allowed_types = ["image/jpeg", "image/png", "image/webp"];

            if ($file['error'] != 0) {      // Image not uploaded
                return false;
            }

            if (!in_array($file["type"], $allowed_types)) {
                array_push($this -> errors, "The type of the image is not allowed");
                return false;
            }

            $image_path = "";

            if (!empty($file)) {
                $image_name = uniqid() . $file["name"];
                $new_path = "../uploads/images/courses/" . $image_name;
                $image_path = "/uploads/images/courses/" . $image_name;
                
                if (!move_uploaded_file($file['tmp_name'], $new_path)) {
                    array_push($this -> errors, "Could not upload the file.");
                    return false;
                }
            }

            $this -> image_path = $image_path;

            return true;
        }

        public function is_subscribed(int $user_id) : bool {
            $db = Database::getInstance();

            $sql = "SELECT * FROM enrollement where user_id = ? and course_id = ?";

            if($db -> select($sql, [$user_id, $this -> course_id])) {
                return true;
            }

            return false;

        }

        public function deleteCourse() : bool {

            $db = Database::getInstance();

            if (
                empty($this -> course_id)
            ) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            $data = [
                $this -> course_id,
            ];

            if (!$db -> delete('courses', 'course_id = ?', $data)) {
                array_push($this -> errors, "Could not save your changes");
                return false;
            }

            return true;
        }

        // ------------------------------------
        // Static Methods
        // ------------------------------------

        public static function getAllCourses() {

            $db = Database::getInstance();

            $sql = 
            "WITH numbered_rows AS (
                select *, ROW_NUMBER() OVER (partition by course_category ORDER BY course_id) as row_num 
                from courses
            )

            select NR.course_id, NR.title as title, description, image_path, publish_date, type, 
            course_owner, cat_name, user_id, first_name, last_name, 
            NR.course_category as course_category, count,
            if(en_count is null, 0, en_count) as en_count
            
            from numbered_rows NR 
            join categories on categories.cat_id = NR.course_category 
            join users U on U.user_id = NR.course_owner 
            join (select course_category, count(*) as count from courses group by course_category) 
            as CT on CT.course_category = NR.course_category
            left join (select course_id, count(*) as en_count from enrollement group by course_id) 
            as EN on EN.course_id = NR.course_id
            where row_num <= 6;
            ";

            $result = $db -> selectAll($sql);

            $courses = [];
            $counts = [];

            foreach($result as $row) {
                if ($row['type'] == "Video") {
                    $instance =  new VideoCourse($row['course_id'], $row['title'], $row['description'], null, new Teacher($row['user_id'], $row['first_name'], $row['last_name']), $row['image_path'], '', $row['publish_date'], $row['en_count']);
                } else if ($row['type'] == "Document") {
                    $instance =  new DocumentCourse($row['course_id'], $row['title'], $row['description'], null, new Teacher($row['user_id'], $row['first_name'], $row['last_name']), $row['image_path'], '', $row['publish_date'], $row['en_count']);
                }
                $courses[$row['cat_name']][] = $instance;
                $counts[$row['cat_name']] = $row['count'];
                
            }

            return [$courses, $counts];
            
        }

        public static function getCourse(string $id) {
            $db = Database::getInstance();

            $sql = "SELECT C.course_id as course_id, C.title as title, description, image_path, file_path, publish_date, type, 
            course_owner, cat_name, user_id, first_name, last_name, email, role, image_url as user_image, register_date, U.title as teacher_title, bio,
            C.course_category as course_category, cat_name,
            if(en_count is null, 0, en_count) as en_count
            
            from courses C
            join categories on categories.cat_id = C.course_category 
            join users U on U.user_id = C.course_owner 
            left join (select course_id, count(*) as en_count from enrollement group by course_id) 
            as EN on EN.course_id = C.course_id
            WHERE C.course_id = ?
            ";

            $result = $db -> select($sql, [$id]);

            if (!$result) {
                return false;
            }

            $teacher = new Teacher($result['user_id'], $result['first_name'], $result['last_name'], $result['email'], '', $result['role'], $result['user_image'], $result['register_date'], '', $result['teacher_title'], $result['bio']);
            $category = new Category($result['course_category'], $result['cat_name']);

            if ($result['type'] == "Video") {
                $instance =  new VideoCourse($result['course_id'], $result['title'], $result['description'], $category, $teacher, $result['image_path'], $result['file_path'], $result['publish_date'], $result['en_count']);
            } else {
                $instance =  new DocumentCourse($result['course_id'], $result['title'], $result['description'], $category, $teacher, $result['image_path'], $result['file_path'], $result['publish_date'], $result['en_count']);
            }
            
            return $instance;
        }

        // ------------------------------------
        // Abstract Methods
        // ------------------------------------

        public abstract function displayCourse() : void;

        // public function updatePost() {
        //     if (!empty($this -> errors)) {
        //         return false;
        //     }

        //     if (
        //         empty($this -> id) ||
        //         empty($this -> title) ||
        //         empty($this -> content)
        //     ) {
        //         array_push($this -> errors, "Could not process your request");
        //         return false;
        //     }

        //     $columns = [
        //         'title',
        //         'content'
        //     ];

        //     $data = [
        //         $this -> title,
        //         $this -> content
        //     ];

        //     if (!$this -> db -> update('posts', $columns, $data, 'post_id = ?', [$this -> id])) {
        //         array_push($this -> errors, "Could not save your changes");
        //         return false;
        //     }

        //     $this -> db -> delete('post_tags', 'post_id = ?', [$this -> id]);

        //     return true;
        // }

        // // Method to delete a post

        

        // public function getAllPosts() {
        //     $posts = $this -> db -> select("SELECT * from posts join users on users.user_id = posts.post_author ORDER BY post_id DESC");
            
        //     // Get tags of each post

        //     $tags_groups = [];

        //     foreach($posts as $post) {
        //         $tags = $this -> db -> select("SELECT * FROM post_tags join tags on tags.tag_id = post_tags.tag_id WHERE post_id = ?", [$post['post_id']]);
            
        //         array_push($tags_groups, $tags);
        //     }

        //     return [$posts, $tags_groups];
        // }

        // public function getPostData(string $id) {
        //     if (preg_match('/^[0-9][1-9]*$/', $id) == 0) {
        //         return false;
        //     }
        //     $result = $this -> db -> selectOne("SELECT * FROM posts Where post_id = ?", [$id]);

        //     $this -> setId($result['post_id']);
        //     $this -> setTitle($result['title']);
        //     $this -> setContent($result['content']);
        //     $this -> setImageUrl($result['post_image_url']);
        //     $this -> setAuthorId($result['post_author']);
        //     // $this -> setCategoryId($result['post_cat']);
        //     $this -> setPublishDate($result['publish_date']);

        //     return true;
        // }

        // // Method to create a comment

        // public function createComment($content, $author_id) {

        //     $new_comment = new Comment($this -> db);

        //     $new_comment -> setContent($content);
        //     $new_comment -> setAuthorId($author_id);

        //     if (!empty($new_comment -> getErrors())) {
        //         array_push($this -> errors, "Please fill in the form");
        //         return false;
        //     }

        //     if (
        //         empty($this -> id)
        //     ) {
        //         array_push($this -> errors, "Could not process your request");
        //         return false;
        //     }

        //     $columns = [
        //         'content',
        //         'comment_author',
        //         'comment_post'
        //     ];

        //     $data = [
        //         $content,
        //         $new_comment -> getAuthorID(),
        //         $this -> getId()
        //     ];

        //     if (!$this -> db -> insert('comments', $columns, $data)) {
        //         array_push($this -> errors, "Could not save your changes");
        //         return false;
        //     }

        //     array_push($this -> comments, $new_comment);

        //     return true;
        // }

    }

?>