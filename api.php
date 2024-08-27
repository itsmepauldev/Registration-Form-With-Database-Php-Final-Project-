<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $api_key = isset($_GET['api_key']) ? $_GET['api_key'] : null;

    if (!$api_key) {
        $headers = apache_request_headers();
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $api_key = $matches[1];
        }
    }

    if ($api_key) {
        $sql = "SELECT id, fname, email, date_modified, contact_number, birthday, complete_address, profile_picture FROM users WHERE api_key='$api_key'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

          
            if (!empty($user['profile_picture'])) {
                $user['profile_picture'] = base64_encode($user['profile_picture']);
            }

            echo json_encode($user);
        } else {
            http_response_code(401);
            echo json_encode(["status" => 401, "message" => "Unauthorized"]);
        }
    } else {
        http_response_code(401);
        echo json_encode(["status" => 401, "message" => "Unauthorized"]);
    }
}
?>
