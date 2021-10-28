<?php
declare(strict_types=1);

namespace TadeuRodrigues\IndexerCustom\Model\Indexer;

use Magento\Framework\Indexer\IndexStructureInterface;
use Magento\Framework\Search\Request\Dimension;
use Psr\Log\LoggerInterface;

class IndexStructure implements IndexStructureInterface
{
    public LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function delete($index, array $dimensions = [])
    {
        $this->logger->debug('call delete from structure', ['index' => $index, 'dimensions' => $dimensions]);
    }

    /**
     * @inheritDoc
     */
    public function create($index, array $fields, array $dimensions = [])
    {
        $this->logger->debug('call create from structure', ['create' => $index, 'dimensions' => $dimensions]);
    }
}
