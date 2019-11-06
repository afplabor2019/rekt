<?php
session_start();
define('APP_VERSION', '1.0.0');
define('STEAMAPIKEY', '36E49C6A15F3B3C47FE30B893F413C1D');
define('CSGOID', '730');

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include "config.php";
include "functions.php";

global $csgoRanksPics, $gameIcons, $lolRanksPics, $r6sRanksPics;

$gameIcons = array(
    "csgo" => "Resources\csgoLogo.png",
    "lol" => "Resources\lolLogo.png",
    "r6s" => "Resources\lr6sLogo.png",
);

$csgoRanksPics = array(
    "Silver I" => "ranks_pictures\silver_1.png",
    "Silver II" => "ranks_pictures\silver_2.png",
    "Silver III" => "ranks_pictures\silver_3.png",
    "Silver IV" => "ranks_pictures\silver_4.png",
    "Silver Elite" => "ranks_pictures\silver_5.png",
    "Silver Elite Master" => "ranks_pictures\silver_6.png",
    "Gold Nova I" => "ranks_pictures\gold_1.png",
    "Gold Nova II" => "ranks_pictures\gold_2.png",
    "Gold Nova III" => "ranks_pictures\gold_3.png",
    "Gold Nova Master" => "ranks_pictures\gold_4.png",
    "Master Guardian I" => "ranks_pictures\gold_5.png",
    "Master Guardian II" => "ranks_pictures\gold_6.png",
    "Master Guardian Elite" => "ranks_pictures\gold_7.png",
    "Distinguished Master Guardian" => "ranks_pictures\bronze_1.png",
    "Legendary Eagle" => "ranks_pictures\bronze_2.png",
    "Legendary Eagle Master" => "ranks_pictures\bronze_3.png",
    "Supreme Master First Class" => "ranks_pictures\bronze_4.png",
    "The Global Elite" => "ranks_pictures\bronze_5.png",
);

$lolRanksPics = array(
    "Iron" => "ranks_pictures\bronze_1.png",
    "Bronze" => "ranks_pictures\bronze_2.png",
    "Silver" => "ranks_pictures\bronze_3.png",
    "Gold" => "ranks_pictures\silver_1.png",
    "Platinum" => "ranks_pictures\silver_2.png",
    "Diamond" => "ranks_pictures\silver_3.png",
    "Master" => "ranks_pictures\gold_1.png",
    "Grandmaster" => "ranks_pictures\gold_2.png",
    "Challenger" => "ranks_pictures\gold_3.png",
);

$r6sRanksPics = array(
    "Copper 1" => "ranks_pictures\bronze_1.png",
    "Copper 2" => "ranks_pictures\bronze_2.png",
    "Copper 3" => "ranks_pictures\bronze_3.png",
    "Copper 4" => "ranks_pictures\bronze_4.png",
    "Bronze 1" => "ranks_pictures\bronze_5.png",
    "Bronze 2" => "ranks_pictures\bronze_6.png",
    "Bronze 3" => "ranks_pictures\bronze_7.png",
    "Bronze 4" => "ranks_pictures\silver_1.png",
    "Silver 1" => "ranks_pictures\silver_2.png",
    "Silver 2" => "ranks_pictures\silver_3.png",
    "Silver 3" => "ranks_pictures\silver_4.png",
    "Silver 4" => "ranks_pictures\silver_5.png",
    "Gold 1" => "ranks_pictures\silver_6.png",
    "Gold 2" => "ranks_pictures\silver_7.png",
    "Gold 3" => "ranks_pictures\gold_1.png",
    "Gold 4" => "ranks_pictures\gold_2.png",
    "Platinum 1" => "ranks_pictures\gold_3.png",
    "Platinum 2" => "ranks_pictures\gold_4.png",
    "Platinum 3" => "ranks_pictures\gold_5.png",
    "Diamond" => "ranks_pictures\gold_6.png",
);

$db = dbConnect();

include "./views/header.php";
if (file_exists("./views/$page.php")) {
    include "./views/$page.php";
} else {
    include "./views/404.php";
}

dbClose($db);
