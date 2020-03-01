<?php

declare(strict_types=1);

namespace Monofony\Bundle\AdminBundle\Dashboard;

use Monofony\Bundle\AdminBundle\Dashboard\Statistics\StatisticInterface;
use Webmozart\Assert\Assert;

final class DashboardStatisticsProvider implements DashboardStatisticsProviderInterface
{
    /** @var iterable&StatisticInterface[] */
    private $statistics;

    public function __construct(iterable $statistics)
    {
        $this->statistics = $statistics;
    }

    public function getStatistics(): array
    {
        $statistics = [];
        foreach ($this->statistics as $statistic) {
            Assert::implementsInterface($statistic, StatisticInterface::class, sprintf('Class %s must implement %s', get_class($statistic), StatisticInterface::class));
            $statistics[] = $statistic->generate();
        }

        return $statistics;
    }
}