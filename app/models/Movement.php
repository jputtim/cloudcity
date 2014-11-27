<?php 

/**
 * @author Gilglécio Santos de Oliveira <gilglecio_dev@hotmail.com>
 **/
final class Movement extends AppModel
{
	static $has_many = array();

	static $has_one = array();

	static $belongs_to = array(
		array('user'),
		array('department'),
		array('account'),
	);
}