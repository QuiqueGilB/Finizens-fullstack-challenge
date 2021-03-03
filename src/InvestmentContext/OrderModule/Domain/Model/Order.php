<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Model;

use DateTimeImmutable;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderStatus;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class Order
{
    private NumericId $id;
    private OrderType $orderType;
    private NumericId $portfolioId;
    private Shares $shares;
    private NumericId $allocationId;
    private OrderStatus $orderStatus;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;

    public function __construct(
        NumericId $orderId,
        OrderType $orderType,
        NumericId $portfolioId,
        NumericId $allocationId,
        Shares $shares,
        OrderStatus $orderStatus
    ) {
        $this->id = $orderId;
        $this->orderType = $orderType;
        $this->portfolioId = $portfolioId;
        $this->allocationId = $allocationId;
        $this->shares = $shares;
        $this->orderStatus = $orderStatus;

        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function id(): NumericId
    {
        return $this->id;
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    public function portfolioId(): NumericId
    {
        return $this->portfolioId;
    }

    public function allocationId(): NumericId
    {
        return $this->allocationId;
    }

    public function shares(): Shares
    {
        return $this->shares;
    }

    public function orderStatus(): OrderStatus
    {
        return $this->orderStatus;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function complete(): static
    {
        $this->orderStatus = OrderStatus::completed();
        $this->updatedAt = new DateTimeImmutable();
        return $this;
    }
}
