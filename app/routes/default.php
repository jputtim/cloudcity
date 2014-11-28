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

            if ( ! $body = requestBody($app, User::$signin_required_fields)) {

                return json($app, array(
                    'required' => User::$signin_required_fields
                ));
            }

            if ($auth = User::authenticate($body['email'], $body['password'])) {
                return json($app, $auth);
            }
        }

        json($app, User::authenticated());

    })->via('GET', 'POST')->name('api.signin');
    
    $app->get('/accounts(/p/:page)', function ($page = 1) use ($app) {

        $data = Account::all(array(
            'select' => 'title, function, id, count, type, attribute',
            'limit' => ROWS_PER_PAGE,
            'offset' => (($page - 1) * ROWS_PER_PAGE)
        ));

        json($app, collection(to_array($data), $page, 'accounts'));
    });
});

$app->notFound(function () use ($app) {

    $app->response->offsetSet('Content-Type', 'application/json');
    echo json_encode(array('404' => 'Not Found'));
});

$app->get('/api/authenticated', function () use ($app) {
    json($app, User::authenticated());
});

$app->get('/logout', function () use ($app) {

    User::logout();
    $app->redirect('/');
})->name('logout');
