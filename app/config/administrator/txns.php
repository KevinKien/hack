<?php

/**
 * Actors model config
 */

return array(

    'title' => 'Giao dịch thẻ',

    'single' => 'giao dịch thẻ',

    'model' => 'Txn',

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
        'card_type' => array(
            'title' => 'Loại thẻ',
        ),
        'pin' => array(
            'title' => 'Mã thẻ',
        ),
        'seri' => array(
            'title' => 'Seri'
        ),
        'card_amount' => array(
            'title' => 'Mệnh giá'
        ),
        'response_code' => array(
            'title' => 'Trạng thái (1:ok)'
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
        'pin' => array(
            'title' => 'Mã thẻ',
        ),
        'seri' => array(
            'title' => 'Seri'
        ),
        'card_amount' => array(
            'title' => 'Mệnh giá'
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