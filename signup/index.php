<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Signup</title>
</head>
<body>
<h2>sign up</h2>
<form id="signup-form" action="post">
    <div class="">
        <label for="signup-username">Username</label>
        <input id="signup-username" maxlength='30' type="text" name="user" value="">
    </div>
    <div class="">
        <label for="signup-password">Password</label>
        <input id="signup-password" maxlength='30' type="password" name="pass" value="">
    </div>
    <button type="sumbit" name="button" value="signup">Sign up</button>
</form>
<h2>log in</h2>
<form id="login-form" action="post">
    <div class="">
        <label for="login-username">Username</label>
        <input id="login-username" maxlength='30' type="text" name="user" value="">
    </div>
    <div class="">
        <label for="login-password">Password</label>
        <input id="login-password" maxlength='30' type="password" name="pass" value="">
    </div>
    <button type="sumbit" name="button" value="login">Log in</button>
</form>
<h2>Log out</h2>
<button id="logout" type="button">Log out</button>
<script src="/assets/js/jquery.min.js"></script>
<script src="signup.js"></script>
</body>
</html>
