<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


return RectorConfig::configure()
    ->withParallel(
        600,
        64,
        32
    )
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/templates',
    ])
    ->withPreparedSets(
        typeDeclarations: true
    )->withSets([
        LevelSetList::UP_TO_PHP_84
    ])
    ->withConfiguredRule(AnnotationToAttributeRector::class, [
        new AnnotationToAttribute(UniqueEntity::class),
    ])
    ->withComposerBased(
        twig: true,
        doctrine: true,
        phpunit: true,
        symfony: true
    );