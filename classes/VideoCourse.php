<?php
    class VideoCourse extends Course {

        public function __construct(int $course_id = 0, string $course_title = '', string $description = '', Category|null $category = null, User|null $teacher = null, string $image_path = '', string $file_path = '', string $publish_date = '', int $enrollements_count = 0) {
            parent::__construct($course_id, $course_title, $description, $category, $teacher, $image_path, $file_path, $publish_date, $enrollements_count);
            $this -> type = "Video";
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function createCourse() {

            $db = Database::getInstance();

            if (
                empty($this -> title) ||
                empty($this -> description) ||
                empty($this -> category) ||
                empty($this -> file_path)
            ) {
                $this -> errors[] = "Please fill In the form";
                return false;
            }

            $columns = [
                'title',
                'description',
                'course_category',
                'image_path',
                'course_owner',
                'type',
                'file_path'
            ];

            $data = [
                $this -> title,
                $this -> description,
                $this -> category -> getCategoryId(),
                $this -> image_path,
                $this -> teacher -> getUserId(),
                $this -> type,
                $this -> file_path
            ];

            $inserted_id = $db -> insert('courses', $columns, $data);

            if (!$inserted_id) {
                array_push($this -> errors, "Could not save your changes -> " . $db -> getError() );
                return false;
            }

            $this -> course_id = $inserted_id;

            return true;
        }

        public function uploadVideo(array $file) : bool {

            $allowed_types = ["video/mp4"];

            if ($file['error'] != 0) {      // File not uploaded
                return false;
            }

            if (!in_array($file["type"], $allowed_types)) {
                array_push($this -> errors, "The type of the video is not allowed");
                return false;
            }

            $file_path = "";

            if (!empty($file)) {
                $image_name = uniqid() . $file["name"];
                $new_path = "../uploads/files/videos/" . $image_name;
                $file_path = "/uploads/files/videos/" . $image_name;
                
                if (!move_uploaded_file($file['tmp_name'], $new_path)) {
                    array_push($this -> errors, "Could not upload the video.");
                    return false;
                }
            }

            $this -> file_path = $file_path;

            return true;
        }

        public function displayCourse() : void {
            echo 
            "<div class='py-8'>
                <div class='flex justify-center items-center gap-3'>
                    <a href='{$this -> file_path}' target='_blank' class='bg-[#00A5CF] block text-white px-6 py-2 rounded font-semibold'>Open in New Tab</a>
                    <a href='{$this -> file_path}' download class='bg-[#00A5CF] block text-white px-6 py-2 rounded font-semibold'>Download Video</a>
                </div>

                <div class='px-7 mt-6'>
                    <video src='{$this -> file_path}' class='w-full' controls>
                        Your Browser does not support this video type
                    </video>
                </div>
            </div>";
        }
    }
?>