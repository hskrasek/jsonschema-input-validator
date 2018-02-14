<?php declare(strict_types=1);

namespace HSkrasek\JSONSchema\Tests;

use HSkrasek\JSONSchema\ProblemDetails;
use HSkrasek\JSONSchema\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function itFailsAHorriblyWrongValidation()
    {
        $data   = json_decode(file_get_contents(__DIR__ . '/stubs/horribly-wrong.json'));
        $schema = json_decode(file_get_contents(__DIR__ . '/stubs/schema.json'));

        $validator = new Validator($data, $schema);

        $problemDetails = $validator->getProblemDetails();

        $this->assertTrue($validator->fails());
        $this->assertInstanceOf(ProblemDetails::class, $problemDetails);
        $this->assertArraySubset([
            'invalid-params' => [
                [
                    'name'        => '/foo',
                    'reason'      => 'The data must be a(n) string.',
                    'schema_path' => '/properties/foo/type',
                ],
                [
                    'name'        => '/bar',
                    'reason'      => 'The data must be a(n) integer.',
                    'schema_path' => '/properties/bar/type',
                ],
                [
                    'name'        => '/bar',
                    'reason'      => 'The number must be less than 5.',
                    'schema_path' => '/properties/bar/maximum',
                ],
                [
                    'name'        => '/baz/2',
                    'reason'      => 'The data must be a(n) string.',
                    'schema_path' => '/properties/baz/items/2/type',
                ],
            ],
        ], $problemDetails->toArray());
    }

    /**
     * @test
     */
    public function itPassesWhenTheDataIsCorrect()
    {
        $data   = json_decode(file_get_contents(__DIR__ . '/stubs/correct.json'));
        $schema = json_decode(file_get_contents(__DIR__ . '/stubs/schema.json'));

        $validator = new Validator($data, $schema);

        $this->assertFalse($validator->fails());
        $this->assertTrue($validator->passes());
    }
}
