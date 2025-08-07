<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Collection;

class EventRecommenderService
{
    public $embeddingService;

    public function __construct(EmbeddingService $embeddingService)
    {
        $this->embeddingService = $embeddingService;
    }

    /**
     * @param Collection<Event> $events
     * */
    public function recommendEventsToUser(User $user, $events, ?int $topN = null): Collection
    {
        $userEmbedding = $this->embeddingService->toVector($user->embedding);
        if (empty($userEmbedding)) return new Collection();

        $recommendations = [];

        foreach ($events as $event) {
            $eventEmbedding = $this->embeddingService->toVector($event->embedding);
            if (empty($eventEmbedding) || count($eventEmbedding) !== count($userEmbedding)) {
                continue;
            }

            $similarity = $this->embeddingService->cosineSimilarity($userEmbedding, $eventEmbedding);
            $recommendations[] = [
                'event' => $event,
                'score' => $similarity,
            ];
        }

        // Sort descending by similarity score
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);

        return collect($topN !== null ? array_slice($recommendations, 0, $topN) : $recommendations)
            ->pluck('event');
    }
}
