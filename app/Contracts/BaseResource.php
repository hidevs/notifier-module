<?php

namespace Modules\Notifier\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;
use JetBrains\PhpStorm\ArrayShape;

class BaseResource extends JsonResource
{
    public function __construct($resource)
    {
        $this->additional(self::resourceAdditional());
        parent::__construct($resource);
    }

    #[ArrayShape(['code' => 'int', 'timestamp' => 'float|int|string'])]
    private static function resourceAdditional(): array
    {
        return [
            'code' => 200,
            'timestamp' => now()->timestamp,
        ];
    }

    public static function collection($resource): AnonymousResourceCollection
    {
        return parent::collection($resource)->additional(self::resourceAdditional());
    }

    public function toResponse($request): JsonResponse
    {
        $resourceResponse = new ResourceResponse($this)->toResponse($request);
        $resourceResponse->setStatusCode($this->additional['code']);

        return $resourceResponse;
    }
}
