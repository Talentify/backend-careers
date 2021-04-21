<?php

namespace Tests\Feature;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_filter_all_open_jobs()
    {
        $headers = ['Accept' => 'application/json'];
        
        $openJobPHP = Job::factory()->create([
            'title' => 'Programador PHP',
            'status' => 'O',
        ]);

        $openJobJava = Job::factory()->create([
            'title' => 'Programador JAVA',
            'status' => 'C',
        ]);

        $closedJobCSharp = Job::factory()->create([
            'title' => 'Programador C#',
            'status' => 'O',
        ]);
        
        $response = $this->get('/api/openjobs');
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['title' => 'Programador PHP']);      
        $response->assertJsonFragment(['title' => 'Programador C#']);      
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
        $response->assertJsonCount(1);
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
        $response->assertJsonCount(1);
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
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['salary' => "8300"]);      
        $response->assertJsonFragment(['title' => 'PHP Dev']);      
    }       
}
