<?php 

/**
 * @author Gilglécio Santos de Oliveira <gilglecio_dev@hotmail.com>
 **/
final class Entity extends AppModel
{
	static $has_many = array(
		array('users'),
	);

	static $has_one = array();

	static $belongs_to = array();
}