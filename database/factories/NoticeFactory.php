<?php

namespace Database\Factories;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory\Vehicle as Faker;
use App\Services\UploadService;

use Illuminate\Support\Facades\Storage;
class NoticeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = $this->faker->image('storage/app/public/notices');

        return [
            'title'               => $this->faker->title,
            'message'             => $this->faker->paragraph,
            'user_id'             => '',
            'notice_author'       => '',
            'notice_author_email' => '',
            'author_avatar'       => '',
            'mark'                => $this->faker->name,
            'model'               => $this->faker->name,
            'color'               => $this->faker->colorName,
            'year'                => $this->faker->year,
            'mileage'             => $this->faker->numberBetween(1, 1000000),
            'price'               => $this->faker->numberBetween(1, 1000000),
            'body'                => $this->faker->name,
            'image_url'           => Storage::disk('public')->url($image),

        ];

    }
}


