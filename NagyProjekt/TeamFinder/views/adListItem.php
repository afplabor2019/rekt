<?php if (!defined("APP_VERSION")) {
    exit;
} ?>
<?php
$url = route([
    'page' => 'details',
    'id' => $ad['id'],
]);

?>

<div>
    <p>Category: <?php echo $ad['age'] ?></p>
</div>