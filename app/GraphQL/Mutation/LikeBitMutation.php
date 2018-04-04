<?php

namespace App\GraphQL\Mutation;

use App\Like;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class LikeBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'likeBit'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'bit_id' => [
                'name' => 'bit_id',
                'type' => Type::nonNull(Type::int()),
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
        $like = new Like();

        $like->user_id = auth()->user()->id;
        $like->bit_id = $args['bit_id'];

        $like->save();

        return 'Like successful!';
    }
}
