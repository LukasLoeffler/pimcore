<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Bundle\EcommerceFrameworkBundle\Model;

use Carbon\Carbon;
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\Fieldcollection;
use Pimcore\Model\Element\AbstractElement;

/**
 * Abstract base class for order pimcore objects
 */
abstract class AbstractOrder extends Concrete
{
    const ORDER_STATE_COMMITTED = 'committed';

    const ORDER_STATE_CANCELLED = 'cancelled';

    const ORDER_STATE_PAYMENT_PENDING = 'paymentPending';

    const ORDER_STATE_PAYMENT_INIT = 'paymentInit';

    const ORDER_STATE_PAYMENT_AUTHORIZED = 'paymentAuthorized';

    const ORDER_STATE_ABORTED = 'aborted';

    const ORDER_PAYMENT_STATE_ABORTED_BUT_RESPONSE = 'abortedButResponseReceived';

    abstract public function getOrdernumber(): ?string;

    abstract public function setOrdernumber(?string $ordernumber): static;

    abstract public function getSubTotalPrice(): ?string;

    abstract public function setSubTotalPrice(?string $subTotalPrice): static;

    abstract public function getSubTotalNetPrice(): ?string;

    abstract public function setSubTotalNetPrice(?string $subTotalPrice): static;

    abstract public function getTotalPrice(): ?string;

    abstract public function setTotalPrice(?string $totalPrice): static;

    abstract public function getTotalNetPrice(): ?string;

    abstract public function setTotalNetPrice(?string $totalPrice): static;

    abstract public function getTaxInfo(): array;

    abstract public function setTaxInfo(?array $taxInfo): static;

    abstract public function getOrderdate(): ?Carbon;

    abstract public function setOrderdate(?Carbon $orderdate): static;

    /**
     * @return AbstractOrderItem[]
     */
    abstract public function getItems(): array;

    /**
     * @param AbstractOrderItem[] $items
     */
    abstract public function setItems(?array $items): static;

    /**
     * @return AbstractOrderItem[]
     */
    abstract public function getGiftItems(): array;

    /**
     * @param AbstractOrderItem[] $giftItems
     */
    abstract public function setGiftItems(?array $giftItems): static;

    abstract public function getCustomer(): ?AbstractElement;

    abstract public function setCustomer(?AbstractElement $customer): static;

    abstract public function getPriceModifications(): ?Fieldcollection;

    abstract public function setPriceModifications(?Fieldcollection $priceModifications): static;

    abstract public function getOrderState(): ?string;

    abstract public function setOrderState(?string $orderState): static;

    abstract public function getCartId(): ?string;

    abstract public function setCartId(?string $cartId): static;

    abstract public function getPaymentInfo(): ?Fieldcollection;

    abstract public function setPaymentInfo(?\Pimcore\Model\DataObject\Fieldcollection $paymentInfo): static;

    abstract public function getPaymentProvider(): ?\Pimcore\Model\DataObject\Objectbrick;

    /**
     * returns latest payment info entry
     *
     * @return AbstractPaymentInformation|null
     */
    public function getLastPaymentInfo(): ?AbstractPaymentInformation
    {
        if ($this->getPaymentInfo()) {
            $items = $this->getPaymentInfo()->getItems();

            $item = end($items);

            if ($item instanceof AbstractPaymentInformation) {
                return $item;
            }
        }

        return null;
    }

    abstract public function getComment(): ?string;

    abstract public function setComment(?string $comment): static;

    abstract public function getCustomerEMail(): ?string;

    abstract public function setCustomerEMail(?string $customerEMail): static;

    abstract public function getCustomerCountry(): ?string;

    abstract public function setCustomerCountry(?string $customerCountry): static;

    abstract public function getCustomerCity(): ?string;

    abstract public function setCustomerCity(?string $customerCity): static;

    abstract public function getCustomerZip(): ?string;

    abstract public function setCustomerZip(?string $customerZip): static;

    abstract public function getCustomerStreet(): ?string;

    abstract public function setCustomerStreet(?string $customerStreet): static;

    abstract public function getCustomerCompany(): ?string;

    abstract public function setCustomerCompany(?string $customerCompany): static;

    abstract public function getCustomerFirstname(): ?string;

    abstract public function setCustomerFirstname(?string $customerFirstname): static;

    abstract public function getCustomerLastname(): ?string;

    abstract public function setCustomerLastname(?string $customerLastname): static;

    abstract public function getDeliveryCountry(): ?string;

    abstract public function setDeliveryCountry(?string $deliveryCountry): static;

    abstract public function getDeliveryCity(): ?string;

    abstract public function setDeliveryCity(?string $deliveryCity): static;

    abstract public function getDeliveryZip(): ?string;

    abstract public function setDeliveryZip(?string $deliveryZip): static;

    abstract public function getDeliveryStreet(): ?string;

    abstract public function setDeliveryStreet(?string $deliveryStreet): static;

    abstract public function getDeliveryCompany(): ?string;

    abstract public function setDeliveryCompany(?string $deliveryCompany): static;

    abstract public function getDeliveryFirstname(): ?string;

    abstract public function setDeliveryFirstname(?string $deliveryFirstname): static;

    abstract public function getDeliveryLastname(): ?string;

    abstract public function setDeliveryLastname(?string $deliveryLastname): static;

    public function hasDeliveryAddress(): bool
    {
        return
            ($this->getDeliveryFirstname() != '' || $this->getDeliveryLastname())
            && $this->getDeliveryStreet()
            && $this->getDeliveryCity()
            && $this->getDeliveryZip()
        ;
    }

    abstract public function setCurrency(?string $currency): static;

    abstract public function getCurrency(): ?string;

    /**
     * Get voucherTokens - Voucher Tokens
     *
     * @return \Pimcore\Model\DataObject\OnlineShopVoucherToken[]
     */
    abstract public function getVoucherTokens(): array;

    /**
     * Set voucherTokens - Voucher Tokens
     *
     * @param \Pimcore\Model\DataObject\OnlineShopVoucherToken[]|null $voucherTokens
     *
     * @return $this
     */
    abstract public function setVoucherTokens(?array $voucherTokens): static;

    /**
     * Get cartHash - Cart Hash
     *
     * @return int|null
     */
    abstract public function getCartHash(): ?int;

    /**
     * Set cartHash - Cart Hash
     *
     * @param int|null $cartHash
     *
     * @return $this
     */
    abstract public function setCartHash(?int $cartHash): static;

    /**
     * Set successorOrder - Successor Order
     *
     * @param AbstractOrder|null $successorOrder
     *
     * @return $this
     */
    abstract public function setSuccessorOrder(?\Pimcore\Model\Element\AbstractElement $successorOrder): static;
}
