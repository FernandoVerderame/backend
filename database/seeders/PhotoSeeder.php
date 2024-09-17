<?php

namespace Database\Seeders;

use App\Models\Photo;
use Faker\Provider\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = config('photos');

        foreach ($photos as $photo) {

            $new_photo = new Photo();
            $new_photo->apartment_id = $photo['apartment_id'];
            $new_photo->image = $photo['image'];

            $new_photo->save();
        }
    }
}
