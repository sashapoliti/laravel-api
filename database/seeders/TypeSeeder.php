<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Frontend',
            'Backend',
            'Fullstack',
            'Mobile',
            'Desktop'
        ];
        foreach ($types as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Type::generateSlug($type);
            $newType->save();
        }
    }
}
