<?php
namespace App\Serializer;

use App\Entity\Job;
use App\Entity\Workplace;
use App\Exceptions\EmptyException;
use App\Exceptions\TooLongException;
use Symfony\Component\Serializer\Encoder\ContextAwareDecoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class JobSerializer implements ContextAwareDecoderInterface, ContextAwareDenormalizerInterface
{
    /**
     * @param string $format
     * @param array $context
     * @return bool
     */
    public function supportsDecoding(string $format, array $context = [])
    {
        return $format === Job::class;
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param string|null $format
     * @param array $context
     * @return bool
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return $type === Job::class;
    }

    /**
     * @param string $data
     * @param string $format
     * @param array $context
     * @return array
     */
    public function decode(string $data, string $format, array $context = [])
    {
        return (array) json_decode($data, true);
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param string|null $format
     * @param array $context
     * @return Job|array|object
     * @throws EmptyException
     * @throws TooLongException
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $job = $context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? null;
        if (is_null($job) || $job instanceof Job === false) {
            $job = new Job();
        }
        return $this->denormalizeJob($data, $job);
    }

    /**
     * @param array $data
     * @param Job $job
     * @return Job
     * @throws EmptyException
     * @throws TooLongException
     */
    private function denormalizeJob(array $data, Job $job): Job
    {
        return $job->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setStatus($data['status'])
            ->setWorkplace($this->denormalizeWorkplace($data['workplace'] ?? null))
            ->setSalary($data['salary']);
    }

    /**
     * @param array|null $data
     * @return Workplace|null
     * @throws EmptyException
     */
    private function denormalizeWorkplace(?array $data): ?Workplace
    {
        return (is_null($data) ? $data : (new Workplace())
            ->setAddress($data['address'])
            ->setCity($data['city'])
            ->setState($data['state'])
            ->setCountry($data['country']));
    }
}