<?php

namespace App\Controller\Api\V1;

use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

#[Route('/api/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema(
 *     schema="projects",
 *     title="Projects",
 *     description="An array of projects",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Project")
 *     )
 * )
 */
class StrategyController
{

}