<?php

namespace App\DTO\Book;

use App\Http\Requests\Book\UpdateRequest;
use Illuminate\Http\UploadedFile;


class UpdateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly float $price,
        public readonly int $items_in_stock,
        public readonly int $release_year,
        public readonly ?string $translator = null,
        public readonly int $genre_id,
        public readonly array $authors,
        public readonly ?UploadedFile $file = null,
    )
    {}

    public static function fromRequest(UpdateRequest $request): self
    {
        $request = $request->validated();

        $dto = new self(...$request);

        return $dto;
    }

}

