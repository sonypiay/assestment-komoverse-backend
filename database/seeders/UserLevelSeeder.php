<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\Users;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::all()
        ->lazy(100)
        ->each(function($users) {
            if( $users->userLevel()->count() == 0 ) {
                $users->userLevel()->create([
                    'level' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Log::info(json_encode($users));
        });
    }
}
