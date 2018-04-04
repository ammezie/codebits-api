<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\Reply;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class ReplyBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'replyBit'
    ];

    public function type()
    {
        return GraphQL::type('Reply');
    }

    public function args()
    {
        return [
            'bit_id' => [
                'name' => 'bit_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'reply' => [
                'name' => 'reply',
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
        $reply = new Reply();

        $reply->user_id = auth()->user()->id;
        $reply->bit_id = $args['bit_id'];
        $reply->reply = $args['reply'];

        $reply->save();

        return $reply;
    }
}
