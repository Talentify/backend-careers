<?php

use Illuminate\Database\Seeder;

use \Laravel\Passport\Client as OauthClient;

class OauthClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, "user_id" => null, "name" => "Laravel Personal Access Client", "secret" => "MzXnGZtujrYwI6vFrGayfPYlHDAE6VdlSLhXBxrf", "redirect" => "http://localhost", "personal_access_client" => true, "password_client" => false, "revoked" => false],
            ['id' => 2, "user_id" => null, "name" => "Laravel Password Grant Client", "secret" => "Qh1DDYCd2zun9oWwHK5kVhsPG2t5ruIZF2O8fXgP", "redirect" => "http://localhost", "personal_access_client" => false, "password_client" => true, "revoked" => false],
        ];

        foreach ($data as $item) {
            OauthClient::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
