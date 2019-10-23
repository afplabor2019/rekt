<?php if (!defined("APP_VERSION")) {
    exit;
} ?>
<?php
$user = current_user($db);
?>

<table class="label">
    <tr>
        <td>User name:</td>
        <td><?php echo $user['name'] ?></td>
    </tr>
    <tr>
        <td>Birth day:</td>
        <td><?php echo $user['birthDay'] ?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><?php echo $user['email'] ?></td>
    </tr>
    <tr>
        <td>Steam ID:</td>
        <td><?php echo $user['steamID'] ?></td>
    </tr>
    <tr>
        <td>Ubisoft name:</td>
        <td><?php echo $user['uplayName'] ?></td>
    </tr>
    <tr>
        <td>LOL name:</td>
        <td><?php echo $user['lolName'] ?></td>
    </tr>
</table>