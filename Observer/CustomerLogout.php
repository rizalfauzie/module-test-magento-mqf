<?php

namespace Sirclo\Notification\Observer;

class CustomerLogout implements \Magento\Framework\Event\ObserverInterface
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
        logger('RUN CustomerLogout::execute');
        $customer = $observer->getCustomer();
        $message = [
            'customer_id' => $customer->getId(),
            'name' => $customer->getName(),
            'event' => 'logout',
            'date' => date('c')
        ];
        $this->publisher->publish('sirclo.notification.logout', json_encode($message));
    }
}
