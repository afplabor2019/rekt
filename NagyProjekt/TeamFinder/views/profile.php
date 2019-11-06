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
</table>