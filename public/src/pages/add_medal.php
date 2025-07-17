<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/idiorm_init.php';

$countries = ORM::forTable('countries')->findArray();
$sportTypes = ORM::forTable('sport_types')->findArray();
$sportsmans = ORM::forTable('sportsmans')->findArray();
?>

<form class="w-100" method="post" action="/src/scripts/medals/create_medal.php">
    <div class="main-container  d-flex flex-row justify-content-between align-items-center mt-3">
        <div>
            <p>Тип медали</p>
            <select class="form-select" name="type">
                <option value="gold">Золото</option>
                <option value="silver">Серебро</option>
                <option value="bronze">Бронза</option>
            </select>
        </div>

        <div>
            <p>Страна</p>
            <select class="form-select" name="country_id" required>
                <?php foreach ($countries as $country): ?>
                    <option value="<?= $country['id'] ?>">
                        <?= strip_tags($country['name'], ['<b><i><p><strong>'])?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <p>Вид спорта</p>
            <select class="form-select" name="sport_type_id" required>
                <?php foreach ($sportTypes as $sportType): ?>
                    <option value="<?= $sportType['id'] ?>">
                        <?= strip_tags($sportType['name'], ['<b><i><p><strong>']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <p>Спортсмен</p>
            <select class="form-select" name="sportsmans_id[]" multiple required>
                <?php foreach ($sportsmans as $sportsman): ?>
                    <option value="<?= $sportsman['id'] ?>">
                        <?= strip_tags($sportsman['name'], ['<b><i><p><strong>']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-outline-success mt-2 w-25">Добавить</button>
    </div>
</form>

<?php
require_once __DIR__ . '/../scripts/footer.php';
?>