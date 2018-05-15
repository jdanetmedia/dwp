<?php

  $settings = New Settings();
  $shippingMethods = $settings->getShippingMethods();
?>
<span class="card-title">Shipping methods<a class="waves-effect waves-light btn grey darken-4 new-prod-btn btn modal-trigger" href="#newShipping">Add new</a></span>
<table class="striped">
  <thead>
    <tr>
        <th>Method name</th>
        <th>Method description</th>
        <th>Delivery price</th>
        <th>Edit</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($shippingMethods as $shippingMethod): ?>
    <tr>
      <td class="method"><?php echo $shippingMethod["Method"]; ?></td>
      <td class="description"><?php echo $shippingMethod["MethodDescription"]; ?></td>
      <td class="priceRow"><?php echo $shippingMethod["DeliveryPrice"]; ?></td>
      <td id="<?php echo $shippingMethod["DeliveryMethodID"]; ?>" class="edit"><a href="#editShipping" class="modal-trigger">Edit</a></td>
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
