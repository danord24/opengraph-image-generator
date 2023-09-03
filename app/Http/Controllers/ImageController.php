<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use shweshi\OpenGraph\OpenGraph;
use Spatie\Browsershot\Browsershot;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'url' => ['required', 'string', 'active_url'],
        ]);

        if ($validator->fails()) {
            echo '<ul>';
            foreach ($validator->errors()->all() as $error) {
                echo "<li>$error</li>";
            }
            echo '<ul>';
            die();
        }

        $filename = sha1($request->url);

        if (Storage::disk('local')->exists($filename . '.png')) {
            return response(
                Storage::disk('local')->get($filename . '.png')
            )->header('Content-type', 'image/png');
        }

        $openGraph = new OpenGraph();
        $data = $openGraph->fetch($request->url);

        $template = view('templates.clean', [
            'url' => $data['url'] ?? null,
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        $image = Browsershot::html($template)
            // ->setNodeBinary('/usr/local/bin/node')
            // ->setNpmBinary('/usr/local/bin/npm')
            ->windowSize(1200, 640)
            ->screenshot();

        Storage::disk('local')->put($filename . '.png', $image);

        return response($image)->header('Content-type', 'image/png');

    }
}
