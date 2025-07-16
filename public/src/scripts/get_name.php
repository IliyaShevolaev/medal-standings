<?php

function getNameById(array $data, int $id): string
{
    foreach ($data as $value) {
        if ($value['id'] == $id) {
            return $value['name'];
        }
    }

    return 'untilted';
}
