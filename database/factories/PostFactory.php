<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ 
        'p_user' => $this->faker->randomDigit,
        'p_image' =>'linh.jpg',
        'p_content' =>$this->faker->realText($maxNbChars = 100, $indexSize = 2),
        'p_type' => 'profile',  
        'created_at'=>now(),
        'updated_at'=>now(),
        ];
    }
}
