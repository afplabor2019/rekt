<?php if (!defined("APP_VERSION")) {
    exit;
} ?>

<?php
$search = false;
$result;

if (is_post()) {
    $game = trim('csgo');
    $rank = trim($_POST['minRank']) . '-' . trim($_POST['maxRank']);
    $lookingFor = trim('player');
    $age = trim($_POST['minAge']) . '-' . trim($_POST['maxAge']);
    $region = trim($_POST['region']);
    $roles = '';
    $goal = trim($_POST['goal']);
    $advertiserID = current_user($db)['id'];
    $language = trim($_POST['language']);
    $communication = "";
    $teamName = "";

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
        $search = true;
    } else if (isset($_POST['add'])) {
        // add
        $search=true;
        gate();
        addAd($db, $game, $rank, $lookingFor, $age, $region, $roles, $goal, $advertiserID, $language, $communication, $teamName);
    }
}
?>

<div class="label">
    <form action="<?php echo route(['page' => 'csgo']); ?>" method="POST" enctype="multipart/form-data">
        <div class="label">
            <Table>
                <tr>
                    <td>Minimum skill:</td>
                    <td>
                        <select name="minRank" id="minRank">
                            <?php
                            $fn = fopen("Resources\csgoRanks.txt", "r");
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
                        <select name="maxRank" id="maxRank">
                            <?php
                            $fn = fopen("Resources\csgoRanks.txt", "r");
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
                        <select name="minAge" id="minAge">
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
                        <select name="maxAge" id="maxAge">
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
                        <select name="region" id=region>
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
                        <select name="goal" id=goal>
                            <option value="any">any</option>
                            <option value="havefun">Have fun</option>
                            <option value="competitive">Play competitive</option>
                            <option value="pro">Become a pro</option>
                        </select>
                    </td>
                </tr>
            </Table>
        </div>
        <div class="label">
            <table>
                <tr>
                    <td>Language:</td>
                    <td>
                        <select name="language" id=language>
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
                    </td>
                </tr>
                <tr>
                    <td>Communication:</td>
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
                <th>Roles</th>
                <tr>
                    <td>
                        <input type="checkbox" name="roles[]" value="entry"> Entry fragger
                    </td>
                    <td>
                        <input type="checkbox" name="roles[]" value="strategy"> Strategy caller
                    </td>
                    <td>
                        <input type="checkbox" name="roles[]" value="refragger"> Refragger
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="roles[]" value="lurker"> Lurker
                    </td>
                    <td>
                        <input type="checkbox" name="roles[]" value="awper"> AWPer
                    </td>
                </tr>
            </table>
        </div>
        <input type="submit" name="search" value="Search" />
        <input type="submit" name="add" value="Add" />
    </form>
</div>

<div>
    <?php
    if ($search) {
        
    }
    else{
        $result = getAllAd($db);
    }
    while ($ad = mysqli_fetch_array($result)) {
        include('adListItem.php');
    }
    ?>
</div>