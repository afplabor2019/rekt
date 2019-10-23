<?php if (!defined("APP_VERSION")) {
  exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Team Finder</title>

  <link rel="stylesheet" href="css/style.css" ?>
</head>

<body>
  <header>
    <ul class="navBar">
      <li><a class="Logo" href="<?php echo route(); ?>">( ͡° ͜ʖ ͡°) REKT</a></li>
      <li><a href="<?php echo route(); ?>">Home</a></li>
      <li style="float:right">
        <div class="dropdown" style="float:right;">
          <img src="Resources\user-solid.svg" alt="User" class="profileIcon">
          <div class="dropdown-content">
            <?php
            if (user_logged_in()) {
              echo '<a href="' . route(['page' => 'profile']) . '">Profile</a>';
              echo '<a href="' . route(['page' => 'logout']) . '">Log out</a>';
            } else {
              echo '<a href="' . route(['page' => 'login']) . '">Log in</a>';
              echo '<a href="' . route(['page' => 'register']) . '">Register</a>';
            }
            ?>
          </div>
        </div>
      </li>
    </ul>
  </header>