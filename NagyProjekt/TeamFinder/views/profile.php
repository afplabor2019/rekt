<?php if (!defined("APP_VERSION")) {
    exit;
} ?>
<?php
$user = current_user($db);
?>

<table class="labelC middle">
    <tr>
        <td class="secondaryColor noUpperCase" id="profileName"><?php echo $user['name'] ?></td>
        <td>
            <?php
            echo '<a href="' . route(['page' => 'profileEdit']) . '"><img class="headerIcon" src="Resources\edit.svg" alt="Edit profile" title="Edit profile"></a>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="formLeft">Birth day:</td>
        <td class="formLeft"><?php echo $user['birthDay'] ?></td>
    </tr>
    <tr>
        <td class="formLeft">Email:</td>
        <td class="formLeft"><?php echo $user['email'] ?></td>
    </tr>
</table>