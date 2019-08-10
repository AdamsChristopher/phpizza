<?php
include('config/db_connect.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $sql = "SELECT * FROM pizza
            WHERE id = $id";

    $results = mysqli_query($connection, $sql);
    $pizza = mysqli_fetch_assoc($results);

    mysqli_free_result($results);
    mysqli_close($connection);
}

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($connection, $_POST['id_to_delete']);
    $sql = "DELETE FROM pizza
            WHERE id = $id_to_delete";

    if (mysqli_query($connection, $sql)) {
        header('Location: index.php');
    } else {
        echo 'query error: ' . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<main>
    <section class="container">
        <div class="card">
            <i
                id="pizza-picture"
                class="fas fa-pizza-slice fa-10x text-center"
            >
            </i>
            <div class="card-content text-center">
                <?php if ($pizza) { ?>
                <h5
                    id="pizza-title"
                    class="mb-3"
                >
                    <?php echo htmlspecialchars(strtoupper($pizza['title'])); ?>
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
                <div id="pizza-details">
                    <p><?php echo "Created by {$pizza['email']}"; ?></p>
                    <p><?php echo $pizza['created_at']; ?></p>
                </div>
            </div>
            <div class="text-center">
                <form
                    action="info.php"
                    method="POST"
                >
                    <input
                        type="hidden"
                        name="id_to_delete"
                        value="<?php echo $pizza['id']; ?>"
                    >
                    <input
                        class="btn brand"
                        type="submit"
                        name="delete"
                        value="Delete"
                    >
                </form>
            </div>
        </div>
        <?php } else { ?>
            <h5>404 Not Found.</h5>
        <?php } ?>
    </section>
</main>
<?php include('templates/footer.php'); ?>
</html>
