<?php

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RegisterNewJobTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::create([
            'name' => 'Leandro',
            'email' => 'leandro@gmail.com',
            'password' => '123456',
        ]);

        $this->user->token = '29994a4d5500bf8186d14ba532d79e5571715e0c';
        $this->user->save();

    }

    /**
     * Job display validation errors.
     *
     * @return void
     */
    public function testJobDisplaysValidationErrors()
    {
        $this->post('/job?token=' . $this->user->token , []);

        $this->assertResponseStatus(Response::HTTP_BAD_REQUEST);
        $this->seeJsonEquals([
            'message' => 'The given data was invalid.',
            'errors' => [
                'title' => ['The title field is required.'],
                'description' => ['The description field is required.'],
                'status' => ['The status field is required.']
            ]
        ]);
    }

    /**
     * I Can create a new job.
     *
     * @return void
     */
    public function testCanCreateANewJob()
    {
        $data = [
            'title' => 'PHP Developer',
            'description' => 'job description',
            'status' => 1
        ];

        $this->post('/job?token=' . $this->user->token, $data);

        $this->assertResponseStatus(Response::HTTP_CREATED);
        $this->seeJsonContains($data);
    }
}
