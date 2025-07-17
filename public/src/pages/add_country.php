<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/init_models.php';
?>

<div class="main-container d-flex flex-column justify-content-center align-items-center">
    <div class="input-group mt-3 ">
        <form class="w-100" method="post" action="/src/scripts/countries/create_country.php">
            <input class="form-control" type="text" name="name" placeholder="Название страны">
            <button type="submit" class="btn btn-outline-success mt-2 w-100">Добавить</button>
        </form>
    </div>

    <table class="table table mt-3">
        <thead>
            <tr>
                <th scope="col table">Страна</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countries->all() as $country): ?>
                <tr>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p><?= htmlspecialchars($country['name']) ?></p>
                            <form method="post" action="/src/scripts/countries/delete_country.php">
                                <input type="hidden" name="id" value="<?= $country['id'] ?>">
                                <button type="submit" class="btn btn-outline-danger">X</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . '/../scripts/footer.php';
?>