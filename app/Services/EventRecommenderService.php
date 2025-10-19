<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Collection;

class EventRecommenderService
{
    public $embeddingService;

    // Weight configuration: 60% skills/interests, 40% location proximity
    private const SIMILARITY_WEIGHT = 0.6;
    private const DISTANCE_WEIGHT = 0.4;

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

        // Get user's location
        $userLat = $user->getCustomAttribute('latitude');
        $userLng = $user->getCustomAttribute('longitude');

        $recommendations = [];

        foreach ($events as $event) {
            $eventEmbedding = $this->embeddingService->toVector($event->embedding);
            if (empty($eventEmbedding) || count($eventEmbedding) !== count($userEmbedding)) {
                continue;
            }

            // Calculate similarity score (skills/interests match)
            $similarityScore = $this->embeddingService->cosineSimilarity($userEmbedding, $eventEmbedding);

            // Calculate distance score (location proximity)
            $distanceScore = $this->calculateDistanceScore($userLat, $userLng, $event->latitude, $event->longitude);

            // Combine scores with weights
            $finalScore = (self::SIMILARITY_WEIGHT * $similarityScore) + (self::DISTANCE_WEIGHT * $distanceScore);

            $recommendations[] = [
                'event' => $event,
                'score' => $finalScore,
                'similarity' => $similarityScore,
                'distance_score' => $distanceScore,
            ];
        }

        // Sort descending by final score
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);

        return collect($topN !== null ? array_slice($recommendations, 0, $topN) : $recommendations)
            ->pluck('event');
    }

    /**
     * Calculate distance score based on proximity (0-1, higher is better)
     */
    private function calculateDistanceScore($userLat, $userLng, $eventLat, $eventLng): float
    {
        // If user or event location is missing, return neutral score
        if (!$userLat || !$userLng || !$eventLat || !$eventLng) {
            return 0.5; // Neutral score when location data is missing
        }

        // Calculate distance in kilometers
        $distance = $this->calculateDistance($userLat, $userLng, $eventLat, $eventLng);

        // Normalize distance to 0-1 score (closer = higher score)
        return $this->normalizeDistance($distance);
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     * Returns distance in kilometers
     */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2): float
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Convert distance to normalized score (0-1)
     * Closer events get higher scores
     */
    private function normalizeDistance($distance): float
    {
        // Distance scoring:
        // 0-5km: score ~0.8-1.0 (very close)
        // 10km: score ~0.67 (close)
        // 20km: score ~0.5 (moderate)
        // 50km: score ~0.29 (far)
        // 100km+: score ~0.17 (very far)
        return 1 / (1 + $distance / 20);
    }
}
