<div class="row">
  <form action="products.php" method="get">
    <div class="input-field col s12 m3">
      <select name="cat" id="select_id">
        <option value="0" selected>All Categories</option>
        <?php
        $categories = getCategories();
        while ($row = mysqli_fetch_array($categories)) {
          if ($_GET["cat"] == $row["ProductCategoryID"]) {
            echo "<option selected value='". $row["ProductCategoryID"] ."'>". $row["CategoryName"] . "</option>";
          } else {
        echo "<option  value='". $row["ProductCategoryID"] ."'>". $row["CategoryName"] . "</option>";
          }
        } ?>
      </select>
    </div>
    <div class="col s12 m4">
      <div class="input-field col s6">
        <?php
          if(isset($_GET["minPrice"])) {
            if($_GET["minPrice"] != 0) {
              echo "<input value='". $_GET["minPrice"]."' name='minPrice' id='minPrice' type='number' class='validate'>";
            } else {
              echo "<input name='minPrice' id='minPrice' type='number' class='validate'>";
            }
          } else {
            echo "<input name='minPrice' id='minPrice' type='number' class='validate'>";
          } ?>
        <label class="active" for="minPrice2">Min. Price</label>
      </div>
      <div class="input-field col s6">
        <?php
          if(isset($_GET["maxPrice"])) {
            if($_GET["maxPrice"] != 0) {
              echo "<input value='". $_GET["maxPrice"] ."' name='maxPrice' id='maxPrice' type='number' class='validate'>";
            } else {
              echo "<input name='maxPrice' id='maxPrice' type='number' class='validate'>";
            }
          } else {
            echo "<input name='maxPrice' id='maxPrice' type='number' class='validate'>";
          } ?>
        <label class="active" for="maxPrice2">Max Price</label>
      </div>
    </div>
    <div class="input-field col s12 m3">
      <select name="order" id="select_id2">
        <?php
          $sorting = array(
            array("none", "Sort by"),
            array("DESC", "Desc. Price"),
            array("ASC", "Asc. Price"),
            array("REV", "***Reviews"),
            array("POP", "***Popularity")
          );
          for ($row = 0; $row < 5; $row++) {
            if (isset($_GET["order"])) {
              if ($_GET["order"] == $sorting[$row][0]) {
                echo "<option selected value=" . $sorting[$row][0] . ">" . $sorting[$row][1] . "</option>";
              } else {
                echo "<option value=" . $sorting[$row][0] . ">" . $sorting[$row][1] . "</option>";
              }
            } else {
              echo "<option value=" . $sorting[$row][0] . ">" . $sorting[$row][1] . "</option>";
            }
          } ?>
      </select>
    </div>
    <input type="submit" class="waves-effect waves-light btn" value="Filter">
  </form>
</div>
