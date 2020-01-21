<?php if (!defined("APP_VERSION")) {
  exit;
} ?>
<div>
  <table id="homeTable">
    <tr id="homeTr">
      <td>
        <div id="homeCSGO" class="shadow-pop-csgo"><a id="homeCSGOA" href="<?php echo route(['page' => 'csgo']); ?>">Counter Strike: Global Offensive</a></div>
      </td>
      <td>
        <div id="homeLol" class="shadow-pop-lol"><a id="homeLolA" href="<?php echo route(['page' => 'lol']); ?>">League Of Legends</a></div>
      </td>
      <td>
        <div id="homeR6s" class="shadow-pop-r6s"><a id="homeR6sA" href="<?php echo route(['page' => 'r6s']); ?>">Rainbow Six Siege</a></div>
      </td>
	  <td>
        <div id="homeOW" class="shadow-pop-ow"><a id="homeOwA" href="<?php echo route(['page' => 'ow']); ?>">Overwatch</a></div>
      </td>
    </tr>
    <table>
</div>