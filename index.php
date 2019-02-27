<?php
  $connection = mysqli_connect('localhost', 'user', '1234', 'phpizza');

  if (!$connection) {
    echo 'Connection error: ' . mysqli_connect_error();
  }

  $sql = 'SELECT title, ingredients, id FROM pizza ORDER BY created_at';
  $results = mysqli_query($connection, $sql);
  $pizzas = mysqli_fetch_all($results, MYSQLI_ASSOC);
  mysqli_free_result($results);
  mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/header.php'); ?>
  <h4 class="center grey-text">PIZZAS!</h4>
  <div class="container">
    <div class="row">
      <?php foreach ($pizzas as $pizza) { ?>
          <div class="col s12 md3 l4">
            <div class="card">
              <div class="card-content center">
                <h5 id="pizza-title"><?php echo htmlspecialchars(strtoupper($pizza['title'])) ?></h5>
                <i class="fas fa-pizza-slice fa-10x"></i>
                <h6 id="ingredients-title">Ingredients:</h6>
                <div>
                  <ul id="ingredients-list">
                    <?php foreach (explode(',', $pizza['ingredients']) as $ingredient) { ?>
                      <li><?php echo htmlspecialchars(ucwords($ingredient)) ?></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="card-action center-align">
                <a
                href="#"
                class="btn brand z-depth-0"
                >
                 More info
                </a>
              </div>
            </div>
          </div>
      <?php  } ?>
    </div>
  </div>
  <?php include('templates/footer.php'); ?>
<body>
</body>
</html>
