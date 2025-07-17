<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/init_models.php';
?>

<div class="main-container d-flex flex-column justify-content-center align-items-center">
    <div class="input-group mt-3 ">
        <form class="w-100" method="post" action="/src/scripts/sportsmans/create_sportsman.php">
            <input class="form-control" type="text" name="name" placeholder="Введите ФИО">
            <button type="submit" class="btn btn-outline-success mt-2 w-100">Добавить</button>
        </form>
    </div>

    <table class="table table mt-3">
        <thead>
            <tr>
                <th scope="col table">ФИО</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sportsmans->all() as $sportsman): ?>
                <tr>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p><?= htmlspecialchars($sportsman['name']) ?></p>
                            <form method="post" action="/src/scripts/sportsmans/delete_sportsman.php">
                                <input type="hidden" name="id" value="<?= $sportsman['id'] ?>">
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