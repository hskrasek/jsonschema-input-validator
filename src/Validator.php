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

    public function getProblemDetails(): ProblemDetails
    {
        //TODO Implement method
    }
}
