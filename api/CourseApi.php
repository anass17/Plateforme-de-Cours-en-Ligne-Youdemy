<?php

    session_start();

    require '../classes/Database.php';
    require '../classes/Security.php';
    require '../classes/User.php';
    require '../classes/Admin.php';
    require '../classes/Teacher.php';
    require '../classes/Student.php';
    require '../classes/Category.php';
    require '../classes/Course.php';
    require '../classes/VideoCourse.php';
    require '../classes/DocumentCourse.php';
    require '../classes/Helpers.php';

    header('Content-Type: application/json');

    $authorized_roles = ['admin'];
    
    // Check if access token does not exist

    $user_row = Security::isAccessTokenValid();

    $get_payload_date = file_get_contents('php://input');
    $data = json_decode($get_payload_date);

    switch ($_SERVER["REQUEST_METHOD"]) {
        
        // Update user status

        case 'GET':

            $page = 0;

            if (isset($_GET['page'])) {
                $page = (int) $_GET['page'] - 1 > 0 ? (int) $_GET['page'] - 1 : 0;
            }

            if (isset($_GET['keyword'])) {
                $courses = Course::getPageCourses($_GET['keyword'], $page);
            } else {

                $search = isset($_GET['search']) ? $_GET['search'] : '';

                $courses = Course::searchCourses($search);
            }

            $result = [];

            foreach($courses as $course) {
                $result[] = [
                    'id' => $course -> getCourseId(),
                    'title' => $course -> getTitle(),
                    'image' => $course -> getImagePath(),
                    'date' => Helpers::format_date($course -> getPublishDate()),
                    'teacher' => $course -> getTeacher() -> getFullName(),
                    'type' => $course -> getType(),
                    'subscriptions' => $course -> getEnrollementsCount(),
                    'category' => $course -> getCategory() -> getCategoryName()
                ];
            }

            if (count($result) > 0) {
                echo json_encode([
                    'status' => true,
                    'result' => $result
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'result' => []
                ]);
            }


            break;

        case 'PUT':

            if (!$user_row || !Security::isAuthorized($user_row['role'], $authorized_roles)) {
                echo json_encode([
                    'result' => false,
                    'error' => 'Unauthorized'
                ]);
                exit;
            }
        
            $admin = new Admin($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email']);

            $user_id = isset($data -> userId) ? $data -> userId : '';
            $new_status = isset($data -> newStatus) ? $data -> newStatus : '';

            if ($new_status == 'active') {
                $result = $admin -> activateUser($user_id);
                $class = "text-green-700 text-sm text-left font-bold";
            } else if ($new_status == 'banned') {
                $result = $admin -> banUser($user_id);
                $class = "text-gray-700 text-sm text-left font-bold";
            }
            
            if ($result === false) {
                echo json_encode([
                    'status' => false,
                    'message' => "Could not update this user status"
                ]);
            } else {
                echo json_encode([
                    'status' => true,
                    'result' => $new_status,
                    'class' => $class,
                    'message' => "Successfully Updated"
                ]);
            }

            break;

        default:
            echo json_encode([
                'status' => false,
                'message' => 'Invalid Request!'
            ]);
    }
    