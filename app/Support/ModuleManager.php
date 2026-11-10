<?php

namespace App\Support;

use App\Models\ModuleSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ModuleManager
{
    public static function all(): Collection
    {
        try {
            $db = ModuleSetting::query()->get()->keyBy('key');
            if ($db->isNotEmpty()) {
                return $db->map(fn (ModuleSetting $m) => [
                    'key' => $m->key,
                    'name' => $m->name,
                    'description' => $m->description,
                    'enabled' => (bool) $m->enabled,
                    'core' => (bool) $m->core,
                ]);
            }
        } catch (\Throwable) {
            // DB may not be ready during early boot
        }

        return collect(config('modules', []));
    }

    public static function enabled(string $key): bool
    {
        return (bool) (self::all()->get($key)['enabled'] ?? config("modules.{$key}.enabled", false));
    }

    public static function enabledKeys(): array
    {
        return self::all()->filter(fn ($m) => $m['enabled'] ?? false)->keys()->all();
    }

    public static function clearCache(): void
    {
        Cache::forget('hvacdocparse.modules');
    }
}
