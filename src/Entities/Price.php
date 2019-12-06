<?php

namespace CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;

/**
 * This object represents a portion of the price for goods or services.
 *
 * @see https://core.telegram.org/bots/api#labeledprice
 */
class Price extends BaseEntity
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var int
     */
    protected $amount;

    /**
     * Price constructor.
     *
     * @param string $label
     * @param int    $amount
     */
    public function __construct(string $label, int $amount)
    {
        $this->label = $label;
        $this->amount = $amount;
    }

    /**
     * Create an entity from array.
     *
     * @param array $_arr Associative array.
     *
     * @return self
     */
    public static function fromArray(array $_arr): EntityInterface
    {
        return new self($_arr['label'], $_arr['amount']);
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
