<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasPublicId
{
    public static function bootHasPublicId(): void
    {
        static::creating(function (Model $model): void {
            $model->public_id = $model->generatePublicId(); // @phpstan-ignore-line
        });
    }

    /**
     * @param  array<string>  $columns
     */
    public static function findByPublicId(string $publicId, array $columns = ['*']): ?static
    {
        return static::query()->select($columns)
            ->where((new static)->public_id, $publicId)
            ->first();
    }

    /**
     * @template TModel of Model
     *
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
     */
    public function scopeWherePublicId(Builder $query, string $publicId): Builder
    {
        return $query->where($this->public_id, $publicId);
    }

    public function generatePublicId(): string
    {
        return (string) Str::orderedUuid();
    }
}
