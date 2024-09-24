<?php

use Greg0\UkeExam\QuestionsQuery;
use OpenSpout\Reader\XLSX\Reader;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__. '/../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__. '/../templates');
$twig = new Environment($loader, [
    'cache' => __DIR__.'/../var/cache',
]);

$reader = new Reader();
$reader->open(__DIR__ . '/UKE_porownanie_pytan.xlsx');

$query = new QuestionsQuery(
    __DIR__ . '/UKE_porownanie_pytan.xlsx'
);

$questions = $query->findAll($_GET['sheet'] ?? 'nowe');

$template = $twig->load('question.html.twig');
echo $template->render([
    'questions' => $questions
]);
