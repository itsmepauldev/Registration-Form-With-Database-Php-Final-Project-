
<!DOCTYPE html>
<script src="https://cdn.tailwindcss.com"></script>
<html>

<body class = "bg-[url('blurry-gradient-haikei.png')] bg-cover bg-no-repeat">

<form method="post" action="index.php">
    <div class = "grid grid-cols-2 gap-4 mx-60 mt-40">
        <div class = "bg-['d3cdff] shadow-2xl rounded-lg flex justify-center  h-96" >
        <div class="mt-16">
            <h1 class = "font-semibold text-3xl text-[#111137]">Login</h1>
            <div><label for="" class = "font-semibold text-sm">Email Address</label></div>
        <input type="email" name="email" required class="border-solid border-gray-400 border-2 rounded-md h-8 w-48"><br>
        <div><label for="" class = "font-semibold text-sm">Password</label></div>
        <input type="password" name="password" required class="border-solid border-gray-400 border-2 rounded-md h-8 w-48" ><br>
    <button type="submit" class="bg-[#893DFF] w-48 text-white font-mono h-8 rounded-lg mt-4 hover:bg-[#490fa0]">Login</button>
    <p class = "text-sm">Doesn't have an account yet? <button onclick="window.location.href='register.php'" class ="text-decoration-line: underline text-[#893DFF] mb-3 mt-2">Register</button>  </p>

    <div class="text-[#FF0000]"><?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, fname, email, password FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }
}
?>
</div>
        </div>
        </div>
        <div>
            <img src="undraw_welcome_cats_thqn.svg" alt="WELCOME BANNER" class = "mt-10">
        </div>
    </div>

</form>
</body>
</html>
