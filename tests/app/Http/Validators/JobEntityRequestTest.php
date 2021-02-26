<?php

use App\Http\Requests\JobEntityRequest;
use Illuminate\Validation\ValidationException;

use App\Models\Enums\StatusEnum;

class JobEntityRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider formDataProvider
     */
    public function testFormDataValidation($exceptionMessage, $value)
    {

        try {

            (new JobEntityRequest($value))
                ->setContainer(app())
                ->validateResolved();

            $this->assertTrue(true);

        } catch (ValidationException $e) {

            $messageError = $e->validator->getMessageBag()->first();

            if(!is_null($exceptionMessage)){
                $this->assertMatchesRegularExpression("/" . $exceptionMessage . "/i", $messageError);
            }else{
                $this->fail($messageError);
            }

        }

    }

    public function formDataProvider(){
        return [

            'shouldBeThrowExceptionIfIsNotSetTitle' => ['exceptionMessage' => 'title', 'value' => [
                'title' => NULL,
            ]],

            'shouldBeThrowExceptionIfDescriptionisLessThan5Characters' => ['exceptionMessage' => 'description', 'value' => [
                'title' => 'Lorem',
                'description' => 'Lore',
            ]],

            'shouldBeThrowExceptionIfStatusIsNotValidEnum' => ['exceptionMessage' => 'status', 'value' => [
                'title' => 'Lorem Ipsum is simply',
                'description' => 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum',
                'status' => 'dddd'
            ]],

            'shouldBeThrowExceptionIfWorkplaceIsANumber' => ['exceptionMessage' => 'workplace', 'value' => [
                'title' => 'Lorem Ipsum is simply',
                'description' => 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum',
                'status' => StatusEnum::FINISHED(),
                'workplace' => 1111119999999911,
            ]],

            'shouldBeThrowExceptionIfSalaryIsNotANumber' => ['exceptionMessage' => 'Salário', 'value' => [
                'title' => 'Lorem Ipsum is simply',
                'description' => 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum',
                'status' => StatusEnum::FINISHED(),
                'workplace' => 'Lorem Ipsum Lorem Ipsum',
                'salary' => 'AAAAA',
            ]],

            'shouldBeThrowExceptionIfSalaryNegative' => ['exceptionMessage' => 'maior que 0', 'value' => [
                'title' => 'Lorem Ipsum is simply',
                'description' => 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum',
                'status' => StatusEnum::FINISHED(),
                'workplace' => 'Lorem Ipsum Lorem Ipsum',
                'salary' => -1,
            ]],

            'shouldBeSuccesIfIsAValidData' => ['exceptionMessage' => null, 'value' => [
                'title' => 'Lorem Ipsum is simply',
                'description' => 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum',
                'status' => StatusEnum::FINISHED(),
                'workplace' => 'Lorem Ipsum Lorem Ipsum',
                'salary' => 500,
            ]],
        ];
    }
}
