<?php
namespace App\Tests\Entity;

use App\Entity\Job;
use App\Entity\Workplace;
use App\Exceptions\EmptyException;
use App\Exceptions\TooLongException;
use App\Interfaces\DoctrineEntityInterface;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /**
     * @var Job
     */
    private Job $job;

    public function setUp(): void
    {
        $this->job = new Job();
    }

    public function testInstanceOfDoctrineEntityInterface(): void
    {
        $this->assertInstanceOf(DoctrineEntityInterface::class, $this->job);
    }

    /**
     * @return array
     */
    public function validIdentifierProvider(): array
    {
        $randomIdentifier = rand(1, 100);
        return [
            'random integer identifier' => [$randomIdentifier, $randomIdentifier]
        ];
    }

    /**
     * @param int $value
     * @param int $expected
     *
     * @dataProvider validIdentifierProvider
     */
    public function testSuccessIdentifierGetterAndSetter(int $value, int $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Identifier');
    }

    /**
     * @return array
     */
    public function validTitleProvider(): array
    {
        $titleUpTo256Characters = str_repeat('a', rand(1, 256));
        return [
            'non-empty string title' => ['title', 'title'],
            'string title with up to 256 characters' => [$titleUpTo256Characters, $titleUpTo256Characters]
        ];
    }

    /**
     * @return array
     */
    public function invalidTitleProvider(): array
    {
        return [
            'empty string title' => ['', EmptyException::class],
            'only space string title' => [str_repeat(' ', rand(1, 256)), EmptyException::class],
            'string title longer than 256 characters' => [str_repeat('a', rand(257, 357)), TooLongException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validTitleProvider
     */
    public function testSuccessTitleGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'title');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider invalidTitleProvider
     */
    public function testFailureSetTitle(string $value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'title');
    }

    /**
     * @return array
     */
    public function validDescriptionProvider(): array
    {
        $descriptionUpTo10000Characters = str_repeat('a', rand(1, 10000));
        return [
            'non-empty string description' => ['description', 'description'],
            'string description with up to 10000 characters' => [$descriptionUpTo10000Characters, $descriptionUpTo10000Characters]
        ];
    }

    /**
     * @return array
     */
    public function invalidDescriptionProvider(): array
    {
        return [
            'empty description' => ['', EmptyException::class],
            'only space string description' => [str_repeat(' ', rand(1, 10000)), EmptyException::class],
            'string title longer than 10000 characters' => [str_repeat('a', rand(10001, 10100)), TooLongException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validDescriptionProvider
     */
    public function testSuccessDescriptionGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'description');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider invalidDescriptionProvider
     */
    public function testFailureSetDescription(string $value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'description');
    }

    /**
     * @return array
     */
    public function validStatusProvider(): array
    {
        return [
            'active status' => [true, true],
            'inactive status' => [false, false]
        ];
    }

    /**
     * @param bool $value
     * @param bool $expected
     *
     * @dataProvider validStatusProvider
     */
    public function testSuccessStatusGetterAndSetter(bool $value, bool $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'status');
    }

    /**
     * @return array
     */
    public function validWorkplaceProvider(): array
    {
        $workplaceMock = $this->createMock(Workplace::class);
        return [
            'null workplace' => [null, null],
            'workplace class' => [$workplaceMock, $workplaceMock]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validWorkplaceProvider
     */
    public function testSuccessWorkplaceGetterAndSetter($value, $expected): void
    {
        $this->assertInstanceOf(Job::class, $this->job->setWorkplace($value));
        if ($value instanceof Workplace === false) {
            $this->assertSame($expected, $this->job->getWorkplace());
        } else {
            $this->assertInstanceOf(Workplace::class, $this->job->getWorkplace());
        }
    }

    /**
     * @return array
     */
    public function validSalaryProvider(): array
    {
        return [
            'float salary' => [1.1, 1.1],
            'integer salary' => [1, 1.0],
            'null salary' => [null, null]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validSalaryProvider
     */
    public function testSuccessSalaryGetterAndSetter($value, $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'salary');
    }

    /**
     * @return array
     */
    public function validJsonSerializeProvider(): array
    {
        $workplaceStub = $this->createStub(Workplace::class);
        $workplaceStub->method('jsonSerialize')
            ->will($this->returnValue([]));
        $completeValues = [
            'identifier' => 1,
            'title' => 'title',
            'description' => 'description',
            'status' => true,
            'workplace' => $workplaceStub,
            'salary' => 100.0
        ];
        $completeExpectedValue = [
            'identifier' => 1,
            'title' => 'title',
            'description' => 'description',
            'status' => true,
            'workplace' => [],
            'salary' => 100.0
        ];
        return [
            'complete' => [$completeValues, $completeExpectedValue],
            'without workplace' => [
                array_merge($completeValues, ['workplace' => null]),
                array_merge($completeExpectedValue, ['workplace' => null])
            ],
            'without salary' => [
                array_merge($completeValues, ['salary' => null]),
                array_merge($completeExpectedValue, ['salary' => null])
            ]
        ];
    }

    /**
     * @param $values
     * @param $expected
     *
     * @dataProvider validJsonSerializeProvider
     */
    public function testJsonSerialize($values, $expected): void
    {
        foreach ($values as $variable => $value) {
            $setMethod = 'set' . ucfirst($variable);
            $this->job->$setMethod($value);
        }
        $json = $this->job->jsonSerialize();
        $this->assertIsArray($json);
        foreach ($expected as $key => $value) {
            $this->assertArrayHasKey($key, $json);
            $this->assertSame($value, $json[$key]);
        }
    }

    /**
     * @param $value
     * @param $expected
     * @param string $variable
     */
    private function assertSuccessGettersAndSetters($value, $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $getMethod = 'get' . ucfirst($variable);
        $this->assertInstanceOf(Job::class, $this->job->$setMethod($value));
        $this->assertSame($expected, $this->job->$getMethod());
    }

    /**
     * @param $value
     * @param $expected
     * @param string $variable
     */
    private function assertFailureSetters($value, $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $this->expectException($expected);
        $this->job->$setMethod($value);
    }
}