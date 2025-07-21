<div class="main-container d-flex flex-column justify-content-center align-items-center">
    <table class="table table-primary mt-3">
        <thead>
            <tr class="table-header">
                <th scope="col table-primary"><a class="link-nonwrap" href="/?asc={$asc}">Место</a></th>
                <th scope="col table-primary"><a class="link-nonwrap" href="/?sort_key=name&asc={$asc}">Страна</a></th>
                <th scope="col table-primary"><a class="link-nonwrap" href="/?sort_key=gold&asc={$asc}">Золотые медали</a></th>
                <th scope="col table-primary"><a class="link-nonwrap" href="/?sort_key=silver&asc={$asc}">Серебряные медали</a></th>
                <th scope="col table-primary"><a class="link-nonwrap" href="/?sort_key=bronze&asc={$asc}">Бронзовые медали</a></th>
                <th scope="col table-primary"><a class="link-nonwrap" href="/?sort_key=total&asc={$asc}">Сумма медалей</a></th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$medalsByCountry key=id item=row}
            <tr>
                <td>{$row.place}</td>
                <td>{$row.name}</td>
                <td>
                    {$row.gold}
                    <a class="btn btn-primary" href="/medal/show?country={$row.country_id}&medal=gold">-></a>
                </td>
                <td>
                    {$row.silver}
                    <a class="btn btn-primary" href="/medal/show?country={$row.country_id}&medal=silver">-></a>
                </td>
                <td>
                    {$row.bronze}
                    <a class="btn btn-primary" href="/medal/show?country={$row.country_id}&medal=bronze">-></a>
                </td>
                <td>{$row.total}</td>
            </tr>
            {/foreach}
        </tbody>
    </table>

    <div class="d-flex w-100 justify-content-between">
        <a href="/countries" class="btn btn-outline-primary">Добавить страну</a>
        <a href="/src/pages/add_medal.php" class="btn btn-outline-primary">Добавить медаль</a>
        <a href="/src/pages/add_sport_type.php" class="btn btn-outline-primary">Добавить вид спорта</a>
        <a href="/src/pages/add_sportsman.php" class="btn btn-outline-primary">Добавить спортсмена</a>
    </div>
</div>
