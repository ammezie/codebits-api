<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\Bit;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateBit'
    ];

    public function type()
    {
        return GraphQL::type('Bit');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'snippet' => [
                'name' => 'snippet',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function authenticated($root, $args, $currentUser)
    {
        return !!$currentUser;
    }

    public function resolve($root, $args)
    {
        if (!$bit = Bit::find($args['id'])) {
            throw new \Exception('Resource not found');
        }

        $bit->snippet = $args['snippet'];
        $bit->save();

        return $bit;
    }
}
