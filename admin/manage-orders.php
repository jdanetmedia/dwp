<?php require_once("../admin/includes/header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">All orders</span>
          <table class="responsive-table">
            <thead>
              <tr>
                  <th>Order date</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Order amount</th>
                  <th>Details</th>
                  <th>Change order status</th>
              </tr>
            </thead>
            <?php // TODO: Ændre farve på select felter ?>
            <tbody>
              <?php
                $i = 1;
                while($i <= 5) {
                  ?>
                  <tr>
                    <td>March 6th 2018 @ 11.30.24</td>
                    <td>Donald Duck</td>
                    <td>Duckroad 1, Ducktown</td>
                    <td>99.00 DKK</td>
                    <td>
                      <a href="#">View details</a>
                    </td>
                    <td>
                      <div class="input-field">
                        <select>
                          <option value="1">Awaiting</option>
                          <option value="2">In progress</option>
                          <option value="3">Sent</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>March 6th 2018 @ 11.30.24</td>
                    <td>Duckling Duck</td>
                    <td>Duckstreet 3456, Ducktown</td>
                    <td>120.00 DKK</td>
                    <td>
                      <a href="#">View details</a>
                    </td>
                    <td>
                      <div class="input-field">
                        <select>
                          <option value="1">Awaiting</option>
                          <option value="2">In progress</option>
                          <option value="3">Sent</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>March 6th 2018 @ 11.30.24</td>
                    <td>Duckwin Duck</td>
                    <td>Docktown mainstreet 12, Ducktown Center</td>
                    <td>989.00 DKK</td>
                    <td>
                      <a href="#">View details</a>
                    </td>
                    <td>
                      <div class="input-field">
                        <select>
                          <option value="1">Awaiting</option>
                          <option value="2">In progress</option>
                          <option value="3">Sent</option>
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
