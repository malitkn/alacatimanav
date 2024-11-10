<?php

namespace App\Models;

use App\Casts\ParseDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected string $translatedDateFormat = 'd M, Y';

    protected function casts(): array
    {
        return [
            'created_at' => ParseDateTime::class,
        ];
    }

    public function getTranslatedDateFormat(): string
    {
        return $this->translatedDateFormat;
    }
}
