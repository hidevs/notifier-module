<?php

use Illuminate\Support\Facades\Route;

$proceduresFiles = array_map(
    fn ($path) => str_replace(['/', '.php'], ['\\', ''], 'Modules\Notifier\\'.explode('/app/', $path)[1]),
    glob(module_path('Notifier', 'app/Http/Procedures/Providers/*.php'))
);

Route::name('notifier.')->withoutMiddleware('web')->prefix('notifier')->group(function () use ($proceduresFiles) {
    Route::rpc('rpc', $proceduresFiles)->name('rpc');
    Route::get('rpc', fn () => response()->file(storage_path('app/private/notifier/rpc/docs/index.html')))->name('rpc.docs');
});
