<?php

namespace App\Entities;


use App\Exceptions\InvalidArgumentException;

class Departure extends AbstractEntity
{
    /** @var string */
    protected $code;

    /** @var \DateTime */
    protected $starts;

    /** @var float */
    protected $price;

    /** @var integer */
    protected $discount;

    /**
     * Departure constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data) > 0) {
            $this->validate(['code', 'starts', 'price'], $data);

            $this->setCode($data['code']);
            $this->setStarts($data['starts']);
            $this->setPrice($data['price']);
            $this->setDiscount($data['discount'] ?? 0);
        }
    }

    /**
     * @return string
     * @throws InvalidArgumentException
     */
    public function getCode(): string
    {
        if (is_null($this->code)) {
            throw new InvalidArgumentException('The Code parameter is not set');
        }

        return $this->code;
    }

    /**
     * @param string $code
     * @return Departure
     */
    public function setCode(string $code): Departure
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStarts(): \DateTime
    {
        return $this->starts;
    }

    /**
     * @param string $starts
     * @return Departure
     */
    public function setStarts($starts): Departure
    {
        $this->starts = \DateTime::createFromFormat('m/d/Y', $starts)->setTime(00, 00, 00);

        return $this;
    }

    /**
     * @return float
     * @throws InvalidArgumentException
     */
    public function getPrice(): float
    {
        if (is_null($this->price)) {
            throw new InvalidArgumentException('The Price parameter is not set');
        }

        return $this->price;
    }

    /**
     * @param float $price
     * @return Departure
     */
    public function setPrice(float $price): Departure
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return (int)$this->discount;
    }

    /**
     * @param int $discount
     * @return Departure
     * @throws InvalidArgumentException
     */
    public function setDiscount(int $discount = 0): Departure
    {
        if ($discount < 0 || $discount > 100) {
            throw new InvalidArgumentException("Discount can't be more than 100 and less than 0");
        }

        $this->discount = $discount;

        return $this;
    }

    /**
     * Get price with discount
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        $totalPrice = $this->getPrice();

        $discount = $this->getDiscount();

        if ($discount > 0) {
            $totalPrice *= (1 - $discount / 100);
        }

        return floatval($totalPrice);
    }


}