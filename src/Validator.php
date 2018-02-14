<?php declare(strict_types=1);

namespace HSkrasek\JSONSchema;

use League\JsonGuard\ValidationError;
use League\JsonGuard\Validator as JsonGuardValidator;
use Psr\Container\ContainerInterface;

class Validator
{
    /**
     * @var JsonGuardValidator
     */
    private $validator;

    /**
     * Validator constructor.
     *
     * @param mixed $data
     * @param object $schema
     * @param null|ContainerInterface $ruleSet
     */
    public function __construct($data, $schema, ?ContainerInterface $ruleSet = null)
    {
        $this->validator = new JsonGuardValidator($data, $schema, $ruleSet);
    }

    /**
     * Determines if the data passes schema validation.
     *
     * @return bool
     *
     * @throws \League\JsonGuard\Exception\InvalidSchemaException
     * @throws \League\JsonGuard\Exception\MaximumDepthExceededException
     */
    public function passes(): bool
    {
        return $this->validator->passes();
    }

    /**
     * Determines if the data does not pass schema validation.
     *
     * @return bool
     *
     * @throws \League\JsonGuard\Exception\InvalidSchemaException
     * @throws \League\JsonGuard\Exception\MaximumDepthExceededException
     */
    public function fails(): bool
    {
        return $this->validator->fails();
    }

    /**
     * @return array|ValidationError[]
     *
     * @throws \League\JsonGuard\Exception\InvalidSchemaException
     * @throws \League\JsonGuard\Exception\MaximumDepthExceededException
     */
    public function errors(): array
    {
        return $this->validator->errors();
    }

    /**
     * Get a Problem Details object describing the errors with the validated data
     *
     * @param null|string $title
     * @param int|null $status
     * @param null|string $detail
     *
     * @return ProblemDetails
     */
    public function getProblemDetails(
        ?string $title = null,
        ?int $status = null,
        ?string $detail = null
    ): ProblemDetails {
        return new ProblemDetails(
            $title ?? 'Provided data didn\'t validate',
            $status ?? 400,
            $detail,
            ['invalid-params' => $this->getContextForProblemDetails()]
        );
    }

    /**
     * @return mixed
     */
    private function getContextForProblemDetails(): array
    {
        return array_reduce($this->errors(), function (array $carry, ValidationError $error) {
            $carry[] = [
                'name'        => $error->getDataPath(),
                'reason'      => $error->getMessage(),
                'schema_path' => $error->getSchemaPath(),
            ];

            return $carry;
        }, []);
    }
}
