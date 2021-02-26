<?php

use App\Http\Requests\JobActionRequest;
use Illuminate\Validation\ValidationException;

class JobActionRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider idProvider
     */
    public function testIdValidation($exception, $value)
    {
        if(!is_null($exception)){
            $this->expectException($exception);
        }

        $requestMock = \Mockery::mock(\Illuminate\Http\Request::class)
            ->makePartial()
            ->shouldReceive('all')
            ->once()
            ->andReturn(['id' => $value]);

        app()->instance('request', $requestMock->getMock());

        try {

            (new JobActionRequest())
                ->setContainer(app())
                ->validateResolved();

        } catch (ValidationException $e) {

            if(!is_null($exception)){
                throw $e;
            }

            $messageError = $e->validator->getMessageBag()->first();

            $this->fail($messageError);
        }

        $this->assertTrue(true);

    }

    public function idProvider(){
        return [
            'shouldBeThrowExceptionIfIsNotANumber' => ['exception' => ValidationException::class, 'value' => 'oi'],
            'shouldBeThrowExceptionIfEmpty' => ['exception' => ValidationException::class, 'value' => ''],
            'shouldBeThrowExceptionIfNull' => ['exception' => ValidationException::class, 'value' => null],
            'shouldBeThrowExceptionIfNegative' => ['exception' => ValidationException::class, 'value' => -1],
            'shouldBeSuccessIfIsANumber' => ['exception' => null, 'value' => 10],
        ];
    }
}
