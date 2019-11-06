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

function getUserById($db, $id)
{
    $sql = $db->prepare("SELECT * FROM players WHERE id=$id");
    $sql->execute();
    $result = $sql->get_result();
    return $result->fetch_assoc();
}

function addAd($db, $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName)
{
    $result = searchAd($db, $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName);

    $resultCount = 0;
    foreach ($result as $ad) {
        $resultCount++;
    }
    debug_to_console($resultCount);

    if ($resultCount != 0) {
        //row added
        debug_to_console("This ad already exists");
        return false;
    } else {
        //add row
        $sql = $db->prepare("INSERT INTO advertisement (game,skillRange,lookingFor,age,region,role,goal,advertiserID,language,communication,teamName) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $sql->bind_param("sssssssisss", $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName);
        $sql->execute();
        $sql->close();
        return true;
    }
}

function searchAd($db, $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName)
{
    $query = $db->prepare("SELECT * from advertisement where 
    game=? and
    skillRange=? and
    lookingFor=? and
    age=? and
    region=? and
    role=? and
    goal=? and
    advertiserID=? and
    language=? and
    communication=? and
    teamName=?");
    $query->bind_param("sssssssisss", $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    return $result;
}

function getAllAdByGame($db, $game)
{
    $sql = $db->prepare("SELECT * FROM advertisement WHERE game=? ORDER BY id");
    $sql->bind_param("s", $game);
    $sql->execute();
    $result = $sql->get_result();
    return $result;
}

function redirectToMessages($toId)
{
    $_SESSION['toId'] = $toId;
    $_SESSION['sendTo'] = true;
    echo route(['page' => 'messages']);
}

function getAllMessagesForUser($db, $userID)
{
    $sql = $db->prepare("SELECT * FROM messages WHERE fromId=? OR toId=? ORDER BY sendTime");
    $sql->bind_param("ii", $userID, $userID);
    $sql->execute();
    $result = $sql->get_result();
    return $result;
}

function getAllMessageBetweenTwoUser($db, $user1, $user2)
{
    $sql = $db->prepare("SELECT * FROM messages WHERE (fromId=? OR toId=?) AND (fromId=? OR toId=?) ORDER BY sendTime");
    $sql->bind_param("iiii", $user1, $user1, $user2, $user2);
    $sql->execute();
    $result = $sql->get_result();
    return $result;
}

function getAllMessageContactForUser($db, $userId)
{
    //SELECT * FROM messages GROUP BY toID HAVING fromId=11 OR toId=11 ORDER BY sendTime
    $sql = $db->prepare("SELECT fromId, toID FROM messages GROUP BY toID HAVING fromId=? OR toId=? ORDER BY sendTime");
    $sql->bind_param("ii", $userId, $userId);
    $sql->execute();
    $result = $sql->get_result();
    return $result;
}

function sendMessage($db, $fromId, $toID, $text)
{
    $sql = $db->prepare("INSERT INTO messages (fromId, toID, text) VALUES (?,?,?)");
    $sql->bind_param("iis", $fromId, $toID, $text);
    $sql->execute();
    $errors = mysqli_error_list($db);
    $sql->close();
    return $errors;
}
