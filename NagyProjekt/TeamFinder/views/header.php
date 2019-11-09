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

  <link rel="stylesheet" href="css/dropdownMenu.css" type="text/css" ?>
  <link rel="stylesheet" href="css/header.css" type="text/css" ?>
  <link rel="stylesheet" href="css/home.css" type="text/css" ?>
  <link rel="stylesheet" href="css/global.css" type="text/css" ?>
  <link rel="stylesheet" href="css/profile.css" type="text/css" ?>
</head>

<body class="bodyClass">
  <header id="headerC">
    <div class="inline"><a class="logo" href="<?php echo route(); ?>">( ͡° ͜ʖ ͡°) REKT</a></div>
    <div class="inline"><a class="logo" href="<?php echo route(); ?>">Home</a></div>
    <div class="inline">
      <div class="dropdown" class="right">
        <img src="Resources\man-user.svg" alt="User" class="headerIcon">
        <div class="dropdown-content">
          <?php
          if (user_logged_in()) {
            echo '<a href="' . route(['page' => 'profile']) . '">Profile</a>';
            echo '<a href="' . route(['page' => 'messages']) . '">Messages</a>';
            echo '<a href="' . route(['page' => 'logout']) . '">Log out</a>';
          } else {
            echo '<a href="' . route(['page' => 'login']) . '">Log in</a>';
            echo '<a href="' . route(['page' => 'register']) . '">Register</a>';
          }
          ?>
        </div>
      </div>
    </div>
  </header>