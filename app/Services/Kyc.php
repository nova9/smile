<?php

namespace App\Services;

use Aws\Exception\AwsException;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class Kyc
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getDateOfBirth($image1, $image2): ?string
    {
        $rekognition = new RekognitionClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $result1 = $rekognition->detectText([
            'Image' => [
                'Bytes' => $image1,
            ],
        ]);

        $result2 = $rekognition->detectText([
            'Image' => [
                'Bytes' => $image2,
            ],
        ]);

        $result = collect($result1['TextDetections'])
            ->merge($result2['TextDetections'])
            ->pluck('DetectedText');

        return self::extractDateOfBirth(implode(', ', $result->toArray()));
    }

    public static function isValid($source, $target): array
    {
        $isDocumentValid = self::checkLabels($source, ['Id Cards', 'Driving License', 'Passport']);

        Log::info('is valid');

        if (!$isDocumentValid) {
            return [false, 'The front image must contain a valid ID card, driving license, or passport.'];
        }

        $similarity = self::compareFaces($source, $target);

        Log::info('Similarity' . $similarity);

        if ($similarity > 80) {
            return [true, null];
        } else {
            return [false, 'The selfie does not match the front image of the document.'];
        }
    }

    protected static function extractDateOfBirth($text)
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini', // or gpt-4.1
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Extract the date of birth from the given text. Return only the date in ISO 8601 format (YYYY-MM-DD). If no date is found, return null.'
                ],
                [
                    'role' => 'user',
                    'content' => $text
                ],
            ],
        ]);

        return $response->choices[0]->message->content;
    }

    protected static function checkLabels($image, $desiredLabels = [])
    {
        $rekognition = new RekognitionClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $result = $rekognition->detectLabels(
            [
                'Image' => [
                    'Bytes' => $image,
                ],
                'MaxLabels' => 10,
                'MinConfidence' => 75,
            ]
        );

        $matchedLabels = collect($result['Labels'])
            ->pluck('Name')
            ->filter(function ($label) use ($desiredLabels) {
                return in_array($label, $desiredLabels);
            });

        return $matchedLabels->isNotEmpty();
    }

    protected static function compareFaces($source, $target)
    {
        try {
            $rekognition = new RekognitionClient([
                'version' => 'latest',
                'region' => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);


            $result = $rekognition->compareFaces([
                'SimilarityThreshold' => 80,
                'SourceImage' => ['Bytes' => $source],
                'TargetImage' => ['Bytes' => $target],
            ]);


            if (count($result['FaceMatches']) !== 1) {
                return 0;
            }

            return $result['FaceMatches'][0]['Similarity'] ?? 0;
        } catch (AwsException $e) {
            Log::error('AWS Rekognition error: ' . $e->getMessage());
            return 0; // Return 0 similarity in case of an error
        }
    }
}
