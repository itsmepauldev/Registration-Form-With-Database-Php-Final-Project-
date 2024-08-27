

<!DOCTYPE html>
<script src="https://cdn.tailwindcss.com"></script>
<html>

<body class = "bg-[url('blurry-gradient-haikei.png')] bg-cover bg-no-repeat">
    <form method="post" action="register.php">
        <div class="grid grid-cols-2 gap-4 mx-60 mt-40">
            <div class = "bg-['d3cdff] shadow-2xl rounded-lg flex justify-center  h-96" >
                <div class="mt-2">
                <h1 class = "font-semibold text-3xl text-[#111137]">Register</h1>
                <div><label for="" class = "font-semibold text-sm">Name:</label></div>
                <input type="text" name="name" required class="border-solid border-gray-400 border-2 rounded-md h-8 w-48"><br>
                <div><label for="" class = "font-semibold text-sm">Email:</label></div>
                <input type="email" name="email" required class="border-solid border-gray-400 border-2 rounded-md h-8 w-48"><br>
                <div><label for="" class = "font-semibold text-sm">Password:</label></div>
                <input type="password" name="password" required class="border-solid border-gray-400 border-2 rounded-md h-8 w-48"><br>
                <div><label for="" class = "font-semibold text-sm">Retype Password:</label></div>
                <input type="password" name="retype_password" required class="border-solid border-gray-400 border-2 rounded-md h-8 w-48"><br>
                <button type="submit" class="bg-[#893DFF] w-48 text-white font-mono h-8 rounded-lg mt-4 hover:bg-[#490fa0] ">Register</button>
                <p class = "text-sm">if you already have an account <button onclick="window.location.href='index.php'" class ="text-decoration-line: underline text-[#893DFF] mb-1 mt-2"> Login</button>  </p>

          <div>
          <?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];

   
    if ($password === $retype_password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $api_key = bin2hex(random_bytes(16)); 

        $sql = "INSERT INTO users (fname, email, password, api_key) VALUES ('$name', '$email', '$hashed_password', '$api_key')";

        if ($conn->query($sql) === TRUE) {
            echo '<span style="color: green;">Registration successful!</span>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        
        echo '<span style="color: red;">Passwords do not match! </span>';
       
       
    }
}
?>
</div>
          </div>
            </div>
            <div>
<img src="undraw_collaborators_re_hont.svg" alt="">
            </div>
        </div>

    </form>
</body>

</html>