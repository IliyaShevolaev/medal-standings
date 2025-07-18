<?php
$str = 'text   <b>dsds</b>';
prepareSting($str);
echo $str;

function prepareSting(string &$str): bool
{
    $str = trim($str);

    $allowedTags = [
        ['<b>', '</b>'],
        ['<i>', '</i>'],
        ['<p>', '</p>'],
        ['<strong>', '</strong>'],
        ['<small>', '</small>']
    ];

    foreach ($allowedTags as $allowedTag) {
        $str = str_replace(
            $allowedTag[0],
            str_replace(
                ['<', '>'],
                [
                    '##OPEN_BRACKET##',
                    '##CLOSE_BRACKET##'
                ],
                $allowedTag[0]
            ),
            $str
        );

        $str = str_replace(
            $allowedTag[1],
            str_replace(
                ['<', '>'],
                [
                    '##OPEN_BRACKET##',
                    '##CLOSE_BRACKET##'
                ],
                $allowedTag[1]
            ),
            $str
        );
    }

    $str = htmlspecialchars($str);

    foreach ($allowedTags as $allowedTag) {
        $str = str_replace(
            str_replace(
                ['<', '>'],
                ['##OPEN_BRACKET##', '##CLOSE_BRACKET##'],
                $allowedTag[0]
            ),
            $allowedTag[0],
            $str
        );

        $str = str_replace(
            str_replace(
                ['<', '>'],
                ['##OPEN_BRACKET##', '##CLOSE_BRACKET##'],
                $allowedTag[1]
            ),
            $allowedTag[1],
            $str
        );
    }

    return $str !== '';
}