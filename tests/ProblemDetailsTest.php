<?php declare(strict_types=1);

namespace HSkrasek\JSONSchema\Tests;

use HSkrasek\JSONSchema\ProblemDetails;
use PHPUnit\Framework\TestCase;

class ProblemDetailsTest extends TestCase
{
    /**
     * @test
     */
    public function itCorrectlyCreatesAProblemDetailsObjectWithExtensions()
    {
        $problemDetails = new ProblemDetails('title', 200, 'details', $extensions = [
            'extra-details' => [
                'foo',
                'bar',
            ],
        ]);

        $this->assertEquals($extensions, $problemDetails->getExtensions());
    }

    /**
     * @test
     */
    public function itDoesntOverrideDetailsWhenPassingExtensionsWithATitle()
    {
        $problemDetails = new ProblemDetails('title', 200, 'details', ['title' => 'bar', 'foo' => 'baz']);

        $this->assertEquals([
            'title'  => 'title',
            'status' => 200,
            'detail' => 'details',
            'foo'    => 'baz',
        ], $problemDetails->toArray());
    }
}
