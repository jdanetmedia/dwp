<?php

$hours = $BasicPageInfo->getHours();

?>
<span class="card-title">Opening hours<a class="waves-effect waves-light btn grey darken-4 new-prod-btn btn modal-trigger" href="#newHours">Add new</a></span>
<table class="striped">
  <thead>
    <tr>
        <th>Day</th>
        <th>Open</th>
        <th>Close</th>
        <th>Edit</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($hours as $hour): ?>
    <tr>
      <td class="day"><?php echo $hour["Day"]; ?></td>
      <td class="open"><?php echo $hour["Open"]; ?></td>
      <td class="close"><?php echo $hour["Close"]; ?></td>
      <td id="<?php echo $hour["HoursID"]; ?>" class="edit-hours"><a href="#editHours" class="modal-trigger">Edit</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal Structure -->
<div id="newHours" class="modal medium">
  <div class="modal-content">
    <div class="formContainer">
      <h4>Add new opening hours</h4>
      <form action"manage-settings.php" method="post">
        <div class="input-field col s12">
          <input id="Day" name="Day" type="text" class="validate">
          <label for="Day">Day</label>
        </div>
        <div class="input-field col s12">
          <input id="Open" name="Open" type="text" class="validate">
          <label for="Open">Open</label>
        </div>
        <div class="input-field col s12">
          <input id="Close" name="Close" type="text" class="validate">
          <label for="Close">Close</label>
        </div>
        <div class="input-field col s12">
          <input name="saveNewHours" type="submit" value="Save" class="waves-effect waves-light btn grey darken-4 btn right">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Structure -->
<div id="editHours" class="modal medium">
  <div class="modal-content">
    <div class="formContainer">
      <h4>Edit opening hours</h4>
      <form method="post">
        <div class="input-field col s12">
          <input id="Day" name="Day" type="text" class="Day validate">
        </div>
        <div class="input-field col s12">
          <input id="Open" name="Open" type="text" class="Open validate">
        </div>
        <div class="input-field col s12">
          <input id="Close" name="Close" type="text" class="Close validate">
        </div>
        <div class="input-field col s12">
          <input type="hidden" name="hoursID" class="hoursID">
          <input name="updateHours" type="submit" value="Save" class="waves-effect waves-light btn grey darken-4 btn right">
          <input name="deleteHours" type="submit" value="Delete" class="waves-effect waves-light btn grey darken-4 btn right">
        </div>
      </form>
    </div>
  </div>
</div>
