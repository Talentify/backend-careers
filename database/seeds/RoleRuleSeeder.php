<?php

use App\Models\Role;
use App\Models\Rule;
use Illuminate\Database\Seeder;

class RoleRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleRulesAdmin = Role::find(1);
        $rules = Rule::get(['id'])->toArray();
        $rulesAdmin = array_column($rules, 'id');
        $roleRulesAdmin->rules()->sync($rulesAdmin);

        $roleRulesUser = Role::find(2);
        $rulesUser = [1, 2, 6, 7, 9];
        $roleRulesUser->rules()->sync($rulesUser);
    }
}
