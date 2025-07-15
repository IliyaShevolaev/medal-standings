<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/init_models.php';
?>

<form class="w-100" method="post" action="/src/scripts/medals/create_medal.php">
    <div class="d-flex flex-row justify-content-between align-items-center mt-3"
        style="padding-left: 25rem; padding-right: 25rem;">
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
                <?php foreach ($countries->all() as $country): ?>
                    <option value="<?= $country['id'] ?>">
                        <?= $country['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <p>Вид спорта</p>
            <select class="form-select" name="sport_type_id" required>
                <?php foreach ($sportTypes->all() as $sportType): ?>
                    <option value="<?= $sportType['id'] ?>">
                        <?= $sportType['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <p>Спортсмен</p>
            <select class="form-select" name="sportsmans_id[]" multiple required>
                <?php foreach ($sportsmans->all() as $sportsman): ?>
                    <option value="<?= $sportsman['id'] ?>">
                        <?= $sportsman['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-outline-success mt-2 w-25">Добавить</button>
    </div>
</form>