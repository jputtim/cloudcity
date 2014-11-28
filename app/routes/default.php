<?php

$app->get('/', function () use ($app)
{
    $app->redirect($app->urlFor('api.signin'));

})->name('index');

$app->group('/api', function () use ($app) {


    $app->map('/signin', function () use ($app) {

        User::novo(array(
            'email' => 'admin@cc.com',
            'password' => 123456,
            'role' => 'guest'
        ));

        $email = null;

        if ($app->request()->isPost()) {

            $email = $app->request->post('email');
            $password = $app->request->post('password');

            if ( ! $auth = User::authenticate($email, $password)) {
                json($app, false);
            }
        }

        json($app, 'signin');

    })->via('GET', 'POST')->name('api.signin');
    
    $app->get('/accounts(/p/:page)', function ($page = 1) use ($app) {

        $data = Account::all(array(
            'select' => 'title, function, id, count, type, attribute',
            'limit' => ROWS_PER_PAGE,
            'offset' => (($page - 1) * ROWS_PER_PAGE)
        ));

        $data = to_array($data);

        // foreach ($data as $key => $value) {
        //     $data[$key]['function'] = utf8_encode($data[$key]['function']);
        //     $data[$key]['title'] = utf8_encode($data[$key]['title']);
        // }

        json($app, collection($data, $page, 'accounts'));
    });
});

$app->get('/dashboard', function () use ($app) {
    json($app, array());
})->name('dashboard');

$app->get('/logout', function () use ($app) {
    $app->redirect('/');
})->name('logout');
