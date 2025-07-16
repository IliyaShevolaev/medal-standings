<?php

function columnSort(array &$data, string $columnName, bool $asc = true): void
{
    uasort($data, function ($a, $b) use ($columnName, $asc) {
        return $asc ? $a[$columnName] <=> $b[$columnName] : -($a[$columnName] <=> $b[$columnName]);
    });

    definePlace($data, $asc);

}

function defaultSort(array &$data, bool $asc = true): void
{
    uasort($data, function ($a, $b) use ($asc) {
        $result = $asc ? $a['gold'] <=> $b['gold'] : -($a['gold'] <=> $b['gold']);
        if ($result == 0) {
            $result = $asc ? $a['silver'] <=> $b['silver'] : -($a['silver'] <=> $b['silver']);
            if ($result == 0) {
                return $asc ? $a['bronze'] <=> $b['bronze'] : -($a['bronze'] <=> $b['bronze']);
            } else {
                return $result;
            }
        } else {
            return $result;
        }
    });

    definePlace($data, $asc);
}

function definePlace(array &$data, bool $asc): void
{
    $place = $asc ? count($data) : 1;

    foreach ($data as &$item) {
        $item['place'] = $asc ? $place-- : $place++;
    }
}