<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Recruiter;
use Laravel\Sanctum\Sanctum;

class JobApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_get_all_jobs()
    {
        Job::factory()->create([
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        Job::factory()->create([
            'title' => 'Programador JAVA',
            'status' => 'C',
        ]);

        Job::factory()->create([
            'title' => 'Programador C#',
            'status' => 'O',
        ]);

        $response = $this->get('/api/jobs');
        $response->assertJsonCount(3, 'data');
        $response->assertJsonFragment(['title' => 'Programador PHP']);      
        $response->assertJsonFragment(['title' => 'Programador C#']);      
        $response->assertJsonFragment(['title' => 'Programador JAVA']);         
    }

    public function test_should_filter_all_open_jobs()
    {
        Job::factory()->create([
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        Job::factory()->create([
            'title' => 'Programador JAVA',
            'status' => 'C',
        ]);

        Job::factory()->create([
            'title' => 'Programador C#',
            'status' => 'O',
        ]);
        
        $response = $this->get('/api/openjobs');
        $response->assertJsonCount(2, 'data');
        $response->assertJsonFragment(['title' => 'Programador PHP']);      
        $response->assertJsonFragment(['title' => 'Programador C#']);      
        $response->assertJsonMissing(['title' => 'Programador JAVA']);      
    }

    public function test_should_retrieve_a_specific_job()
    {
        $job1 = Job::factory()->create([
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);
        
        $job2 = Job::factory()->create([
            'title' => 'Programador JAVA',
            'status' => 'C',
        ]);
        
        $job3 = Job::factory()->create([
            'title' => 'Programador C#',
            'status' => 'O',
        ]);
        
        $response = $this->get('/api/jobs/'.$job1->id);
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['message' => 'Job retrieved successfully!']);
        $response->assertJsonFragment(['title' => 'Programador PHP']);      
        $response->assertJsonMissing(['title' => 'Programador C#']);      
        $response->assertJsonMissing(['title' => 'Programador JAVA']);      
    }

    public function test_should_create_a_job()
    {      
        $faker = \Faker\Factory::create();
        $headers = ['Accept' => 'application/json'];

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => 1,
            'name' => "Some User",
            'login' => "userlogin",
            'password' => bcrypt("pass123")
        ]);
        
        Sanctum::actingAs($loggedInUser); 
        
        $formData = [
            'title' => 'Some PHP Web Dev',
            'description' => $faker->bs,
            'address' => $faker->address,
            'salary' => 8000,
            'company' => $faker->company
        ];

        $response = $this->post('/api/jobs', $formData, $headers);
        $response->assertStatus(201);        
        $response->assertJsonFragment(['message' => 'Job created successfully!']);      
        $response->assertJsonFragment(['title' => 'Some PHP Web Dev']);      
    } 
    
    public function test_should_update_a_job()
    {      
        $headers = ['Accept' => 'application/json'];

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => 1,
            'name' => "Some User",
            'login' => "userlogin",
            'password' => bcrypt("pass123")
        ]);
        
        Sanctum::actingAs($loggedInUser); 

        $jobPHP = Job::factory()->create([
            'id_recruiters_creator' => $loggedInUser->id,
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        $jobPHP->title = 'PHP Dev';
                
        $response = $this->put('/api/jobs/'.$jobPHP->id, json_decode($jobPHP, true), $headers);
        $response->assertStatus(201);        
        $response->assertJsonFragment(['message' => 'Job updated successfully!']);      
        $response->assertJsonFragment(['title' => 'PHP Dev']);      
    }   
    
    public function test_different_recruiter_canot_update_a_job()
    {      
        // $this->withoutExceptionHandling();
        $headers = ['Accept' => 'application/json'];

        $jobPHP = Job::factory()->create([
            'id_recruiters_creator' => 99999,
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        $jobPHP->title = 'PHP Dev';

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => 1,
            'name' => "Some User",
            'login' => "userlogin",
            'password' => bcrypt("pass123")
        ]);
        
        Sanctum::actingAs($loggedInUser); 
                
        $response = $this->put('/api/jobs/'.$jobPHP->id, json_decode($jobPHP, true), $headers);
        $response->assertStatus(401);        
        $response->assertJsonFragment(['message' => 'Unauthorized user']);      
    }  
    
    public function test_should_delete_a_job()
    {      
        $headers = ['Accept' => 'application/json'];

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => 1,
            'name' => "Some User",
            'login' => "userlogin",
            'password' => bcrypt("pass123")
        ]);
        
        Sanctum::actingAs($loggedInUser); 

        $job2 = Job::factory()->create([
            'title' => 'Programador JAVA',
            'status' => 'C',
        ]);
        
        $response = $this->delete('/api/jobs/'.$job2->id, $headers);
        $response->assertStatus(200);        
        $response->assertJsonFragment(['message' => 'Job deleted successfully!']);      
        $response->assertJsonFragment(['title' => 'Programador JAVA']);      
    }   
    
    public function test_different_recruiter_canot_delete_a_job()
    {      
        $headers = ['Accept' => 'application/json'];

        $jobPHP = Job::factory()->create([
            'id_recruiters_creator' => 99999,
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => 1,
            'name' => "Some User",
            'login' => "userlogin",
            'password' => bcrypt("pass123")
        ]);
        
        Sanctum::actingAs($loggedInUser); 
                
        $response = $this->delete('/api/jobs/'.$jobPHP->id, $headers);
        $response->assertStatus(401);        
        $response->assertJsonFragment(['message' => 'Unauthorized user']);      
    }        

    public function test_should_filter_jobs_by_keyword()
    {
        $headers = ['Accept' => 'application/json'];

        $formData = [
            'keyword' => 'PHP',
        ];

        $jobPHP = Job::factory()->create([
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        $jobJava = Job::factory()->create([
            'title' => 'Programador JAVA',
            'status' => 'O',
        ]);
        
        $response = $this->post('/api/jobsfilter', $formData, $headers);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['title' => 'Programador PHP']);      
        $response->assertJsonFragment(['status' => 'O']);      
    }

    public function test_should_filter_jobs_by_address()
    {
        $headers = ['Accept' => 'application/json'];

        $formData = [
            'address' => 'Raimundo',
        ];

        $jobAddress1 = Job::factory()->create([
            'address' => 'Raimundo Correia',
            'status' => 'O',
        ]);

        $jobAddress2 = Job::factory()->create([
            'address' => 'Nonato da Costa',
            'status' => 'O',
        ]);
        
        $response = $this->post('/api/jobsfilter', $formData, $headers);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['address' => 'Raimundo Correia']);      
        $response->assertJsonFragment(['status' => 'O']);      
    }   
    
    public function test_should_filter_jobs_by_salary()
    {
        $headers = ['Accept' => 'application/json'];

        $formData = [
            'salary' => 8300,
        ];

        $jobSalary1 = Job::factory()->create([
            'title' => 'Java Dev',
            'salary' => 10200,
            'status' => 'O',
        ]);
        
        $jobSalary2 = Job::factory()->create([
            'title' => 'PHP Dev',
            'salary' => 8300,
            'status' => 'O',
        ]);

        $jobSalary3 = Job::factory()->create([
            'title' => 'Python Dev',
            'salary' => 5000,
            'status' => 'O',
        ]);

        $jobSalary4 = Job::factory()->create([
            'title' => 'Angular Dev',
            'salary' => 8300,
            'status' => 'C',
        ]);
        
        $response = $this->post('/api/jobsfilter', $formData, $headers);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['salary' => "8300"]);      
        $response->assertJsonFragment(['title' => 'PHP Dev']);      
    }       
}
