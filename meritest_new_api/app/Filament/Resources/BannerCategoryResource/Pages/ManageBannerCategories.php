<?php

namespace App\Filament\Resources\BannerCategoryResource\Pages;

use App\Filament\Resources\BannerCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBannerCategories extends ManageRecords
{
    protected static string $resource = BannerCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
