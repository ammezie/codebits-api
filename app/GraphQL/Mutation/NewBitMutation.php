<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\Bit;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class NewBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newBit'
    ];

    public function type()
    {
        return GraphQL::type('Bit');
    }

    public function args()
    {
        return [
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
        $bit = new Bit();

        $bit->user_id = auth()->user()->id;
        $bit->snippet = $args['snippet'];
        $bit->save();

        return $bit;
    }
}
