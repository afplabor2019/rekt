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

<div class="labelC middle msgMain">
    <h1 class="secondaryColor">MESSAGES
        <?php
        if ($toIds != null || $toIds != "") {
            echo 'TO' . getUserById($db, $toIds)['name'];
        }
        ?>
    </h1>
    <table>
        <tr>
            <td id="msgContacts">
                <table id="msgContactsTable">
                    <?php
                    $messages = getAllMessageContactForUser($db, $user['id']);
                    $contacts = [];
                    while ($msg = mysqli_fetch_array($messages)) {
                        if ($msg['fromId'] != $user['id'] && !in_array($msg['fromId'], $contacts)) {
                            $contacts[sizeof($contacts) + 1] = $msg['fromId'];
                            echo '<tr class="msgContactpanel ';
                            if ($toIds == $msg['fromId']) {
                                echo 'activeMsg';
                            }
                            echo '"><td><a href="' . route(['page' => 'messages', 'toId' => $msg['fromId']]) . '">' . getUserById($db, $msg['fromId'])['name'] . '</a></td></tr>';
                        }
                        if ($msg['toID'] != $user['id'] && !in_array($msg['toID'], $contacts)) {
                            $contacts[sizeof($contacts) + 1] = $msg['toID'];
                            echo '<tr class="msgContactpanel ';
                            if ($toIds == $msg['toID']) {
                                echo 'activeMsg';
                            }
                            echo '"><td><a href="' . route(['page' => 'messages', 'toId' => $msg['toID']]) . '">' . getUserById($db, $msg['toID'])['name'] . '</a></td></tr>';
                        }
                    }
                    ?>
                </table>
            </td>
            <td>
                <div style="overflow-y:scroll; width:400px; height:400px;">
                    <table class="msgMSGTable">
                        <?php
                        $messages = getAllMessageBetweenTwoUser($db, $user['id'], $toIds);
                        while ($msg = mysqli_fetch_array($messages)) {
                            echo '<tr>';
                            if ($user['id'] == $msg['fromId']) {
                                echo '<td class="msgLeft"></td><td class="msgRight">' . $msg['text'] . '</td>';
                            } else {
                                echo '<td class="msgLeft">' . $msg['text'] . '</td><td class="msgRight"></td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <form action="<?php echo route(['page' => 'messages', 'toId' => $toIds]); ?>" method="POST" enctype="multipart/form-data">
                    <input class="textInput msgInputText" type="text" name="message">
                    <input class="buttonC msgSend" type="submit" name="add" value="Add" />
                </form>
            </td>
        </tr>
    </table>
</div>