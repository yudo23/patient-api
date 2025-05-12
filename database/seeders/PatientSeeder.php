<?php

namespace Database\Seeders;

use App\Enums\GenderEnum;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;
use Log;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            for ($i = 1; $i <= 100; $i++) {
                Patient::create([
                    'name' => fake()->name,
                    'id_type' => "Driver's License",
                    'id_no' => rand(100000000000, 999999999999),
                    'dob' => Carbon::parse("2001-09-29")->format("Y-m-d"),
                    'gender' => (rand(0, 1) === 0) ? GenderEnum::MALE->value : GenderEnum::FEMALE->value,
                    'address' => fake()->address,
                    'medium_acquisition' => "Social Media",
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::emergency($th->getMessage());
        }
    }
}
