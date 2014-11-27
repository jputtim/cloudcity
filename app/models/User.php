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

	static function novo($data)
	{
		if ( ! self::find_by_email($data['email'])) {

			$entity = Entity::create(array(
				'created_at' => new Datetime()
			));

			$permission = Permission::create(array(
				'description' => ''
			));

			$data['entity_id'] = $entity->id;
			$data['permission_id'] = $permission->id;
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

			self::create($data);
		}
	}
}