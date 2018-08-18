<?php
session_start();
require_once 'functions.php';

$loggedin = checkForLogin();

function showUserInHeader($loggedin)
{
    if ($loggedin && $user = $_SESSION['user']) {
        echo <<< RAW1
		<a href='#' class='user-header loggedin modal-trigger' data-target='account-settings'>
		    <div>
			    <i class='material-icons user-icon'>person</i>
			    <span class='user-name'>$user</span>
			</div>
</a>
RAW1;

    } else {
        echo <<< RAW

		<div href='#!' class='user-header guest'>
			<a href="" class="modal-trigger user-icon" data-target='account-connect'>
			    <i class='material-icons user-icon'>person</i>
            </a>
			<a href='#' class='modal-trigger' data-target='account-connect'>Log in</a>
			<span>|</span>
			<a href='#' class='modal-trigger' data-target='account-connect'>Sign up</a>
		</div>
RAW;
    }

}

function showAccountModal($loggedin)
{
    if ($loggedin) {
        $user = $_SESSION['user'];
        $email = $_SESSION['email'];
        echo <<< RAW
		<div id="account-settings" class="modal">
    <a href="#!" class="modal-close"><i class="material-icons">close</i></a>
    <div class="modal-content">
        <h2>Account settings</h2>
        <div class="content">
        <div class="account-buttons">
            <a href="#" id="logout" class="button logout"><span>log out</span></a>
            <a href="#" id="delete-account" class="button delete-account"><span>Delete account</span></a>
        </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="account-user" type="text" value="$user" disabled >
                    <label for="account-user">Full name</label>
                    <a href="#" class="button edit edit-user"><span>Edit</span></a>
                </div>
                <div class="input-field col s12">
                    <input id="account-pass" type="text" value="•••••••••••" disabled >
                    <label for="account-pass">Password</label>
                    <a href="#" class="button edit edit-pass"><span>Edit</span></a>
                </div>
                <div class="input-field col s12">
                    <input id="account-email" type="text" value="$email" disabled >
                    <label for="account-email">Email</label>
                </div>
            </div>
        </div>
    </div>
</div>

RAW;
    } else {
        echo <<< RAW
		<div id="account-connect" class="modal">
    <a href="#!" class="modal-close"><i class="material-icons">close</i></a>
    <div class="modal-content">
        <h2>Connect</h2>
        <div class="row">
            <ul id="account-tabs" class="tabs">
                <li class="tab login col s6 m6"><a href="#login">Log in</a></li>
                <li class="tab signup col s6 m6"><a href="#signup">Sign up</a></li>
            </ul>
        </div>
        <div class="content">
            <div id="login" class="col s12 account-connect">
                <form id="login-form">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="email" id="login-email"  name="email" class="validate">
                            <label for="login-email">Email</label>
                            <span class="helper-text" data-error="Invalid e-mail" data-success="Nice"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" id="login-pass" name="pass">
                            <label for="login-pass">Password</label>
                        </div>
                    </div>
                    <button type="submit" class="button"><span>Log in</span></button>
                </form>
                <div id="login-message" class="form-message"></div>
            </div>
            <div id="signup" class="col s12 account-connect">
                <form id="signup-form">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="signup-user"  name="user" class="validate">
                            <label for="signup-user">Full name</label>
                            <span class="helper-text" data-error="Invalid name" data-success="Good name"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="email" id="signup-email"  name="email" class="validate">
                            <label for="signup-email">Email</label>
                            <span class="helper-text" data-error="Invalid e-mail" data-success="Nice"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" id="signup-pass" name="pass">
                            <label for="signup-pass">Password</label>
                        </div>
                    </div>
                    <button type="submit" class="button"><span>Sign up</span></button>
                </form>
                <div id="signup-message" class="form-message"></div>
            </div>
        </div>
    </div>
</div>

RAW;

    }
}