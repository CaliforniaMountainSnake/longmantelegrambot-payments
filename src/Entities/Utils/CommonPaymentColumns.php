<?php

namespace CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities\Utils;

/**
 * The columns that are common in PreCheckoutQuery and SuccessfulPayment.
 *
 * @see https://core.telegram.org/bots/api#precheckoutquery
 * @see https://core.telegram.org/bots/api#successfulpayment
 */
trait CommonPaymentColumns
{
    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $total_amount;

    /**
     * @var string
     */
    protected $invoice_payload;

    /**
     * @var string|null
     */
    protected $shipping_option_id;

    /**
     * @var array|null
     */
    protected $order_info;

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->total_amount;
    }

    /**
     * @return string
     */
    public function getInvoicePayload(): string
    {
        return $this->invoice_payload;
    }

    /**
     * @return string|null
     */
    public function getShippingOptionId(): ?string
    {
        return $this->shipping_option_id;
    }

    /**
     * @return array|null
     */
    public function getOrderInfo(): ?array
    {
        return $this->order_info;
    }
}
