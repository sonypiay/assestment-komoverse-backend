<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\HistoryScore;
use App\Models\ScoreLeaderboard;

class ResetDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            HistoryScore::whereRaw(1)->delete();
            Users::whereRaw(1)->delete();
        });
    }
}
