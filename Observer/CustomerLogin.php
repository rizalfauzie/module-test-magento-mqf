<?php

namespace Sirclo\Notification\Observer;

class CustomerLogin implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\MessageQueue\PublisherInterface
     */
    private $publisher;

    /**
     * @param \Magento\Framework\MessageQueue\PublisherInterface $publisher
     */
    public function __construct(
        \Magento\Framework\MessageQueue\PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * Execute observer on customer logout
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $customer = $observer->getCustomer();
        $message = 'Customer ' . $customer->getName() . ' telah masuk ke website pada tanggal ' . date('j F Y H:i');

        logger('RUN CustomerLogin::execute');

        $this->publisher->publish('sirclo.notification.login', $message);
    }
}
