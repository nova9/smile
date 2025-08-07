<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class EmbeddingService
{
    public function generateEmbedding(string $text): array
    {
        $response = OpenAI::embeddings()->create([
            'model' => 'text-embedding-3-small',
            'input' => $text,
        ]);

        return $response->embeddings[0]->embedding;
    }

    public function toVector($json): array
    {
        if (is_string($json)) {
            $decoded = json_decode($json, true);
            return is_array($decoded) ? $decoded : [];
        }

        return is_array($json) ? $json : [];
    }


    public function cosineSimilarity(array $a, array $b): float
    {
        $dot = 0.0;
        $magA = 0.0;
        $magB = 0.0;

        foreach ($a as $i => $val) {
            $dot += $val * $b[$i];
            $magA += $val ** 2;
            $magB += $b[$i] ** 2;
        }

        if ($magA == 0 || $magB == 0) return 0;

        return $dot / (sqrt($magA) * sqrt($magB));
    }
}
