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

function requestBody($app, $fields)
{
    $body = objectToArray(json_decode($app->request()->getBody()));

    $required = array();

    foreach ($fields as $field) {
        
        if ( ! isset($body[$field])) {
            $required[] = $field;
        }
    }

    if (count($required)) {
        return array('required' => $required);
    }

    return $body;
}

$app->get('/dashboard', function () use ($app) {
    json($app, array());
})->name('dashboard');

$app->get('/logout', function () use ($app) {
    $app->redirect('/');
})->name('logout');