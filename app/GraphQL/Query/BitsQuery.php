<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Bit;
use GraphQL\Type\Definition\ResolveInfo;

class BitsQuery extends Query
{
    protected $attributes = [
        'name' => 'bits'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Bit'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection(); // $depth = 1

        $bits = Bit::query();

        foreach ($fields as $field => $keys) {
            if ($field === 'user') {
                $bits->with('user');
            }

            if ($field === 'replies') {
                $bits->with('replies');
            }
        }

        return $bits->latest()->get();
    }
}
