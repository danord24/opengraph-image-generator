<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;
use shweshi\OpenGraph\OpenGraph;
use Spatie\Browsershot\Browsershot;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ImageRequest $request)
    {
        $filename = sha1($request->url);

        if (Storage::disk('local')->exists($filename . '.png')) {
            return response(
                Storage::disk('local')->get($filename . '.png')
            )->header('Content-type', 'image/png');
        }

        $openGraph = new OpenGraph();
        $data = $openGraph->fetch($request->url);

        if (!$data['description'] && !$data['title']) {
            return response()->json([
                'error' => 'No meta data found',
                'messages' => ['No meta data found for the given URL. Please check the URL is active and has content.']
            ], 400);
        }

        $template = view('templates.clean', [
            'url' => $data['url'] ?? null,
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        $image = Browsershot::html($template)
            ->setNodeBinary(config('app.node_path'))
            ->setNpmBinary(config('app.npm_path'))
            ->windowSize(config('app.window_width'), config('app.window_height'))
            ->setOption('newHeadless', true)
            ->screenshot();

        Storage::disk('local')->put($filename . '.png', $image);

        return response($image)->header('Content-type', 'image/png');

    }
}
