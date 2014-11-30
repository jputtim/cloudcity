<?php 

/**
 * AppModel
 *
 * @author Gilglécio Santos de Oliveira <gilglecio_dev@hotmail.com>
 **/
abstract class AppModel extends \Activerecord\Model
{
	static function pagination($config, $page)
	{
		$complete = $config;
	    $complete['select'] = 'count(*) as rows';
	    $count = static::find($complete);

	    $config['limit'] = 25;
	    $config['offset'] = ($page - 1) * ROWS_PER_PAGE;

	    $data = static::all($config);

	    return array(
	        'total_rows' => $count->rows,
	        'data' => $data,
	    );
	}
}