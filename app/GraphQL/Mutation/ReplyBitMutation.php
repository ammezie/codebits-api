<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\Bit;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class ReplyBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'replyBit'
    ];

    public function type()
    {
        return GraphQL::type('Bit');
    }

    public function args()
    {
        return [
            'bit_id' => [
                'name' => 'bit_id',
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
        $bit = new Bit();

        $bit->user_id = auth()->user()->id;
        $bit->bit_id = $args['bit_id'];
        $bit->snippet = $args['snippet'];
        $bit->save();

        return $bit;
    }
}
