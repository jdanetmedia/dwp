<?php require_once('includes/header.php'); ?>
<div class="container">
  <div class="row">
    <form class="col s12 m12" action="shipping.php">
      <h5>Shipping information</h5>
      <div class="row col s12 m6">
        <div class="row col s12 m12">
          <div class="input-field col s12">
            <input id="first_name" type="text" class="validate">
            <label for="first_name">Streetname</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="number" class="validate">
            <label for="last_name">Housenumber</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="number" class="validate">
            <label for="last_name">Apartmentnumber</label>
          </div>
        </div>
        <div class="row col s12 m12">
          <div class="input-field col s6">
            <input id="first_name" type="number" class="validate">
            <label for="first_name">Zipcode</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="text" class="validate">
            <label for="last_name">City</label>
          </div>
        </div>
        <p>
          <input type="checkbox" class="filled-in" id="filled-in-box" />
          <label for="filled-in-box">Set this address as your new address?</label>
        </p>
      </div>

      <div class="row col s6 m6">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">
                <input name="group1" type="radio" id="test1" />
                <label for="test1">Shipping to postoffice</label>
              </span>
              <p>Description of shipping option 1</p>
            </div>
          </div>
        </div>
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">
                <input name="group1" type="radio" id="test2" />
                <label for="test2">Shipping to home address + 5$</label>
              </span>
              <p>Description of shipping option 2</p>
            </div>
          </div>
        </div>
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">
                <input name="group1" type="radio" id="test3" />
                <label for="test3">Express shipping + 10$</label>
              </span>
              <p>Description of shipping option 3</p>
            </div>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <input class="waves-effect waves-light btn" type="submit" name="create" value="Go to payment">
    </form>
  </div>
</div>
<?php require_once('includes/footer.php'); ?>
