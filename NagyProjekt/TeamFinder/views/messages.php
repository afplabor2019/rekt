<?php if (!defined("APP_VERSION")) {
    exit;
} ?>
<?php
/*
$sendTo = "";
$toIds = "";*/
$user = current_user($db);
/*
if (isset($_SESSION['senTo'])) {
    $sendTo = $_SESSION['sendTo'];
    unset($_SESSION['sendTo']);
}

if (isset($_SESSION['toIds'])) {
    $toIds = $_SESSION['toIds'];
    unset($_SESSION['toIds']);
}

$messagesWith = 10;*/
$toIds = null;
if (isset($_GET['toId'])) {
    $toIds = $_GET['toId'];
}

if (is_post()) {
    if (isset($_GET['toId'])) {
        $toIds = $_GET['toId'];
    }
    debug_to_console($toIds);
    $text = trim($_POST['message']);
    if ($text != null || $text != "") {
        $e = sendMessage($db, $user['id'], $toIds, $text);
        //debug_to_console($e[0]);
    }
}
?>

<h1>MESSAGES</h1>

<table border="1px black solid;">
    <tr>
        <td>
            <table border=" 1px black solid;">
                <?php
                $messages = getAllMessageContactForUser($db, $user['id']);
                $contacts = [];
                while ($msg = mysqli_fetch_array($messages)) {
                    if ($msg['fromId'] != $user['id'] && !in_array($msg['fromId'], $contacts)) {
                        $contacts[sizeof($contacts) + 1] = $msg['fromId'];
                        echo '<tr><td><a href="' . route(['page' => 'messages', 'toId' => $msg['fromId']]) . '">' . getUserById($db, $msg['fromId'])['name'] . '</a></td></tr>';
                    }
                    if ($msg['toID'] != $user['id'] && !in_array($msg['toID'], $contacts)) {
                        $contacts[sizeof($contacts) + 1] = $msg['toID'];
                        echo '<tr><td><a href="' . route(['page' => 'messages', 'toId' => $msg['toID']]) . '">' . getUserById($db, $msg['toID'])['name'] . '</a></td></tr>';
                    }
                }
                ?>
            </table>
        </td>
        <td>
            <div style="overflow-y:scroll; width:400px; height:400px;">
                <?php
                $messages = getAllMessageBetweenTwoUser($db, $user['id'], $toIds);
                while ($msg = mysqli_fetch_array($messages)) {
                    echo '<p style="';
                    if ($user['id'] == $msg['fromId']) {
                        echo 'float: right"';
                    } else {
                        echo 'float: left"';
                    }
                    echo '>' . $msg['text'] . '</p><br>';
                }
                ?>
            </div>
            <form action="<?php echo route(['page' => 'messages', 'toId' => $toIds]); ?>" method="POST" enctype="multipart/form-data">
                <input style="float: left" type="text" name="message">
                <input type="submit" name="add" value="Add" />
            </form>
        </td>
    </tr>
</table>