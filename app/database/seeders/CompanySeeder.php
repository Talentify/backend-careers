<?php

namespace Database\Seeders;

use App\Enums\CompanySizeEnum;
use App\Models\Company;
use App\Models\Workplaces;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->create(['size' => CompanySizeEnum::MEDIUM]);
    }
}
