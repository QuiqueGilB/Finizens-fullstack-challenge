<?php

namespace FinizensChallenge\SharedContext\CqrsModule\Domain\Model;

use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Criteria\Domain\ValueObject\Criteria as QuiqueGilBCriteria;

/** @method static static create */
class Criteria extends QuiqueGilBCriteria
{
    public function withFilter($filterGroup): static
    {
        return parent::withFilter($filterGroup ?: null);
    }

    public function withOrder($orderGroup): static
    {
        return parent::withOrder($orderGroup ?: null);
    }
}
