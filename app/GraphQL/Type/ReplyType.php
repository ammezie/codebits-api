<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ReplyType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Reply',
        'description' => 'Reply to codebit'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a reply'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user that posted a reply'
            ],
            'bit' => [
                'type' => Type::listOf(GraphQL::type('Bit')),
                'description' => 'The bit that was replied to'
            ],
            'reply' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The reply'
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

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }
}
