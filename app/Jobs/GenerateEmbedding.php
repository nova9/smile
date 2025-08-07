<?php

namespace App\Jobs;

use App\Services\EmbeddingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateEmbedding implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels;

    protected string $modelClass;
    protected int|string $modelId;
    protected array $fieldsToEmbed;
    protected string $targetField;
    protected string $textToEmbed;

    /**
     * Create a new job instance.
     */
    public function __construct(Model $model, array $fieldsToEmbed = [], string $textToEmbed = '', string $targetField = 'embedding')
    {
        $this->modelClass = get_class($model);
        $this->modelId = $model->getKey();
        $this->fieldsToEmbed = $fieldsToEmbed;
        $this->targetField = $targetField;
        $this->textToEmbed = $textToEmbed;
    }

    /**
     * Execute the job.
     */
    public function handle(EmbeddingService $embeddingService): void
    {
        /** @var Model|null $model */
        $model = $this->modelClass::find($this->modelId);

        if (!$model) {
            return; // skip if model missing or no text
        }


        if ($this->textToEmbed) {
            $combinedText = $this->textToEmbed;
        } else {
            // Fallback to fields if no text provided
            $combinedText = collect($this->fieldsToEmbed)
                ->map(fn($field) => $model->{$field} ?? '')
                ->filter()
                ->implode("\n\n");
        }

        Log::info($combinedText);

        if (empty($combinedText)) {
            return; // no text to embed
        }

        $embedding = $embeddingService->generateEmbedding($combinedText);

        Log::info($combinedText);

        $model->update([
            $this->targetField => $embedding,
        ]);

        Log::info('done');
    }
}
