<?php

return [
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
  ]
];