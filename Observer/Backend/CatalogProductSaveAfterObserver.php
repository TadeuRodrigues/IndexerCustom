<?php
declare(strict_types=1);

namespace TadeuRodrigues\IndexerCustom\Observer\Backend;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Indexer\IndexerRegistry;
use TadeuRodrigues\IndexerCustom\Model\Indexer\IndexerCustom;
use Psr\Log\LoggerInterface;

class CatalogProductSaveAfterObserver implements ObserverInterface
{
    /**
     * @var IndexerRegistry
     */
    protected IndexerRegistry $indexerRegistry;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param IndexerRegistry $indexerRegistry
     * @param LoggerInterface $logger
     */
    public function __construct(IndexerRegistry $indexerRegistry, LoggerInterface $logger)
    {
        $this->indexerRegistry = $indexerRegistry;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $indexer = $this->indexerRegistry->get(IndexerCustom::INDEXER_ID);

        if (!$indexer->isScheduled()) {
            $productId = $observer->getEvent()->getProduct()->getId();
            $this->logger->debug('indexing on save', [$productId]);

            if ($productId) {
                $this->indexerRegistry->get(IndexerCustom::INDEXER_ID)->reindexRow($productId);
            }
        }
    }
}
