<?php

use App\Models\Job;

class ListJobsTest extends TestCase
{
    /**
     * I can see job list.
     *
     * @return void
     */
    public function testCanSeeJobList()
    {
        $job = Job::create([
            'title' => 'PHP Developer',
            'description' => 'job description',
            'status' => 1
        ]);

        $this->get('/job');

        $this->assertResponseOk();
        $this->seeJsonContains([
            'title' => $job->title,
            'description' => $job->description,
            'status' => $job->status
        ]);
    }
}
