<?php
include 'config.php';

header('Content-Type: application/json');


function sanitize_input($data) {
    return trim(htmlspecialchars($data));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_POST['user_id'])) {
        $user_id = sanitize_input($_POST['user_id']);

        
        $update_fields = [];

        if (isset($_POST['fname'])) {
            $fname = sanitize_input($_POST['fname']);
            $update_fields[] = "fname='$fname'";
        }

        if (isset($_POST['email'])) {
            $email = sanitize_input($_POST['email']);
            $update_fields[] = "email='$email'";
        }

        if (isset($_POST['contact_number'])) {
            $contact_number = sanitize_input($_POST['contact_number']);
            $update_fields[] = "contact_number='$contact_number'";
        }

        if (isset($_POST['birthday'])) {
            $birthday = sanitize_input($_POST['birthday']);
            $update_fields[] = "birthday='$birthday'";
        }

        if (isset($_POST['complete_address'])) {
            $complete_address = sanitize_input($_POST['complete_address']);
            $update_fields[] = "complete_address='$complete_address'";
        }

     
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $file_tmp_name = $_FILES['profile_picture']['tmp_name'];
            $file_name = basename($_FILES['profile_picture']['name']);
            $upload_dir = 'uploads/';

         
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $upload_path = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp_name, $upload_path)) {
                $update_fields[] = "profile_picture='$upload_path'";
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to move uploaded file.'));
                exit();
            }
        }

    
        error_log("Update Fields: " . implode(", ", $update_fields));
        
       
        if (count($update_fields) > 0) {
            $sql = "UPDATE users SET " . implode(", ", $update_fields) . " WHERE id='$user_id'";
            
           
            error_log("SQL Query: $sql");

            if ($conn->query($sql) === TRUE) {
             
                $sql = "SELECT id, fname, email, date_modified, contact_number, birthday, complete_address, profile_picture FROM users WHERE id='$user_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  
                    $user = $result->fetch_assoc();
                    
                    if (!empty($user['profile_picture'])) {
                        $user['profile_picture'] = base64_encode(file_get_contents($user['profile_picture']));
                    }
                  
                    echo json_encode(array('status' => 'success', 'user' => $user));
                } else {
                    // If user not found
                    echo json_encode(array('status' => 'error', 'message' => 'User not found after update.'));
                }
            } else {
                // If update fails, return error JSON response
                echo json_encode(array('status' => 'error', 'message' => 'Failed to update user: ' . $conn->error));
            }
        } else {
            // If no fields to update, return error JSON response
            echo json_encode(array('status' => 'error', 'message' => 'No fields to update'));
        }
    } else {
        // If user_id is missing, return error JSON response
        echo json_encode(array('status' => 'error', 'message' => 'Missing user_id parameter'));
    }
} else {
    // If the request method is not POST, return error JSON response
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
