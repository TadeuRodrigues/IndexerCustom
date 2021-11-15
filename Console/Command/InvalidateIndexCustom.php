<?php
declare(strict_types=1);

namespace TadeuRodrigues\IndexerCustom\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Indexer\IndexerRegistry;
use TadeuRodrigues\IndexerCustom\Model\Indexer\IndexerCustom;

class InvalidateIndexCustom extends Command
{
    /**
     * @var IndexerRegistry
     */
    protected IndexerRegistry $indexerRegistry;

    /**
     * @param IndexerRegistry $indexerRegistry
     * @param string|null $name
     */
    public function __construct(IndexerRegistry $indexerRegistry, string $name = null)
    {
        $this->indexerRegistry = $indexerRegistry;
        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('custom-index:invalidate-customIndex');
        $this->setDescription('n/a');
        parent::configure();
    }

    /**
     * CLI command description
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->indexerRegistry->get(IndexerCustom::INDEXER_ID)->invalidate();
        $output->writeln('index invalidated');
    }
}
