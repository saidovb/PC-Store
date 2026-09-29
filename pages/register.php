<?php
session_start();
include "../partials/start.php";
require_once __DIR__ . "/../db/config.php";


if ($_POST){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!$username || !$password){
        echo "Enter all data";
        return;
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user){
        echo "This username is already taken";
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hash]);

    header("Location: login.php");
}

?>



<div class="min-h-screen flex items-center justify-center">
    <form method="POST" class="flex flex-col gap-4">

        <h1>Register</h1>

        <input class="text-black" type="text" name="username" placeholder="Username" required>
        <input class="text-black" type="password" name="password" placeholder="Password" required>

        <button class="border" type="submit">Sign up</button>

        <p class="text-sm">Already have an account: 
            <a href="login.php" class="text-blue-500">Log in</a>
        </p>

    </form>
</div>



<?php
include "../partials/end.php";
?>