<?php

return [
    'register_user' => [
        'validation_rules' => [
            'email' => 'required|email|max:128|unique:users',
            'password' => 'required|string|max:256',
        ]
    ],
  'store_question' => [
      'validation_rules' => [
            'title' => 'required|string|max:128',
            'slug' => '|string|max:256',
            'body' => 'required|string|max:254',
            'category_id' => 'required|int',
            'user_id' => 'int'
      ]
  ],
  'update_question' => [
      'validation_rules' => [
          'title' => 'string|max:128',
          'slug' => '|string|max:256',
          'body' => 'string|max:254',
          'category_id' => 'int',
          'user_id' => 'int'
      ]
  ],
    'store_category' => [
        'validation_rules' => [
            'name' => 'required|string|max:128',
            'slug' => 'string|max:256',
        ]
    ],
    'update_category' => [
        'validation_rules' => [
            'name' => 'string|max:128',
            'slug' => 'string|max:256',
        ]
    ],
    'store_reply' => [
        'validation_rules' => [
            'body' => 'required|string|max:2048',
        ]
    ],
    'update_reply' => [
        'validation_rules' => [
            'body' => 'string|max:2048',
        ]
    ],
];