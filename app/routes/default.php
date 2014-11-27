<?php

$app->get('/', function () use ($app)
{
    $app->redirect('login');
})->name('index');

$app->get('/login', function () use ($app) {

	$app->render('login.html.twig');
})->name('login');

$app->get('/dashboard', function () use ($app) {

	$app->render('dashboard.html.twig');
})->name('dashboard');