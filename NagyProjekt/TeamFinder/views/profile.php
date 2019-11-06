<?php if (!defined("APP_VERSION")) {
    exit;
} ?>
<?php
$user = current_user($db);
?>

<table class="label">
    <tr>
        <td colspan="2">
            <?php
            echo '<a href="' . route(['page' => 'profileEdit']) . '"><img class="headerIcon" src="Resources\edit.svg" alt="Edit profile" title="Edit profile"></a>';
            ?>
        </td>
    </tr>
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
</table>