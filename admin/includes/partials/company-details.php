<div class="row">
  <div class="input-field col s6">
    <input id="ShopName" type="text" name="ShopName" class="validate" <?php if(isset($info["ShopName"])) echo "value='" . $info["ShopName"] . "'"; ?>>
    <label for="ShopName">Shopname</label>
  </div>
  <div class="input-field col s6">
    <input id="CVR" type="number" name="CVR" class="validate" <?php if(isset($info["CVR"])) echo "value='" . $info["CVR"] . "'"; ?>>
    <label for="CVR">CVR</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <textarea id="AboutUsText" name="AboutUsText" class="materialize-textarea"><?php if(isset($info["AboutUsText"])) echo $info["AboutUsText"]; ?></textarea>
    <label for="AboutUsText">About us text</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s6">
    <input id="Email" type="Email" name="Email" class="validate" <?php if(isset($info["Email"])) echo "value='" . $info["Email"] . "'"; ?>>
    <label for="Email">Email</label>
  </div>
  <div class="input-field col s6">
    <input id="Phone" type="number" name="Phone" class="validate" <?php if(isset($info["Phone"])) echo "value='" . $info["Phone"] . "'"; ?>>
    <label for="Phone">Phone</label>
  </div>
</div>
<div class="row">
  <div class="file-field input-field">
      <p>Upload logo</p>
      <div class="btn">
        <span>Upload</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" name="LogoURL" type="text" <?php if(isset($info["LogoURL"])) echo "value='" . $info["LogoURL"] . "'"; ?>>
      </div>
    </div>
</div>
<div class="row">
  <div class="input-field col s6">
    <input id="Street" type="text" name="Street" class="validate" <?php if(isset($info["Street"])) echo "value='" . $info["Street"] . "'"; ?>>
    <label for="Street">Street</label>
  </div>
  <div class="input-field col s6">
    <input id="HouseNumber" type="text" name="HouseNumber" class="validate" <?php if(isset($info["HouseNumber"])) echo "value='" . $info["HouseNumber"] . "'"; ?>>
    <label for="HouseNumber">Housenumber</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s6">
    <input id="ZipCode" type="number" name="ZipCode" onchange="getCity(this.value)" class="validate" <?php if(isset($info["ZipCode"])) echo "value='" . $info["ZipCode"] . "'"; ?> onload="getCity(this.value)">
    <label for="ZipCode">Zipcode</label>
  </div>
  <div class="input-field col s6">
    <?php
      $city = $BasicPageInfo->getCity($info["ZipCode"]);
    ?>
    <input id="City" type="text" name="City" class="validate cityTxt" disabled <?php if(isset($city)) echo "value='" . $city . "'"; ?>>
    <label for="City">City</label>
  </div>
</div>
