<?php 

/**
 * @author Gilglécio Santos de Oliveira <gilglecio_dev@hotmail.com>
 **/
final class User extends AppModel
{
	static $has_many = array(
		array('movements'),
	);

	static $has_one = array();

	static $belongs_to = array(
		array('entity'),
		array('permission'),
	);
}