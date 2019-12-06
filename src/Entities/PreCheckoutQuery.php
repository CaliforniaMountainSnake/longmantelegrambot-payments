<?php

namespace CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;
use CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities\Utils\CommonPaymentColumns;

/**
 * This object contains information about an incoming pre-checkout query.
 *
 * @see https://core.telegram.org/bots/api#precheckoutquery
 */
class PreCheckoutQuery extends BaseEntity
{
    use CommonPaymentColumns;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $from;

    /**
     * PreCheckoutQuery constructor.
     *
     * @param string      $id
     * @param array       $from
     * @param string      $currency
     * @param int         $total_amount
     * @param string      $invoice_payload
     * @param string|null $shipping_option_id
     * @param array|null  $order_info
     */
    public function __construct(
        string $id,
        array $from,
        string $currency,
        int $total_amount,
        string $invoice_payload,
        ?string $shipping_option_id = null,
        ?array $order_info = null
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->currency = $currency;
        $this->total_amount = $total_amount;
        $this->invoice_payload = $invoice_payload;
        $this->shipping_option_id = $shipping_option_id;
        $this->order_info = $order_info;
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
        return new self($_arr['id'], $_arr['from'], $_arr['currency'], $_arr['total_amount'],
            $_arr['invoice_payload'], $_arr['shipping_option_id'] ?? null,
            $_arr['order_info'] ?? null);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getFrom(): array
    {
        return $this->from;
    }
}
