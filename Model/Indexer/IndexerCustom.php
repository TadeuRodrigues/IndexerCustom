<?php
declare(strict_types=1);

namespace TadeuRodrigues\IndexerCustom\Model\Indexer;

use Magento\Framework\Indexer\IndexStructureInterface;
use Magento\Framework\Indexer\SaveHandler\IndexerInterface;
use Magento\framework\Indexer\SaveHandlerFactory;
use Psr\Log\LoggerInterface;

class IndexerCustom implements \Magento\Framework\Indexer\ActionInterface, \Magento\Framework\Mview\ActionInterface
{
    const INDEXER_ID = 'indexer_custom';

    /**
     * @var IndexStructureInterface
     */
    protected IndexStructureInterface $indexStructure;

    /**
     * @var SaveHandlerFactory
     */
    protected SaveHandlerFactory $saveHandlerFactory;

    /**
     * @var IndexerInterface
     */
    protected $saveHandler;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * todas as informacoes do indexer
     *
     * @var array
     */
    protected array $data;

    /**
     * Se eu add IndexStructureInterface ele vai trazer o structure declarada no indexer.xml
     *
     * @param IndexStructureInterface $indexStructure
     * @param SaveHandlerFactory $saveHandlerFactory
     * @param LoggerInterface $logger
     * @param array $data
     */
    public function __construct(
        IndexStructureInterface $indexStructure,
        SaveHandlerFactory $saveHandlerFactory,
        LoggerInterface $logger,
        array $data = []
    ) {
        $this->indexStructure = $indexStructure;
        $this->saveHandlerFactory = $saveHandlerFactory;
        $this->data = $data;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute($ids)
    {
        $this->logger->debug('call execute', [$ids]);
    }

    /**
     * @inheritDoc
     */
    public function executeFull()
    {
        \Magento\Framework\Profiler::start('exemplo');
        $this->logger->debug('call executeFull');
        //$this->indexStructure->delete(1, [], []);
        //$this->indexStructure->create(1, [], []);

        $this->getSaveHandler()->cleanIndex([]);
        \Magento\Framework\Profiler::stop('exemplo');
    }

    /**
     * @inheritDoc
     */
    public function executeList(array $ids)
    {
        $this->logger->debug('call executeList', [$ids]);
    }

    /**
     * @inheritDoc
     */
    public function executeRow($id)
    {
        $this->logger->debug('call executeRow', [$id]);
    }

    /**
     * precisa pois o data so recebe a className diferente do structure que ja chama a factory
     *
     * @return \Magento\Framework\Indexer\IndexerInterface|IndexerInterface
     */
    public function getSaveHandler()
    {
        if ($this->saveHandler == null) {
            $this->saveHandler = $this->saveHandlerFactory->create(
                $this->data['saveHandler'],
                [
                    'indexStructure' => $this->indexStructure,
                    'data' => $this->data
                ]
            );
        }

        return $this->saveHandler;
    }
}
