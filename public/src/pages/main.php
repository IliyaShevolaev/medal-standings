<?php 
    require_once __DIR__ . '/../scripts/medals/medals_table_count.php'
?>

<div class="d-flex flex-column justify-content-center align-items-center"
    style="padding-left: 10rem; padding-right: 10rem;">
    <table class="table table-primary mt-3">
        <thead>
            <tr>
                <th scope="col table-primary">Место</th>
                <th scope="col table-primary">Страна</th>
                <th scope="col table-primary">Золотые медали</th>
                <th scope="col table-primary">Серебряные медали</th>
                <th scope="col table-primary">Бронзовые медали</th>
                <th scope="col table-primary">Сумма медалей</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medalsByCountry as $id => $row) : ?>
            <tr>
                <td><?= $row['place'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['gold'] ?> <a class="btn btn-primary" href="<?='/src/pages/medals_view.php?country=' . $id . '&medal=gold'?>">-></a> </td>
                <td><?= $row['silver'] ?> <a class="btn btn-primary" href="<?='/src/pages/medals_view.php?country=' . $id . '&medal=silver'?>">-></a> </td>
                <td><?= $row['bronze'] ?> <a class="btn btn-primary" href="<?='/src/pages/medals_view.php?country=' . $id . '&medal=bronze'?>">-></a> </td>
                <td><?= $row['total'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-flex w-100 justify-content-between">
        <a href="/src/pages/add_country.php" class="btn btn-outline-primary">Добавить страну</a>
        <a href="/src/pages/add_medal.php" class="btn btn-outline-primary">Добавить медаль</a>
        <a href="/src/pages/add_sport_type.php" class="btn btn-outline-primary">Добавить вид спорта</a>
        <a href="/src/pages/add_sportsman.php" class="btn btn-outline-primary">Добавить спортсмена</a>
    </div>
</div>