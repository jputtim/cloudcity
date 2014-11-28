<?php 

function entity($data) {
    return array(
        'entity' => $data
    );
}

function collection($data, $page = 1, $route)
{
    $uri = API_URI . $route . '/p/';

    return array(
        'rows' => count($data),
        'collection' => $data,
        'per_page' => ROWS_PER_PAGE,
        'page' => $page,
        'next' => $uri . ($page + 1),
        'prev' => $uri . ($page == 1 ? 1 : $page - 1),
    );
}

function to_array($data)
{
    return array_map(function ($object) {
        return $object->to_array();
    }, $data);
}

function json($app, $data)
{
	$app->response->offsetSet('Content-Type', 'application/json');
	$app->response->write(json_encode($data));
}

function dd($input, $dump=false)
{
	echo '<pre>';
	print_r($input);
	echo '</pre>';
	exit;
}

function routeMap($route)
{
	if (is_dir($route)) {
		$glob = glob($route.'/*');
		foreach ($glob as $file)
			return routeMap($file);
	}
	return $route;
}

function isMail($email){
    return preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/", $email);
}

function slug($string, $slug = false) {
	$string = strtolower($string);
	$ascii['a'] = range(224, 230);
	$ascii['e'] = range(232, 235);
	$ascii['i'] = range(236, 239);
	$ascii['o'] = array_merge(range(242, 246), array(240, 248));
	$ascii['u'] = range(249, 252);
	$ascii['b'] = array(223);
	$ascii['c'] = array(231);
	$ascii['d'] = array(208);
	$ascii['n'] = array(241);
	$ascii['y'] = array(253, 255);
	foreach ($ascii as $key=>$item) {
		$acentos = '';
		foreach ($item AS $codigo) $acentos .= chr($codigo);
		$troca[$key] = '/['.$acentos.']/i';
	}
	$string = preg_replace(array_values($troca), array_keys($troca), $string);
	if ($slug) {
		$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
		$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
		$string = trim($string, $slug);
	}
	return $string;
}