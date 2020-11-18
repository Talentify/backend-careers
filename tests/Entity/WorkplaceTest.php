<?php
namespace App\Tests\Entity;

use App\Entity\Workplace;
use App\Exceptions\EmptyException;
use App\Interfaces\DoctrineEntityInterface;
use PHPUnit\Framework\TestCase;

class WorkplaceTest extends TestCase
{
    /**
     * @var Workplace
     */
    private Workplace $workplace;

    public function setUp(): void
    {
        $this->workplace = new Workplace();
    }

    public function testInstanceOfDoctrineEntityInterface(): void
    {
        $this->assertInstanceOf(DoctrineEntityInterface::class, $this->workplace);
    }

    /**
     * @return array
     */
    public function validIdentifierProvider(): array
    {
        $randomIdentifier = rand(1);
        return [
            'random integer identifier' => [$randomIdentifier, $randomIdentifier]
        ];
    }

    /**
     * @return array
     */
    public function invalidIdentifierProvider(): array
    {
        return [
            'null identifier' => [null, EmptyException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validIdentifierProvider
     */
    public function testSuccessIdentifierGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Identifier');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidIdentifierProvider
     */
    public function testFailureSetIdentifier($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'Identifier');
    }

    /**
     * @return array
     */
    public function validStringProvider(): array
    {
        $randomString = str_repeat('a', rand(1));
        return [
            'random string' => [$randomString, $randomString]
        ];
    }

    public function invalidStringProvider(): array
    {
        return [
            'empty string' => ['', EmptyException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validStringProvider
     */
    public function testSuccessAddressGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'address');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidStringProvider
     */
    public function testFailureSetAddress($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'address');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validStringProvider
     */
    public function testSuccessCityGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'City');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidStringProvider
     */
    public function testFailureSetCity($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'City');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validStringProvider
     */
    public function testSuccessStateGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'State');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidStringProvider
     */
    public function testFailureSetState($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'State');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validStringProvider
     */
    public function testSuccessCountryGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Country');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidStringProvider
     */
    public function testFailureSetCountry($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'Country');
    }

    /**
     * @return array
     */
    public function validJsonSerializeProvider(): array
    {
        $completeValues = ['identifier' => 1, 'address' => 'address', 'city' => 'city', 'country' => 'country'];
        return [
            'complete' => [$completeValues, $completeValues]
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
            $this->workplace->$setMethod($value);
        }
        $json = $this->workplace->jsonSerialize();
        $this->assertIsArray($json);
        foreach ($expected as $key => $value) {
            $this->assertArrayHasKey($key, $json);
            $this->assertSame($value, $json[$key]);
        }
    }

    /**
     * @param string $value
     * @param string $expected
     * @param string $variable
     */
    private function assertSuccessGettersAndSetters(string $value, string $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $getMethod = 'get' . ucfirst($variable);
        $this->assertInstanceOf(Workplace::class, $this->workplace->$setMethod($value));
        $this->assertSame($expected, $this->workplace->$getMethod());
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
        $this->workplace->$setMethod($value);
    }
}