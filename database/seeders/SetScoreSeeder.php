<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\HistoryScore;
use App\Models\ScoreLeaderboard;

class SetScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            HistoryScore::whereRaw(1)->delete();

            Users::all()
            ->lazy(100)
            ->each(function($users) {
                $score = mt_rand(1000,9999);

                HistoryScore::create([
                    'user_id' => $users->id,
                    'level' => 1,
                    'score' => $score,
                ]);
            });
        });
    }
}
