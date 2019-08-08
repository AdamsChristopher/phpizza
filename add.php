<?php
include('config/db_connect.php');

$email = $title = $ingredients = '';
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
        if (!preg_match('/^[\w\'\s]+$/', $title)) {
            $errors['title'] = 'title must be letters and spaces only';
        }
    }
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'At least one ingredient is required';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([\w\s]+)(,\s*[[\w]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ingredients must be separated by commas';
        }
    }
    if (array_filter($errors)) {
    } else {
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
        $sql = "INSERT INTO pizza (email, title, ingredients)
                VALUES ('$email', '$title', '$ingredients')";

        if (mysqli_query($connection, $sql)) {
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<main>
    <section class="container">
        <h3 class="text-center m-3">ADD A PIZZA!</h3>
        <div class="error-message">
            <?php echo $errors['form']; ?>
        </div>
        <div class="card">
            <form
                    class="form-group"
                    action="add.php"
                    method="POST"
            >
                <div>
                    <label for="email">Your email:</label>
                    <div class="error-message">
                        <?php echo $errors['email']; ?>
                    </div>
                    <label>
                        <input
                                class="form-control mb-2"
                                type="text"
                                title="email"
                                name="email"
                                value="<?php echo htmlspecialchars($email) ?>"
                        >
                    </label>
                </div>
                <div>
                    <label for="pizza title">Pizza title:</label>
                    <div class="error-message">
                        <?php echo $errors['title']; ?>
                    </div>
                    <label>
                        <input
                                class="form-control mb-2"
                                type="text"
                                title="title"
                                name="title"
                                value="<?php echo htmlspecialchars($title) ?>"
                        >
                    </label>
                </div>
                <div>
                    <label for="ingredients">Ingredients (comma separated):</label>
                    <div class="error-message">
                        <?php echo $errors['ingredients']; ?>
                    </div>
                    <label>
                        <input
                                class="form-control mb-2"
                                type="text"
                                title="ingredients"
                                name="ingredients"
                                value="<?php echo htmlspecialchars($ingredients) ?>"
                        >
                    </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input
                            class="btn brand submit mt-3"
                            type="submit"
                            title="submit"
                            name="submit"
                            value="submit"
                    >
                </div>
            </form>
        </div>
    </section>
</main>
<?php include('templates/footer.php'); ?>
</html>
