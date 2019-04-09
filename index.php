<?php
  include('config/db_connect.php');
  
  $sql = 'SELECT title, ingredients, id FROM pizza ORDER BY created_at';
  $results = mysqli_query($connection, $sql);
  $pizzas = mysqli_fetch_all($results, MYSQLI_ASSOC);

  mysqli_free_result($results);
  mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/header.php'); ?>
  <main> 
    <section class="container">
      <h3 class="text-center m-3">PIZZAS!</h3>
      <div class="row">
        <?php foreach ($pizzas as $pizza) { ?>
            <div class="col-12 col-md-4 col-lg-3">
              <div class="card">
                  <i 
                    id="pizza-picture"
                    class="fas fa-pizza-slice fa-10x text-center"
                  >
                  </i>
                <div class="card-content text-center">
                  <h5 
                    id="pizza-title"
                    class="mb-3"
                  >
                    <?php echo htmlspecialchars(strtoupper($pizza['title'])) ?>
                  </h5>
                  <h6 id="ingredients-title">Ingredients:</h6>
                  <div class="text-center">
                    <ul
                      id="ingredients-list"
                      class="px-0"
                    >
                      <?php foreach (explode(',', $pizza['ingredients']) as $ingredient) { ?>
                        <li><?php echo htmlspecialchars(ucwords($ingredient)) ?></li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <div class="mx-auto">
                  <a
                  href="info.php?id=<?php echo $pizza['id']; ?>"
                  class="btn brand"
                  >
                    More info
                  </a>
                </div>
              </div>
            </div>
         <?php } ?>
      </div>
    </section>
  </main> 
  <?php include('templates/footer.php'); ?>
</html>
