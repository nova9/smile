<?php

namespace App\Services;

use App\Models\Favourites as ModelsFavorite;
use Illuminate\Support\Facades\Http;


class Favorite
{
    public $isfavorited;

    public function toggleFavorite(int $eventId, int $userId): bool
    {
        $favorite = ModelsFavorite::where('event_id', $eventId)
            ->where('user_id', $userId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return false;
        }

        ModelsFavorite::create([
            'event_id' => $eventId,
            'user_id' => $userId,
        ]);
        return true;
    }
}
