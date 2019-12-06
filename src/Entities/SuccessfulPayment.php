<?php

namespace CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;
use CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities\Utils\CommonPaymentColumns;

/**
 * This object contains basic information about a successful payment.
 *
 * @see https://core.telegram.org/bots/api#successfulpayment
 */
class SuccessfulPayment extends BaseEntity
{
    use CommonPaymentColumns;

    /**
     * @var string
     */
    protected $telegram_payment_charge_id;

    /**
     * @var string
     */
    protected $provider_payment_charge_id;

    /**
     * SuccessfulPayment constructor.
     *
     * @param string      $currency
     * @param int         $total_amount
     * @param string      $invoice_payload
     * @param string      $telegram_payment_charge_id
     * @param string      $provider_payment_charge_id
     * @param string|null $shipping_option_id
     * @param array|null  $order_info
     */
    public function __construct(
        string $currency,
        int $total_amount,
        string $invoice_payload,
        string $telegram_payment_charge_id,
        string $provider_payment_charge_id,
        ?string $shipping_option_id = null,
        ?array $order_info = null
    ) {
        $this->currency = $currency;
        $this->total_amount = $total_amount;
        $this->invoice_payload = $invoice_payload;
        $this->telegram_payment_charge_id = $telegram_payment_charge_id;
        $this->provider_payment_charge_id = $provider_payment_charge_id;
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
        return new self($_arr['currency'], $_arr['total_amount'], $_arr['invoice_payload'],
            $_arr['telegram_payment_charge_id'], $_arr['provider_payment_charge_id'],
            $_arr['shipping_option_id'] ?? null, $_arr['order_info'] ?? null);
    }

    /**
     * @return string
     */
    public function getTelegramPaymentChargeId(): string
    {
        return $this->telegram_payment_charge_id;
    }

    /**
     * @return string
     */
    public function getProviderPaymentChargeId(): string
    {
        return $this->provider_payment_charge_id;
    }
}
