<?php

$searchRoot = 'test_search';
$searchName = 'test.txt';
$searchResult = [];

function search(string $searchRoot, string $searchName, array &$searchResult): void
{
    $dir = scandir($searchRoot);
    foreach ($dir as $file) {
        $route = $searchRoot . DIRECTORY_SEPARATOR . $file;
        if ($file != '.' && $file != '..') {
            if (is_dir($route)) {
                search($route, $searchName, $searchResult);
            } elseif (is_file($route) && $file == $searchName) {
                $searchResult[] = $route;
            }
        }
    }
}

search($searchRoot, $searchName, $searchResult);
$searchResult = array_filter($searchResult, function (string $file): bool {
    return filesize($file) > 0;
});

if (count($searchResult) > 0)  {
    foreach ($searchResult as $result) {
        echo 'Мы нашли что то похожее ' . $result . PHP_EOL;
    }
} else {
    echo 'Поиск не дал результатов';
}
