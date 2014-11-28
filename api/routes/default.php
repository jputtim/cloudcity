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

            $app->response->setStatus(403);

            return json($app, array(
                'message' => 'Suas credenciais estão incorretas'
            ));
        }

        json($app, User::authenticated());

    })->via('GET', 'POST')->name('api.signin');
    
    $app->get('/accounts(/q/:query)(/p/:page)', function ($query = false, $page = 1) use ($app) {
        
        $route = 'accounts';

        $config = array(
            'select' => 'title, function, id, count, type, attribute',
            'limit' => ROWS_PER_PAGE,
            'offset' => (($page - 1) * ROWS_PER_PAGE)
        );

        if ($query) {
            $config['conditions'] = array(
                'title LIKE ? OR function LIKE ? OR count LIKE ?', "%$query%", "%$query%", "%$query%",
            );

            $route .= '/q/' . $query;
        }

        $data = Account::all($config);

        json($app, collection(to_array($data), $page, $route));
    })->name('api.accounts');

    $app->get('/logout', function () use ($app) {

        User::logout();
        $app->redirect('/');
    })->name('api.logout');
    
    $app->get('/authenticated', function () use ($app) {
        json($app, User::authenticated());
    });
});

$app->notFound(function () use ($app) {

    $app->response->offsetSet('Content-Type', 'application/json');
    echo json_encode(array('404' => 'Not Found'));
});
