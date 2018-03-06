<?php require_once("../admin/includes/header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Products</span>
          <table class="responsive-table">
            <thead>
              <tr>
                  <th>Name</th>
                  <th>Itemnumber</th>
                  <th>Price</th>
                  <th>Sale price</th>
                  <th>Created</th>
                  <th>Status</th>
              </tr>
            </thead>
            <?php // TODO: Ændre farve på select felter ?>
            <tbody>
              <?php

                $i = 1;

                while($i <= 5) {
                    ?>
                    <tr>
                      <td>Yellow Duck Ranger</td>
                      <td>y1187</td>
                      <td>99.00 DKK</td>
                      <td>-</td>
                      <td>March 6th 2018 @ 11.30.24</td>
                      <td>
                        <div class="input-field">
                          <select>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Big Black Duck</td>
                      <td>bbd12</td>
                      <td>119.00 DKK</td>
                      <td>99.00</td>
                      <td>March 6th 2018 @ 11.30.24</td>
                      <td>
                        <div class="input-field">
                          <select>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>SuperDuck</td>
                      <td>sd1234</td>
                      <td>119.00 DKK</td>
                      <td>99.00</td>
                      <td>March 6th 2018 @ 11.30.24</td>
                      <td>
                        <div class="input-field">
                          <select>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <?php
                    $i++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
