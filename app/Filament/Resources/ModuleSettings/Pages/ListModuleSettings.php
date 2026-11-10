<?php

namespace App\Filament\Resources\ModuleSettings\Pages;

use App\Filament\Resources\ModuleSettings\ModuleSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListModuleSettings extends ListRecords
{
    protected static string $resource = ModuleSettingResource::class;
}
