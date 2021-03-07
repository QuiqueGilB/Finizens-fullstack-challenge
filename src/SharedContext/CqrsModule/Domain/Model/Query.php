<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

class Query extends CQRS
{


    public function filters(): ?string
    {
        return $this->data['filters'] ?? null;
    }

    public function order(): ?string
    {
        return $this->data['order'] ?? null;
    }

    public function offset(): ?int
    {
        return $this->data['offset'] ?? null;
    }

    public function limit(): ?int
    {
        return $this->data['limit'] ?? null;
    }
}
