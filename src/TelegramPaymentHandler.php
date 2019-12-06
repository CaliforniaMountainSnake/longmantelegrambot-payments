<?php

namespace CaliforniaMountainSnake\LongmanTelegrambotPayments;

use CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities\Invoice;
use CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities\PreCheckoutQuery;
use CaliforniaMountainSnake\LongmanTelegrambotPayments\Entities\SuccessfulPayment;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class intended for the processing telegram payments.
 *
 * @see https://core.telegram.org/bots/payments
 */
class TelegramPaymentHandler
{
    use LoggerAwareTrait;

    /**
     * TelegramPaymentHandler constructor.
     *
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param Invoice $_invoice
     *
     * @return ServerResponse
     * @throws \Psr\Log\InvalidArgumentException
     * @see https://core.telegram.org/bots/api#sendinvoice
     * @see https://core.telegram.org/bots/payments#supported-currencies
     * @see https://core.telegram.org/bots/api#labeledprice
     * @see https://core.telegram.org/bots/payments/currencies.json
     */
    public function sendInvoice(Invoice $_invoice): ServerResponse
    {
        // Get params.
        $params = $_invoice->toArray();
        $this->logger->debug('Raw Invoice', $params);

        // Send invoice.
        $response = Request::sendInvoice($params);

        $this->logger->debug('Raw sendInvoice telegram response', $response->getRawData());
        $this->logger->notice('Invoice has been sent', [
            'chat_id' => $_invoice->getChatId(),
            'title' => $_invoice->getTitle(),
            'description' => $_invoice->getDescription(),
        ]);
        return $response;
    }

    /**
     * @param Update   $_update
     *
     * @param callable $_result_callback The callback receive a PreCheckoutQuery object and returns an error text
     *                                   or null if all params are correct and the payment can be continued.
     *
     * @return ServerResponse|null
     * @throws \Psr\Log\InvalidArgumentException
     * @see https://core.telegram.org/bots/api#precheckoutquery
     * @see https://core.telegram.org/bots/api#answerprecheckoutquery
     */
    public function handlePreCheckoutQuery(Update $_update, callable $_result_callback): ?ServerResponse
    {
        $rawResponse = $_update->getPreCheckoutQuery();
        if ($rawResponse === null) {
            return null;
        }
        $this->logger->debug('Raw getPreCheckoutQuery telegram response', $rawResponse->getRawData());
        $preCheckoutQuery = PreCheckoutQuery::fromArray($rawResponse->getRawData());

        // Get callback result. Can we continue to execute a payment?
        $callbackErrorText = $_result_callback($preCheckoutQuery);
        $isError = $callbackErrorText !== null;
        $params = [
            'pre_checkout_query_id' => $preCheckoutQuery->getId(),
            'ok' => !$isError,
        ];

        // Answer for the query.
        if ($isError) {
            $errMsgArr = ['error_message' => $callbackErrorText];
            $response = Request::answerPreCheckoutQuery(\array_merge($errMsgArr, $params));
            $this->logger->error('PreCheckoutQuery has been declined', $errMsgArr);
        } else {
            $response = Request::answerPreCheckoutQuery($params);
            $this->logger->notice('PreCheckoutQuery has been received',
                [$preCheckoutQuery->getTotalAmount() . ' ' . $preCheckoutQuery->getCurrency()]);
        }

        return $response;
    }

    /**
     * @param Message  $_message
     * @param callable $_success_callback
     *
     * @return mixed|null   The return value of the callback.
     *                      Or null if the SuccessfulPayment doesn't exist in this message.
     * @throws \Psr\Log\InvalidArgumentException
     * @see https://core.telegram.org/bots/api#successfulpayment
     */
    public function handleSuccessfulPayment(
        Message $_message,
        callable $_success_callback
    ) {
        $rawResponse = $_message->getSuccessfulPayment();
        if ($rawResponse === null) {
            return null;
        }
        $this->logger->debug('Raw getSuccessfulPayment telegram response', $rawResponse->getRawData());

        $payment = SuccessfulPayment::fromArray($rawResponse->getRawData());
        $this->logger->notice('SuccessfulPayment has been received',
            [$payment->getTotalAmount() . ' ' . $payment->getCurrency()]);

        return $_success_callback($payment);
    }
}
