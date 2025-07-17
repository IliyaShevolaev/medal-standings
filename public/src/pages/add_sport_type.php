<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/idiorm_init.php';

$sportTypes = ORM::forTable('sport_types')->findArray();
?>

<div class="main-container d-flex flex-column justify-content-center align-items-center">
    <div class="input-group mt-3 ">
        <form class="w-100" method="post" action="/src/scripts/sport_types/create_sport_type.php">
            <input class="form-control" type="text" name="name" placeholder="Название вида спорта">
            <button type="submit" class="btn btn-outline-success mt-2 w-100">Добавить</button>
        </form>
    </div>

    <table class="table table mt-3">
        <thead>
            <tr>
                <th scope="col table">Вид спорта</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sportTypes as $sportType): ?>
                <tr>
                    <td>
                        <div class="d-flex justify-content-between">
                        <p><?= strip_tags($sportType['name'], ['<b><i><p><strong>']) ?></p>
                            <form method="post" action="/src/scripts/sport_types/delete_sport_type.php">
                                <input type="hidden" name="id" value="<?= $sportType['id'] ?>">
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