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
        $data = json_decode(file_get_contents(__DIR__ . '/stubs/horribly-wrong.json'));
        $schema = json_decode(file_get_contents(__DIR__ . '/stubs/schema.json'));

        $validator = new Validator($data, $schema);

        $problemDetails = $validator->getProblemDetails();

        $this->assertTrue($validator->fails());
        $this->assertInstanceOf(ProblemDetails::class, $problemDetails);
        var_dump(json_encode($problemDetails));
    }
}
