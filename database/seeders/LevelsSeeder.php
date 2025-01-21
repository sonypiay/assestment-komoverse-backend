<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Levels;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Low Rank',
                'min_score' => 0,
            ],
            [
                'name' => 'High Rank',
                'min_score' => 501,
            ],
            [
                'name' => 'Master Rank',
                'min_score' => 1000,
            ],
        ];

        foreach( $levels as $level ) {
            if( ! Levels::where('name', $level['name'])->exists() ) {
                Levels::create($level);
            }
        }
    }
}
