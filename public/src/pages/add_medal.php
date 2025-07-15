<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/init_models.php';
?>

<div class="d-flex flex-row justify-content-between align-items-center mt-3"
    style="padding-left: 25rem; padding-right: 25rem;">
    <div>
        <p>Тип медали</p>
        <select class="form-select" aria-label="Default select example">
            <option value="1">Золото</option>
            <option value="2">Серебро</option>
            <option value="3">Бронза</option>
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
        <select class="form-select" name="country_id" required>
            <?php foreach ($sportTypes->all() as $sportType): ?>
                <option value="<?= $sportType['id'] ?>">
                    <?= $sportType['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <p>Спортсмен</p>
        <select class="form-select" name="country_id" multiple required>
            <?php foreach ($sportsmans->all() as $sportsman): ?>
                <option value="<?= $sportsman['id'] ?>">
                    <?= $sportsman['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
