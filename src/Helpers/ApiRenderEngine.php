<?php

namespace App\Helpers;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Pagerfanta\Pagerfanta;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiRenderEngine
{
    public static function renderData($results, array $fields): array
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $data = $serializer->normalize(
            $results instanceof Pagerfanta ? $results->getCurrentPageResults() : $results,
            null,
            [AbstractNormalizer::ATTRIBUTES => $fields]
        );

        if ($results instanceof Pagerfanta) {
            return [
                'data' => $data,
                'pager' => [
                    'count' => $results->getNbPages(),
                    'current' => $results->getCurrentPage(),
                    'next' => $results->hasNextPage() ? $results->getNextPage() : 0,
                    'previous' => $results->hasPreviousPage() ? $results->getPreviousPage() : 0,
                ],
            ];
        } elseif ($results instanceof SlidingPagination) {
            return [
                'data' => $data,
                'pager' => [
                    'count' => $results->getPageCount(),
                    'current' => $results->getPage(),
                    'next' => $results->getPageCount() === $results->getPage() ? 0 : $results->getPage() + 1,
                    'previous' => $results->getPage() === 1 ? 0 : $results->getPage() - 1,
                ],
            ];
        } else {
            return [
                'data' => $data
            ];
        }
    }
}