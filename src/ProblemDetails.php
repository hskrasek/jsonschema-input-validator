<?php declare(strict_types=1);

namespace HSkrasek\JSONSchema;

final class ProblemDetails implements \JsonSerializable
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string|null
     */
    private $detail;

    /**
     * @var array
     */
    private $extensions;

    public function __construct(string $title, int $status, ?string $detail, array $extensions = [])
    {
        $this->title      = $title;
        $this->status     = $status;
        $this->detail     = $detail;
        $this->extensions = $extensions;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
                'title'  => $this->title,
                'detail' => $this->detail,
                'status' => $this->status,
            ] + $this->extensions;
    }
}
