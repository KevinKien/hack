<?php

/**
 * Actors model config
 */

return array(

    'title' => 'Mua link',

    'single' => 'mua link',

    'model' => 'TxnLink',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'user' => array(
            'title'=>'User',
            'relationship' => 'user',
            'select' => 'username'
        ),
        'link' => array(
            'title' => 'Link',
            'relationship' => 'link',
            'select' => 'text'
        ),
        'price' => array(
            'title' => 'Giá',
        ),
        'created_at' => array(
            'title' => 'Thời gian'
        )
    ),

    /**
     * The filter set
     */
    'filters' => array(
        'id',
        'user'=>array(
            'title'=>'User',
            'type' => 'relationship',
            'relationship' => 'user',
            'name_field' => 'username'
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
        'id'
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