<?php
  $reviewclass = New Review();
  $reviews = $reviewclass->getReviews();
?>
<span class="card-title">Manage reviews</span>
<table class="striped">
  <thead>
    <tr>
        <th>Review Date</th>
        <th>Review Name</th>
        <th>Title</th>
        <th>Content</th>
        <th>Rating (0-5)</th>
        <th class="right">Delete</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($reviews as $review): ?>
    <tr>
      <td><?php echo $review["ReviewDate"]; ?></td>
      <td><?php echo $review["ReviewName"]; ?></td>
      <td><?php echo $review["ReviewTitle"]; ?></td>
      <td><?php echo $review["ReviewContent"]; ?></td>
      <td><?php echo $review["Rating"]; ?></td>
      <td><form action="manage-settings.php?removereview=<?php echo $review["ReviewID"]; ?>" method="post" onsubmit="return confirm('Are you sure?');"><input class="waves-effect waves-light btn grey darken-4 black right" type="submit" name="submitdeletereview" value="Delete"></form></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal Structure -->
<div id="newShipping" class="modal medium">
  <div class="modal-content">
    <div class="formContainer">
      <h4>Add new shipping method</h4>
      <form method="post">
        <div class="input-field col s12">
          <input id="Method" name="Method" type="text" class="validate">
          <label for="Method">Method name</label>
        </div>
        <div class="input-field col s12">
          <input id="MethodDescription" name="MethodDescription" type="text" class="validate">
          <label for="MethodDescription">Method description</label>
        </div>
        <div class="input-field col s12">
          <input id="DeliveryPrice" name="DeliveryPrice" type="number" class="validate">
          <label for="DeliveryPrice">Delivery Price</label>
        </div>
        <div class="input-field col s12">
          <input name="saveNewShipping" type="submit" value="Save" class="waves-effect waves-light btn grey darken-4 btn right">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Structure -->
<div id="editShipping" class="modal medium">
  <div class="modal-content">
    <div class="formContainer">
      <h4>Edit shipping method</h4>
      <form method="post">
        <div class="input-field col s12">
          <input id="Method" name="Method" type="text" class="Method validate">
        </div>
        <div class="input-field col s12">
          <input id="MethodDescription" name="MethodDescription" type="text" class="MethodDescription validate">
        </div>
        <div class="input-field col s12">
          <input id="DeliveryPrice" name="DeliveryPrice" type="number" class="DeliveryPrice validate">
        </div>
        <div class="input-field col s12">
          <input type="hidden" name="shippingID" class="shippingID">
          <input name="updateShipping" type="submit" value="Save" class="waves-effect waves-light btn grey darken-4 btn right">
          <input name="deleteShipping" type="submit" value="Delete" class="waves-effect waves-light btn grey darken-4 btn right">
        </div>
      </form>
    </div>
  </div>
</div>
