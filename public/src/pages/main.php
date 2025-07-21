<?php

use App\classes\MVC\View;

require_once __DIR__ . '/../scripts/medals/medals_table_count.php';
require_once __DIR__ . '/../scripts/medals/sort_medals.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $asc = false;

    if (isset($_GET['asc'])) {
        $asc = !$_GET['asc'];
    }

    if (isset($_GET['sort_key'])) {
        columnSort($medalsByCountry, $_GET['sort_key'], $asc);
    } else {
        defaultSort($medalsByCountry, $asc);
    }

    // $smarty->assign([
    //     'path' => 'medals/show_table.tpl',
    //     'asc' => $asc,
    //     'medalsByCountry' => $medalsByCountry,
    // ]);
    // $smarty->display('layouts/main.tpl');

    View::make('medals/show_table.tpl', [
        'asc' => $asc,
        'medalsByCountry' => $medalsByCountry,
    ]);
}
?>