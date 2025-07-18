<div class="main-container d-flex flex-column justify-content-center align-items-center">
    <h1>{$header.country}, {$header.medal} медали</h1>

    {foreach from=$medalsRow item=row}
    <p>{$row.name} — {$row.sport_type}</p>
    {/foreach}
</div>
