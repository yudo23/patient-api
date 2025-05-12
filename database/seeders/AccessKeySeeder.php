<?php

namespace Database\Seeders;

use App\Models\AccessKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Log;

class AccessKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            AccessKey::firstOrCreate([
                'token' => "A9D8F7C6B5E4D3C2A1B0D9F8C7E6B5A4"
            ],[
                'token' => "A9D8F7C6B5E4D3C2A1B0D9F8C7E6B5A4"
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::emergency($th->getMessage());
        }
    }
}
