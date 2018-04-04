<?php

namespace App\GraphQL\Mutation;

use App\Bit;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBit'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
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
        if (!$bit = Bit::find($args['id'])) {
            throw new \Exception('Resource not found');
        }

        if ($bit->user_id !== auth()->user()->id) {
            throw new \Exception('You can only delete your own codebit');
        }

        $bit->delete();

        return null;
    }
}
