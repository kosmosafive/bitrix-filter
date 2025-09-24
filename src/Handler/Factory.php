<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\Localization\Loc;
use Kosmosafive\Bitrix\Filter\Field;
use Kosmosafive\Bitrix\Filter\Handler;

final class Factory
{
    public const string MODULE_ID = 'kosmosafive.filter';
    public const string EVENT_ON_CREATE = 'onCreateHandlerCollection';
    private HandlerCollection $handlerCollection;
    private static self $instance;

    private function __construct()
    {
        $this->handlerCollection = new HandlerCollection();

        $events = (new Event(
            self::MODULE_ID,
            self::EVENT_ON_CREATE,
        ));
        $events->send();

        foreach ($events->getResults() as $eventResult) {
            if ($eventResult->getType() !== EventResult::SUCCESS) {
                continue;
            }

            $parameters = $eventResult->getParameters();
            if (!is_array($parameters['handlerConfig'])) {
                $parameters['handlerConfig'] = [$parameters['handlerConfig']];
            }

            foreach ($parameters['handlerConfig'] as $handlerConfig) {
                if (!$handlerConfig instanceof HandlerConfig) {
                    continue;
                }

                $this->handlerCollection->add($handlerConfig);
            }
        }

        $this->handlerCollection
            ->add(new HandlerConfig(new Handler\ORM\Contains(), Field\Text::class))
            ->add(new HandlerConfig(new Handler\ORM\Range(), Field\IntegerRange::class))
            ->add(new HandlerConfig(new Handler\ORM\Range(), Field\DateRange::class))
            ->add(new HandlerConfig(new Handler\ORM\Equal(), Field\Select::class))
            ->add(new HandlerConfig(new Handler\ORM\Equal(), Field\Boolean::class))
            ->add(new HandlerConfig(new Handler\ORM\DatePeriod(), Field\DatePeriod::class));
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function create(
        string $queryBuilderType,
        Field\FieldInterface $field
    ): HandlerInterface {
        $instance = self::getInstance();

        return $instance->handlerCollection->get($queryBuilderType, (string) $field)
            ?? throw new \RuntimeException(
                Loc::getMessage(
                    'FILTER_HANDLER_NOT_FOUND',
                    [
                        '#TYPE#' => $queryBuilderType,
                        '#FIELD#' => (string) $field,
                    ]
                )
            );
    }
}
