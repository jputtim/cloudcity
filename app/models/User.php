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

	static $signin_required_fields = array(
		'email', 
		'password'
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

	static function authenticate($email, $password)
	{
		if ( ! $user = self::find(array(
			'select' => 'id, email, password',
			'conditions' => array('email=?', $email)
		))) {
			return false;
		}

		if ( ! password_verify($password, $user->password)) {
			return false;
		}

		$_SESSION['auth'] = array(
			'date' => date('Y-m-d'),
			'user' => array(
				'id' => $user->id,
				'email' => $user->email
			)
		);

		return $_SESSION['auth'];
	}

	static function authenticated()
	{
		return isset($_SESSION['auth']);
	}

	static function logout()
	{
		if (isset($_SESSION['auth'])) {
			unset($_SESSION['auth']);
		}

		return true;
	}
}