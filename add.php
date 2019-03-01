<?php
  include('config/db_connect.php');

  $email = ''; 
  $title = ''; 
  $ingredients = '';
  $errors = array('email' => '', 'title' => '', 'ingredients' => '', 'form' => '');

  if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
      $errors['email'] = 'An email is required';
    } else {
      $email = $_POST['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email must be a valid email address';
      }
    }
    if (empty($_POST['title'])) {
      $errors['title'] = 'An title is required';
    } else {
      $title = $_POST['title'];
      if (!preg_match('/^[a-zA-z\s]+$/', $title)) {
        $errors['title'] = 'title must be letters and spaces only';
      }
    }
    if (empty($_POST['ingredients'])) {
      $errors['ingredients'] = 'At least one ingredient is required';
    } else {
      $ingredients = $_POST['ingredients'];
      if (!preg_match('/^([a-zA-z\s]+)(,\s*[[a-zA-z]*)*$/', $ingredients)) {
        $errors['ingredients'] = 'Ingredients must be separated by commas';
      }
    }
    if (array_filter($errors)) {
    } else {
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $title = mysqli_real_escape_string($connection, $_POST['title']);
      $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
      $sql = "INSERT INTO pizza (email, title, ingredients) VALUES ('$email', '$title', '$ingredients')";
  
      if (mysqli_query($connection, $sql)) {
        header('Location: index.php');
      } else {
        echo 'query error:' . mysqli_error($connection);
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<main>
  <section class="container grey-text">
    <h5 class="center">ADD A PIZZA!</h5>
    <div class="error-message center">
            <?php echo $errors['form']; ?>
        </div>
    <div class="card">
      <form
        action="add.php"
        method="POST"
      >
      <div>
        <label for="email">Your email:</label>
        <div class="error-message">
            <?php echo $errors['email']; ?>
        </div>
        <input 
          type="text" 
          title="email"
          value="<?php echo htmlspecialchars($email) ?>"
        >
      </div>
      <div>
        <label for="pizza title">Pizza title:</label>
        <div class="error-message">
            <?php echo $errors['title']; ?>
        </div>
        <input 
          type="text" 
          title="title"
          value="<?php echo htmlspecialchars($title) ?>"
        >
      </div>
      <div>
        <label for="ingredients">Ingredients (comma separated):</label>
        <div class="error-message">
            <?php echo $errors['ingredients']; ?>
        </div>
        <input 
          type="text" 
          title="ingredients"
          value="<?php echo htmlspecialchars($ingredients) ?>"
        >
      </div>
        <div class="center">
          <input 
            type="submit" 
            title="submit" 
            value="submit" 
            class="btn brand submit z-depth-0"
          >
        </div>
      </form>
    </div>
  </section>
</main>
<?php include('templates/footer.php'); ?>
</html>
