<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'question',
        'answer',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }

    public function moveUp()
    {
        if ($this->order > 1) {
            $previousItem = static::where('category_id', $this->category_id)
                ->where('order', $this->order - 1)
                ->first();

            if ($previousItem) {
                $previousItem->order = $this->order;
                $previousItem->save();

                $this->order--;
                $this->save();
            }
        }
    }

    public function moveDown()
    {
        $nextItem = static::where('category_id', $this->category_id)
            ->where('order', $this->order + 1)
            ->first();

        if ($nextItem) {
            $nextItem->order = $this->order;
            $nextItem->save();

            $this->order++;
            $this->save();
        }
    }
} 