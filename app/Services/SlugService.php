<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugService
{
    /**
     * @param  class-string<Model>  $modelClass
     */
    public function unique(string $value, string $modelClass, string $column = 'slug', ?int $ignoreId = null): string
    {
        $base = $this->make($value);
        $slug = $base;
        $suffix = 2;

        while ($this->exists($modelClass, $column, $slug, $ignoreId)) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function make(string $value): string
    {
        $value = strtr($value, [
            'ç' => 'c', 'Ç' => 'c',
            'ğ' => 'g', 'Ğ' => 'g',
            'ı' => 'i', 'I' => 'i',
            'İ' => 'i',
            'ö' => 'o', 'Ö' => 'o',
            'ş' => 's', 'Ş' => 's',
            'ü' => 'u', 'Ü' => 'u',
        ]);

        return Str::of($value)
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '-')
            ->trim('-')
            ->whenEmpty(fn () => Str::of('sayfa'))
            ->toString();
    }

    /**
     * @param  class-string<Model>  $modelClass
     */
    private function exists(string $modelClass, string $column, string $slug, ?int $ignoreId): bool
    {
        $query = $modelClass::query()->where($column, $slug);

        if ($ignoreId !== null) {
            $query->whereKeyNot($ignoreId);
        }

        return $query->exists();
    }
}
