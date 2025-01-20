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
                'max_score' => 1000,
            ],
            [
                'name' => 'High Rank',
                'min_score' => 1001,
                'max_score' => 5000,
            ],
            [
                'name' => 'Master Rank',
                'min_score' => 5001,
                'max_score' => 10000,
            ],
        ];

        foreach( $levels as $level ) {
            if( ! Levels::where('name', $level['name'])->exists() ) {
                Levels::create($level);
            }
        }
    }
}
