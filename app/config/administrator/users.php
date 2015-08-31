<?php

/**
 * Actors model config
 */

return array(

	'title' => 'Users',

	'single' => 'user',

	'model' => 'User',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id',
        'username' => array(
            'title'=>'Username',
            'select'=>'username'
        ),
		'roles' => array(
			'title' => 'Vai trò',
			'relationship' => 'roles',
			'select' => "group_concat(role_name)",
		),
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id',
        'username'=>array(
            'title'=>'Username'
        ),
        'roles' => array(
            'title' => 'Role',
            'type' => 'relationship',
            'relationship' => 'roles',
            'name_field' => 'role_name' // The column name which holds the name of the role
        ),
		'created_at' => array(
			'title' => 'Thời gian đăng ký',
			'type' => 'date',
		),
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
        'username'=>array(
            'title'=>'Username',
            'type'=>'text'
        ),
		'roles' => array(
			'title' => 'Role',
			'type' => 'relationship',
			'relationship' => 'roles',
			'name_field' => 'role_name' // The column name which holds the name of the role
		),
	),

	/**
	 * This is where you can define the model's custom actions
	 */
	'actions' => array(
//		//Ordering an item up
//		'hash_password' => array(
//			'title' => 'Mã hóa password',
//			'messages' => array(
//				'active' => 'Hashing password...',
//				'success' => 'Mã hóa mật khẩu thành công',
//				'error' => 'Mã hóa mật khẩu lỗi',
//			),
//			//the model is passed to the closure
//			'action' => function(&$model)
//			{
//				$model->password=Hash::make($model->password);
//				return $model->save();
//			}
//		),
	),
);