<?php

namespace App\Service\Http\Pagination\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PaginationRequest implements PaginationRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    #[Assert\Length(min: 1)]
    private mixed $page = 1;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    #[Assert\Length(min: 1, max: 1000)]
    private mixed $limit = 10;

    public function getPage(): mixed
    {
        return $this->page;
    }

    public function setPage(mixed $page): void
    {
        $this->page = $page;
    }

    public function getLimit(): mixed
    {
        return $this->limit;
    }

    public function setLimit(mixed $limit): void
    {
        $this->limit = $limit;
    }
}