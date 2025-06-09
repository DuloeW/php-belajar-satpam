<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (isset($_SESSION['usernmae'])) {
    header('Location: ./dashboard-view.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/output.css">
</head>
<body class="min-h-screen w-full flex justify-center items-center">
    <div class="w-fit h-fit p-3.5 shadow-lg">
        <h1 class="text-2xl font-bold mb-2">Login</h1>
        <p class="text-sm mb-4">Please enter your credentials to login.</p>
        <form class="flex flex-col gap-2"
            action="../handlers/login_handler.php" 
            method="POST">
            <div>
                <input class="w-full mb-2 p-2 border border-gray-300 rounded" 
                    type="text" 
                    name="email"
                    placeholder="Email">
            </div>
            <div>
                <input class="w-full mb-2 p-2 border border-gray-300 rounded" 
                    type="password" 
                    name="password"
                    maxlength="8"
                    placeholder="Password">
            </div>
            <div class="flex justify-center mt-2">
                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition-colors duration-200"
                    >Login</button>
            </div>
        </form>
        <div>
            <p class="text-sm mt-4">Don't have an account? <a href="./register-view.php" class="text-blue-500 hover:underline">Register</a></p>
        </div>
    </div>
</body>
</html>