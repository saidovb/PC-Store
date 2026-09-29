<?php
include "../partials/start.php";
require_once __DIR__ . "/../db/config.php";

if ($_POST) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!$username || !$password) {
        $error = "Enter all data";
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "User not found";
    }

    if (!password_verify($password, $user["password"])) {
        $error = "Incorrect Password";
    } else {
        $_SESSION["user"] = $user;

        if ($user["is_admin"] == 1) {
            header("Location: /admin/dashboard.php");
        } else {
            header("Location: /index.php");
        }
        exit();
    }
}

?>
<div class="min-h-screen flex items-center justify-center">
    <form method="POST" class="flex flex-col gap-4">

        <h1>Log in</h1>

        <input class="text-black" type="text" name="username" placeholder="Username" required>
        <input class="text-black" type="password" name="password" placeholder="Password" required>
        <button class="border" type="submit">Sign in</button>

        <p class="text-sm">Don't have an account:
            <a href="register.php" class="text-blue-500">Register</a>
        </p>

    </form>
</div>



<?php
include "../partials/end.php";
?>