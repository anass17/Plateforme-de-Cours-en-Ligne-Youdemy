<?php

    abstract class Course {
        protected int $course_id;
        protected string $title;
        protected string $description;
        protected string $image_path;
        protected string $publish_date;
        protected string $type;
        protected string $file_path;
        protected Category $category;
        protected User $teacher;
        protected array $errors = [];

        public function __construct(int $course_id = 0, string $course_title = '', string $description = '', Category|null $category = null, User|null $teacher = null, string $type = '', string $image_path = '', string $file_path = '', string $publish_date = '') {
            $this -> course_id = $course_id;
            $this -> title = $course_title;
            $this -> description = $description;
            $this -> image_path = $image_path;
            $this -> publish_date = $publish_date;
            $this -> type = $type;
            $this -> category = $category;
            $this -> teacher = $teacher;
            $this -> file_path = $file_path;
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

        public function getCategory() {
            return $this -> category;
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

        // public function deletePost() {
        //     if (!empty($this -> errors)) {
        //         return false;
        //     }

        //     if (
        //         empty($this -> id)
        //     ) {
        //         array_push($this -> errors, "Could not process your request");
        //         return false;
        //     }

        //     $data = [
        //         $this -> id,
        //     ];

        //     if (!$this -> db -> delete('posts', 'post_id = ?', $data)) {
        //         array_push($this -> errors, "Could not save your changes");
        //         return false;
        //     }

        //     return true;
        // }

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