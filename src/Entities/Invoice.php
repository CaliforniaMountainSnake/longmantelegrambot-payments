<?php

namespace CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\DatabaseEntities\EntityInterface;

/**
 * This object contains information about an invoice that will be sent to the user.
 *
 * @see https://core.telegram.org/bots/api#sendinvoice
 */
class Invoice extends BaseEntity
{
    /**
     * Unique identifier for the target private chat.
     *
     * @var string
     */
    protected $chat_id;

    /**
     * Product name, 1-32 characters.
     *
     * @var string
     */
    protected $title;

    /**
     * Product description, 1-255 characters.
     *
     * @var string
     */
    protected $description;

    /**
     * Bot-defined invoice payload, 1-128 bytes.
     * This will not be displayed to the user, use for your internal processes.
     *
     * @var string
     */
    protected $payload;

    /**
     * Payments provider token, obtained via Botfather.
     *
     * @var string
     */
    protected $provider_token;

    /**
     * Unique deep-linking parameter that can be used to generate this invoice when used as a start parameter.
     *
     * @var string
     */
    protected $start_parameter;

    /**
     * Three-letter ISO 4217 currency code, see more on currencies.
     *
     * @see https://core.telegram.org/bots/payments#supported-currencies
     * @var string
     */
    protected $currency;

    /**
     * Price breakdown, a list of components
     * (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     *
     * @var Price[]
     */
    protected $prices;

    /**
     * JSON-encoded data about the invoice, which will be shared with the payment provider.
     * A detailed description of required fields should be provided by the payment provider.
     *
     * @var string|null
     */
    protected $provider_data;

    /**
     * URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
     * People like it better when they see what they are paying for.
     *
     * @var string|null
     */
    protected $photo_url;

    /**
     * Photo size.
     *
     * @var int|null
     */
    protected $photo_size;

    /**
     * Photo width.
     *
     * @var int|null
     */
    protected $photo_width;

    /**
     * Photo height.
     *
     * @var int|null
     */
    protected $photo_height;

    /**
     * Pass True, if you require the user's full name to complete the order.
     *
     * @var bool|null
     */
    protected $need_name;

    /**
     * Pass True, if you require the user's phone number to complete the order.
     *
     * @var bool|null
     */
    protected $need_phone_number;

    /**
     * Pass True, if you require the user's email address to complete the order.
     *
     * @var bool|null
     */
    protected $need_email;

    /**
     * Pass True, if you require the user's shipping address to complete the order.
     *
     * @var bool|null
     */
    protected $need_shipping_address;

    /**
     * Pass True, if user's phone number should be sent to provider.
     *
     * @var bool|null
     */
    protected $send_phone_number_to_provider;

    /**
     * Pass True, if user's email address should be sent to provider.
     *
     * @var bool|null
     */
    protected $send_email_to_provider;

    /**
     * Pass True, if the final price depends on the shipping method.
     *
     * @var bool|null
     */
    protected $is_flexible;

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     *
     * @var bool|null
     */
    protected $disable_notification;

    /**
     * If the message is a reply, ID of the original message.
     *
     * @var int|null
     */
    protected $reply_to_message_id;

    /**
     * A JSON-serialized object for an inline keyboard.
     * If empty, one 'Pay total price' button will be shown. If not empty, the first button must be a Pay button.
     *
     * @var string|null
     */
    protected $reply_markup;

    /**
     * Invoice constructor.
     *
     * @param string      $chat_id
     * @param string      $title
     * @param string      $description
     * @param string      $payload
     * @param string      $provider_token
     * @param string      $start_parameter
     * @param string      $currency
     * @param Price[]     $prices
     * @param string|null $provider_data
     * @param string|null $photo_url
     * @param int|null    $photo_size
     * @param int|null    $photo_width
     * @param int|null    $photo_height
     * @param bool|null   $need_name
     * @param bool|null   $need_phone_number
     * @param bool|null   $need_email
     * @param bool|null   $need_shipping_address
     * @param bool|null   $send_phone_number_to_provider
     * @param bool|null   $send_email_to_provider
     * @param bool|null   $is_flexible
     * @param bool|null   $disable_notification
     * @param int|null    $reply_to_message_id
     * @param string|null $reply_markup
     */
    public function __construct(
        string $chat_id,
        string $title,
        string $description,
        string $payload,
        string $provider_token,
        string $start_parameter,
        string $currency,
        array $prices,
        ?string $provider_data = null,
        ?string $photo_url = null,
        ?int $photo_size = null,
        ?int $photo_width = null,
        ?int $photo_height = null,
        ?bool $need_name = null,
        ?bool $need_phone_number = null,
        ?bool $need_email = null,
        ?bool $need_shipping_address = null,
        ?bool $send_phone_number_to_provider = null,
        ?bool $send_email_to_provider = null,
        ?bool $is_flexible = null,
        ?bool $disable_notification = null,
        ?int $reply_to_message_id = null,
        ?string $reply_markup = null
    ) {
        $this->chat_id = $chat_id;
        $this->title = $title;
        $this->description = $description;
        $this->payload = $payload;
        $this->provider_token = $provider_token;
        $this->start_parameter = $start_parameter;
        $this->currency = $currency;
        $this->prices = $prices;
        $this->provider_data = $provider_data;
        $this->photo_url = $photo_url;
        $this->photo_size = $photo_size;
        $this->photo_width = $photo_width;
        $this->photo_height = $photo_height;
        $this->need_name = $need_name;
        $this->need_phone_number = $need_phone_number;
        $this->need_email = $need_email;
        $this->need_shipping_address = $need_shipping_address;
        $this->send_phone_number_to_provider = $send_phone_number_to_provider;
        $this->send_email_to_provider = $send_email_to_provider;
        $this->is_flexible = $is_flexible;
        $this->disable_notification = $disable_notification;
        $this->reply_to_message_id = $reply_to_message_id;
        $this->reply_markup = $reply_markup;
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
        return new self(
            $_arr['chat_id'],
            $_arr['title'],
            $_arr['description'],
            $_arr['payload'],
            $_arr['provider_token'],
            $_arr['start_parameter'],
            $_arr['currency'],
            $_arr['prices'],
            $_arr['provider_data'] ?? null,
            $_arr['photo_url'] ?? null,
            $_arr['photo_size'] ?? null,
            $_arr['photo_width'] ?? null,
            $_arr['photo_height'] ?? null,
            $_arr['need_name'] ?? null,
            $_arr['need_phone_number'] ?? null,
            $_arr['need_email'] ?? null,
            $_arr['need_shipping_address'] ?? null, $_arr['send_phone_number_to_provider'] ?? null,
            $_arr['send_email_to_provider'] ?? null,
            $_arr['is_flexible'] ?? null,
            $_arr['disable_notification'] ?? null,
            $_arr['reply_to_message_id'] ?? null,
            $_arr['reply_markup'] ?? null
        );
    }

    /**
     * @return string
     */
    public function getChatId(): string
    {
        return $this->chat_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getProviderToken(): string
    {
        return $this->provider_token;
    }

    /**
     * @return string
     */
    public function getStartParameter(): string
    {
        return $this->start_parameter;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Price[]
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @return string|null
     */
    public function getProviderData(): ?string
    {
        return $this->provider_data;
    }

    /**
     * @return string|null
     */
    public function getPhotoUrl(): ?string
    {
        return $this->photo_url;
    }

    /**
     * @return int|null
     */
    public function getPhotoSize(): ?int
    {
        return $this->photo_size;
    }

    /**
     * @return int|null
     */
    public function getPhotoWidth(): ?int
    {
        return $this->photo_width;
    }

    /**
     * @return int|null
     */
    public function getPhotoHeight(): ?int
    {
        return $this->photo_height;
    }

    /**
     * @return bool|null
     */
    public function getNeedName(): ?bool
    {
        return $this->need_name;
    }

    /**
     * @return bool|null
     */
    public function getNeedPhoneNumber(): ?bool
    {
        return $this->need_phone_number;
    }

    /**
     * @return bool|null
     */
    public function getNeedEmail(): ?bool
    {
        return $this->need_email;
    }

    /**
     * @return bool|null
     */
    public function getNeedShippingAddress(): ?bool
    {
        return $this->need_shipping_address;
    }

    /**
     * @return bool|null
     */
    public function getSendPhoneNumberToProvider(): ?bool
    {
        return $this->send_phone_number_to_provider;
    }

    /**
     * @return bool|null
     */
    public function getSendEmailToProvider(): ?bool
    {
        return $this->send_email_to_provider;
    }

    /**
     * @return bool|null
     */
    public function getIsFlexible(): ?bool
    {
        return $this->is_flexible;
    }

    /**
     * @return bool|null
     */
    public function getDisableNotification(): ?bool
    {
        return $this->disable_notification;
    }

    /**
     * @return int|null
     */
    public function getReplyToMessageId(): ?int
    {
        return $this->reply_to_message_id;
    }

    /**
     * @return string|null
     */
    public function getReplyMarkup(): ?string
    {
        return $this->reply_markup;
    }
}
