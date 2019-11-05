<?php

function redirect($params = [])
{
    $url = route($params);
    header("Location: $url");
    die();
}

function route($params = [])
{
    $url = DOMAIN;
    if (is_array($params) && count($params) > 0) {
        $i = 0;
        $url .= "?";
        foreach ($params as $key => $value) {
            if ($i == 0) {
                $url .= "$key=$value";
                $i++;
            } else {
                $url .= "&$key=$value";
            }
        }
    }
    return $url;
}

function log_in_user($id)
{
    $_SESSION['user_id'] = $id;
}

function log_out_user()
{
    $_SESSION = [];
    session_destroy();
}

function user_logged_in()
{
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null;
}

function current_user($db)
{
    if (!user_logged_in()) {
        return null;
    }

    $sql = $db->prepare("SELECT * FROM players WHERE id = ?");
    $sql->bind_param('i', $_SESSION['user_id']);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows != 1) {
        return null;
    }

    return $result->fetch_assoc();
}


function dbConnect()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        if (DEBUG_MODE) {
            die("Connection failed: {$conn->connect_error}");
        }
        die("Connection failed");
    }
    return $conn;
}

function dbClose($conn)
{
    $conn->close();
}


function is_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function print_form_errors($input, $errors)
{
    if (array_key_exists($input, $errors)) {
        foreach ($errors[$input] as $error) {
            echo "<p class='input-error'>$error</p>";
        }
    }
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo '<script>console.log("' . $output . '" );</script>';
    // echo 'console.log("' . $output . '" );';
}

function current_url()
{
    $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    return "{$http}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
}

function gate()
{
    if (!user_logged_in()) {
        $_SESSION['intended'] = current_url();
        redirect(['page' => 'login']);
    }
}

function getAllAd($db)
{
    $sql = $db->prepare("SELECT * FROM advertisement ORDER BY id");
    $sql->execute();
    $result = $sql->get_result();
    return $result;
}