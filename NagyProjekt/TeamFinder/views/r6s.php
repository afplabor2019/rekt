<?php if (!defined("APP_VERSION")) {
    exit;
} ?>

<?php
$search = false;
$teams = false;
if (is_post()) {
    $game = trim('r6s');
    $rank = trim($_POST['minRank']) . '-' . trim($_POST['maxRank']);
    $lookingFor = trim('player');
    $age = trim($_POST['minAge']) . '-' . trim($_POST['maxAge']);
    $region = trim($_POST['region']);
    $roles = '';
    $goal = trim($_POST['goal']);
    $advertiserID = current_user($db)['id'];
    $language = trim($_POST['language']);
    $communication = "";
    $teamName = array_key_exists('teamName', $_POST) ? trim($_POST['teamName']) : '';

    if (!empty($_POST['roles'])) {
        foreach ($_POST['roles'] as $selected) {
            $roles = $roles . trim($selected) . "/";
        }
    } else {
        $roles = 'NaN';
    }
    if (!empty($_POST['communication'])) {
        foreach ($_POST['communication'] as $selected) {
            $communication = $communication . trim($selected) . "/";
        }
    } else {
        $communication = 'NaN';
    }
    if (isset($_POST['search'])) {
        // search       
        $search = true;
    } else if (isset($_POST['add'])) {
        // add
        $search = true;
        gate();
        addAd($db, $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName);
    } else if (isset($_POST['showAll'])) {
        $search = false;
    } else if (isset($_POST['player'])) {
        $teams = false;
    } else if (isset($_POST['teams'])) {
        $teams = true;
    }
}
?>

<div class="labelC middleHorizontal">
    <form action="<?php echo route(['page' => 'r6s']); ?>" method="POST" enctype="multipart/form-data">
        <div id="top">
            <Table>
                <tr id="searchFill">
                    <td class="middleHorizontal"><input class="buttonC<?php
                                                                        if (!$teams) {
                                                                            echo ' teamsActive';
                                                                        }
                                                                        ?>" type="submit" name="player" value="Players" /></td>
                    <td class="searchMiddle"><input class="buttonC<?php
                                                                    if ($teams) {
                                                                        echo ' teamsActive';
                                                                    }
                                                                    ?>" type="submit" name="teams" value="Teams" /></td>
                </tr>
                <tr>
                    <td>Minimum skill:</td>
                    <td>
                        <select class="textInput" name="minRank" id="minRank">
                            <?php
                            $fn = fopen("Resources\lr6sRanks.txt", "r");
                            $i = 0;
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value="' . $result . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo  '>' . $result . '</option>';
                                $i++;
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                    <td>Maximum skill:</td>
                    <td>
                        <select class="textInput" name="maxRank" id="maxRank" onchange="maxRankChanged()">
                            <?php
                            $fn = fopen("Resources\lr6sRanks.txt", "r");
                            $i = 0;
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value="' . $result . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo  '>' . $result . '</option>';
                                $i++;
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Minimum age:</td>
                    <td>
                        <select class="textInput" name="minAge" id="minAge">
                            <?php
                            for ($i = 1; $i <= 100; $i++) {
                                echo '<option value="' . $i . '" ';
                                if ($i === 1) {
                                    echo 'selected="selected" ';
                                }
                                echo '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>Maximum age:</td>
                    <td>
                        <select class="textInput" name="maxAge" id="maxAge" onchange="maxAgeChanged()">
                            <?php
                            for ($i = 1; $i <= 100; $i++) {
                                echo '<option value="' . $i . '" ';
                                if ($i === 100) {
                                    echo 'selected="selected" ';
                                }
                                echo '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Region:
                    </td>
                    <td>
                        <select class="textInput" name="region" id=region>
                            <?php
                            $fn = fopen('Resources\regions.txt', "r");
                            $i = 0;
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value="' . $result . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo  '>' . $result . '</option>';
                                $i++;
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                    <td>
                        Team goal:
                    </td>
                    <td>
                        <select class="textInput" name="goal" id=goal>
                            <option value="any">any</option>
                            <option value="havefun">Have fun</option>
                            <option value="competitive">Play competitive</option>
                            <option value="pro">Become a pro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Language:</td>
                    <td>
                        <select class="textInput" name="language" id=language>
                            <?php
                            $fn = fopen('Resources\languages.txt', "r");
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value=' . $result . '>' . $result . '</option>';
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                    <?php
                    if ($teams) {
                        echo '<td>Team name:</td>';
                        echo '<td><input class="textInput" id="teamName" type="text" name="teamName"></td>';
                    }
                    ?>
                </tr>
            </Table>
        </div>
        <div class="bottom">
            <table>
                <tr>
                    <td class="secondaryColor">Communication:</td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="communication[]" value="discord"> Discord
                    </td>
                    <td>
                        <input type="checkbox" name="communication[]" value="teamspeak"> Team speak
                    </td>
                    <td>
                        <input type="checkbox" name="communication[]" value="ingame"> Ingame
                    </td>
                </tr>
            </table>
        </div>
        <div class="label">
            <table>
                <tr>
                    <td class="secondaryColor">Roles:</td>
                </tr>
                <td>
                    <input type="checkbox" name="roles[]" value="Anchor"> Anchor
                </td>
                <td>
                    <input type="checkbox" name="roles[]" value="Roamer"> Roamer
                </td>
                <td>
                    <input type="checkbox" name="roles[]" value="Support"> Support
                </td>
                <td>
                    <input type="checkbox" name="roles[]" value="Flex"> Flex
                </td>
                </tr>
            </table>
        </div>
        <div id="searchButtons">
            <input class="buttonC" type="submit" name="search" value="Search" />
            <input class="buttonC" type="submit" name="add" value="Add" />
            <input class="buttonC" type="submit" name="*" value="Show All Ad" />
        </div>
    </form>
</div>

<div>
    <?php
    if ($search) {
        $result = searchAd($db, $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName);
    } else {
        $result = getAllAdByGame($db, "r6s");
    }
    if (mysqli_num_rows($result) > 0) {
        while ($ad = mysqli_fetch_array($result)) {
            include('adListItem.php');
        }
    } else {
        echo '<div class="labelC noAdd middleHorizontal secondaryColor">No ad found!</div>';
    }
    ?>
</div>


<script>
    var ranks = [
        "Copper 1",
        "Copper 2",
        "Copper 3",
        "Copper 4",
        "Bronze 1",
        "Bronze 2",
        "Bronze 3",
        "Bronze 4",
        "Silver 1",
        "Silver 2",
        "Silver 3",
        "Silver 4",
        "Gold 1",
        "Gold 2",
        "Gold 3",
        "Gold 4",
        "Platinum 1",
        "Platinum 2",
        "Platinum 3",
        "Diamond"
    ];

    var perviousRankSelectedIndex = ranks.length;
    var perviousAgeSelectedIndex = document.getElementById("maxAge").options.length;

    function maxRankChanged() {
        var maxRank = document.getElementById("maxRank");
        var minRank = document.getElementById("minRank");
        var i;

        if (perviousRankSelectedIndex < maxRank.selectedIndex) {
            //add items
            //https://www.w3schools.com/jsref/coll_select_options.asp
            for (i = minRank.options.length; i <= maxRank.selectedIndex; i++) {
                var cRank = new Option(ranks[i], ranks[i]);
                minRank.options.add(cRank, i);
            }
        } else {
            //remove items
            var length = minRank.options.length;
            for (i = maxRank.selectedIndex + 1; i < length; i++) {
                minRank.options[maxRank.selectedIndex + 1].remove();
            }
        }
        perviousRankSelectedIndex = maxRank.selectedIndex;
    }

    function maxAgeChanged() {
        var maxAge = document.getElementById("maxAge");
        var minAge = document.getElementById("minAge");
        var i;

        if (perviousAgeSelectedIndex < maxAge.selectedIndex) {
            //add items
            //https://www.w3schools.com/jsref/coll_select_options.asp
            for (i = minAge.options.length; i <= maxAge.selectedIndex; i++) {
                var cAge = new Option(i + 1, i + 1);
                minAge.options.add(cAge, i);
            }
        } else {
            //remove items
            var length = minAge.options.length;
            for (i = maxAge.selectedIndex + 1; i < length; i++) {
                minAge.options[maxAge.selectedIndex + 1].remove();
            }
        }
        perviousAgeSelectedIndex = maxAge.selectedIndex;
    }
</script>