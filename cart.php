<?php require_once('includes/header.php') ?>

<div class="container">
  <h1>Cart</h1>
  <div class="row">
    <div class="col s12 m12">
      <div class="card horizontal">
        <div class="card-image">
          <img src="http://via.placeholder.com/200x200">
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <div class="left">
              <h5>Product item card.</h5>
              <p>Product info.</p>
            </div>
            <div class="right">
              <div class="input-field inline">
                <input id="quantity" type="number" value="1">
                <label for="quantity">Quantity</label>
              </div>
              <div class="right edit_amount_margin">
                <a class="btn-floating btn-small waves-effect waves-light teal"><i class="material-icons">expand_less</i></a>
                <div class="clear padding-round-buttons"></div>
                <a class="btn-floating btn-small waves-effect waves-light teal"><i class="material-icons">expand_more</i></a>
              </div>
            </div>
          </div>
          <div class="card-action">
            <a href="#" class="remove_from_cart">Remove from cart</a>
            <p class="price right">$99.95</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Card Title</span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">Go to Duckout</a>
              <p class="price right">Total price: $99.95</p>
            </div>
          </div>
        </div>
      </div>
</div>

<?php require_once('includes/footer.php') ?>
