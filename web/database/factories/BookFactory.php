<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory\Generator $factory */
use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        // 'id' => ,
        'book_name' => $faker->title,
        // 'user_id' => ,
        'created_at' => now(),
        'updated_at' => null,
        'title_kana' => null,
        'subtitle' => null,
        'subtitle_kana' => null,
        'isbn' => $faker->isbn13,
        'author' => $faker->name,
        'author_kana' => null,
        'publisher' => now(),
        'url' => $faker->url,
    ];
});
