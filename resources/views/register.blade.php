<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/register.css">
    <script src="js/register.js"></script>
</head>
<body>
    <h1>Registration</h1>

    <form id="registerForm">
        <div>
            <label for="username">Username</label><br>
            <input id="username" name="username" type="text" required>
        </div>

        <div>
            <label for="phonenumber">Phone number</label><br>
            <input id="phonenumber" name="phonenumber" type="tel" required>
        </div>

        <div>
            <button id="submitBtn" type="submit">Register</button>
        </div>
    </form>

    <div id="status"></div>
    <div id="errors"></div>

    <hr>

    <div id="userBlock">
        <h2>Created user</h2>
        <div><strong>ID:</strong> <span id="userId"></span></div>
        <div><strong>Username:</strong> <span id="userName"></span></div>
        <div><strong>Phone number:</strong> <span id="userPhone"></span></div>
        <div><strong>Link:</strong> <a id="userLink" href="#" target="_blank" rel="noopener noreferrer"></a></div>
    </div>
</body>
</html>
