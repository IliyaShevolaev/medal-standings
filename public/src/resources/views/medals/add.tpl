<form class="w-100" method="post" action="/src/scripts/medals/create_medal.php">
    <div class="main-container d-flex flex-row justify-content-between align-items-center mt-3">
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
                {foreach from=$countries item=country}
                <option value={$country.id}>{$country.name}</option>
                {/foreach}
            </select>
        </div>

        <div>
            <p>Вид спорта</p>
            <select class="form-select" name="sport_type_id" required>
                {foreach from=$sportTypes item=sportType}
                <option value={$sportType.id}>{$sportType.name}</option>
                {/foreach}
            </select>
        </div>

        <div>
            <p>Спортсмен</p>
            <select class="form-select" name="sportsmans_id[]" multiple required>
                {foreach from=$sportsmans item=sportsman}
                <option value={$sportsman.id}>{$sportsman.name}</option>
                {/foreach}
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-outline-success mt-2 w-25">Добавить</button>
    </div>
</form>
