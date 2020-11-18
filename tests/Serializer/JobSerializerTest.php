<?php
namespace App\Tests\Serializer;

use App\Entity\Job;
use App\Serializer\JobSerializer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\ContextAwareDecoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class JobSerializerTest extends TestCase
{
    /**
     * @var JobSerializer
     */
    private JobSerializer $jobSerializer;

    public function setUp(): void
    {
        $this->jobSerializer = new JobSerializer();
    }

    public function testInstanceOfContextAwareDecoderInterface(): void
    {
        $this->assertInstanceOf(ContextAwareDecoderInterface::class, $this->jobSerializer);
    }

    public function testInstanceOfContextAwareDenormalizerInterface(): void
    {
        $this->assertInstanceOf(ContextAwareDenormalizerInterface::class, $this->jobSerializer);
    }

    /**
     * @return array
     */
    public function validSupportsDecodingProvider(): array
    {
        return [
            'supports decoding' => [[Job::class, []], true],
            'does not supports decoding' => [[\stdClass::class, []], false]
        ];
    }

    /**
     * @param array $values
     * @param bool $expected
     *
     * @dataProvider validSupportsDecodingProvider
     */
    public function testSuccessSupportsDecoding(array $values, bool $expected): void
    {
        $this->assertSame($expected, $this->jobSerializer->supportsDecoding(...$values));
    }

    /**
     * @return array[]
     */
    public function validSupportsDenormalization(): array
    {
        return [
            'supports denormalization' => [[[], Job::class, null, []], true],
            'does not supports denormalization' => [[[], \stdClass::class, null, []], false]
        ];
    }

    /**
     * @param array $values
     * @param bool $expected
     *
     * @dataProvider validSupportsDenormalization
     */
    public function testSuccessSupportsDenormalization(array $values, bool $expected): void
    {
        $this->assertSame($expected, $this->jobSerializer->supportsDenormalization(...$values));
    }

    public function testSuccessDecode(): void
    {
        $this->assertIsArray($this->jobSerializer->decode('', Job::class, [], []));
    }

    /**
     * @return array
     */
    public function validDenormalizeProvider(): array
    {
        $data = [
            'title' => 'title',
            'description' => 'description',
            'status' => true,
            'workplace' => [
                'address' => 'address',
                'city' => 'city',
                'state' => 'state',
                'country' => 'country'
            ],
            'salary' => 100.0
        ];
        return [
            'null context' => [[$data, Job::class, null, [AbstractNormalizer::OBJECT_TO_POPULATE => null]]],
            'job context' => [[
                $data,
                Job::class,
                null,
                [AbstractNormalizer::OBJECT_TO_POPULATE => $this->createMock(Job::class)]
            ]],
            'not instance of job context' => [[
                $data,
                Job::class,
                null,
                [AbstractNormalizer::OBJECT_TO_POPULATE => new \stdClass()]
            ]],
            'without workplace' =>[[
                array_merge($data, ['workplace' => null]),
                Job::class,
                null,
                [AbstractNormalizer::OBJECT_TO_POPULATE => null]
            ]]
        ];
    }

    /**
     * @param array $params
     *
     * @dataProvider validDenormalizeProvider
     */
    public function testSuccessDenormalize(array $params): void
    {
        $this->assertInstanceOf(Job::class, $this->jobSerializer->denormalize(...$params));
    }
}