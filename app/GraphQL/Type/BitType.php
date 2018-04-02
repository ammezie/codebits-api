<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BitType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Bit',
        'description' => 'Code bit'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a bit'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user that posted a bit'
            ],
            'replies' => [
                'type' => Type::listOf(GraphQL::type('Bit')),
                'description' => 'The replies to a bit'
            ],
            'snippet' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The code bit'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was updated'
            ],
        ];
    }
}
