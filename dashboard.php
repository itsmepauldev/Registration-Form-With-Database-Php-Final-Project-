<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, fname, email, date_modified, contact_number, birthday, complete_address, profile_picture, api_key FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<script src="https://cdn.tailwindcss.com"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

<body class = "">
  

<div class="grid grid-cols-2 gap-4 mx-60 mt-40">




     <div class="shadow-2xl rounded-lg h-[500px] w-[500px] bg-white "> 
       
     <h1 class = "flex justify-center font-semibold text-[#6C63FF] text-2xl mt-2 mb-5">Welcome, <?php echo $user['fname']; ?>!</h1>
     <div class = "flex justify-center mb-5">
        <?php

        if (!empty($user['profile_picture'])) {
            echo "<img src='" . $user['profile_picture'] . "' alt='Profile Picture' style='width: 120px; height: 120px; border-radius: 100px; border: 2px solid #1fd655;'>";
        } else {

            echo "<img src='profile.jpg' alt='Profile Picture' style='width: 120px; height: 120px; border-radius: 100px; border-solid; border-black;'>";
        }
        ?>
</div>
      

<div class = "flex justify-center mt-10">
        <table class="border-solid border-2 border-[#6C63FF]">

            <tr class="border-solid border-2 border-[#6C63FF]">
                <td class="text-[#6C63FF] font-bold">ID: </td>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold"><?php echo $user['id']; ?></td>
            </tr>
            <tr>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">Email: </td>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold"><?php echo $user['email']; ?></td>
            </tr>
            <tr>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">Date Modified: </td>
                
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                <?php echo $user['date_modified']; ?>
                </td>
            </tr>
            <tr>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">Contact Number: </td>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold" ><?php echo $user['contact_number']; ?></td>
            </tr>
            <tr>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                Birthday: 
                </td>
               
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                <?php echo $user['birthday']; ?>
                </td>
            </tr>
            <tr>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                Complete Address:   
                </td>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                <?php echo $user['complete_address']; ?>
                </td>
            </tr>
            <tr>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                Api_key: 
                </td>
                <td class="border-solid border-2 border-[#6C63FF] text-[#6C63FF] font-bold">
                <?php echo $user['api_key']; ?>
                </td>
            </tr>


        </table>
        </div>
        <div class = "flex justify-center ">
        <button onclick="window.location.href='index.php'" class ="bg-[#6C63FF] w-48 text-white font-mono h-8 rounded-lg mt-4 hover:bg-[#490fa0] ">Logout</button>

        </div>
    </div>

    <div>
        <img src="undraw_personal_data_re_ihde.svg" alt="Banner">
    </div>
    
    </div>
    
</body>

</html>