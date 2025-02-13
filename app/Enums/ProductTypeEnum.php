<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum ProductTypeEnum: string implements HasIcon, HasColor
{
    case DELIVERABLE = 'deliverable';
    case DOWNLOADABLE = 'downloadable';

    public function getIcon(): ?string
    {
        return match ($this) {
            self::DELIVERABLE => 'heroicon-m-truck',
            self::DOWNLOADABLE => 'heroicon-m-arrow-down-tray',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::DELIVERABLE => 'primary',
            self::DOWNLOADABLE => 'success',
        };
    }


    public static function options(): array
    {
        return [
            self::DELIVERABLE->value => 'Deliverable',
            self::DOWNLOADABLE->value => 'Downloadable',
        ];
    }




}
