<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;

class SignUpMutation extends Mutation
{
    protected $attributes = [
        'name' => 'signUp'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:users'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),
        ]);

        // generate token for user and return the token
        return auth()->login($user);
    }
}
