<?php

namespace Database\Factories;

use App\Models\Commons\Attachment;
use App\Models\Commons\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $expenses = Expense::all()->random(1)->first();
        $destinationPath = public_path(Attachment::getPath($expenses->id));
        File::makeDirectory($destinationPath, $mode = 0777, true, true);

        return [
            'parent_id' => $expenses->id,
            'type' => "expenses",
            'description' => $this->faker->text(100),
            'link' => $this->faker->image($dir = $destinationPath, $width = 640, $height = 480, 'technics', false),
        ];
    }
}
