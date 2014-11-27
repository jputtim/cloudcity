<?php

$app->get('/', function () use ($app)
{
    $app->redirect('login');
})->name('index');

$app->map('/login', function () use ($app) {

    User::novo(array(
        'email' => 'admin@cc.com',
        'password' => 123456,
        'role' => 'guest'
    ));

	$email = null;

    if ($app->request()->isPost()) {

        $email = $app->request->post('email');
        $password = $app->request->post('password');

        $result = $app->authenticator->authenticate($email, $password);

        if ($result->isValid()) {
            $app->redirect('/dashboard');
        } else {
            $messages = $result->getMessages();
            $app->flashNow('error', $messages[0]);
        }
    }

	$app->render('login.html.twig', array(
		'email' => $email
	));

})->via('GET', 'POST')->name('login');

$app->get('/dashboard', function () use ($app) {

	$app->render('dashboard.html.twig');
})->name('dashboard');

$app->get('/logout', function () use ($app) {
    $app->authenticator->logout();
    $app->redirect('/');
})->name('logout');