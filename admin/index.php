<?php require_once("../admin/includes/header.php"); ?>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Welcome to your dashboard</span>
            <p>This is where you manage products, customers, orders, blogpost etc.</p>
            <p>If you are new to the system, you can take a quick tour to get an overview?</p>
          </div>
          <div class="card-action">
            <a href="#">Take tour</a>
            <a href="#">Dismiss for now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Latest orders</span>
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
                <tr>
                  <td>March 6th 2018 @ 11.30.24</td>
                  <td>Donald Duck</td>
                  <td>Duckroad 1, Ducktown</td>
                  <td>$99.00</td>
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
                  <td>$120.00</td>
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
                  <td>$989.00</td>
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
              </tbody>
            </table>
          </div>
          <div class="card-action">
            <a href="manage-orders.php">All orders</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once("../admin/includes/footer.php"); ?>
