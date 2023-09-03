<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100">

<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
    <div class="max-w-[75rem] mx-auto flex-1">
        <div class="overflow-hidden shadow">
            <div id="banner" style="height: 640px" class="relative flex flex-col shadow bg-white max-w-full">

                <div class="flex-1 flex items-center border-[1em] border-cyan-600 bg-gray-900">
                    <div class="relative z-10 px-40 py-6 flex-1">
                        <p class="text-slate-400 font-mono text-base mt-8" id="url">
                            {{ $url ?? '' }}
                        </p>
                        <h2 class="font-semibold text-slate-200 text-6xl leading-tight" id="title">
                            {{ $title ?? '' }}
                        </h2>
                        <p class="text-slate-400 font-mono text-xl mt-8" id="description">
                            {{ $description ?? '' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
