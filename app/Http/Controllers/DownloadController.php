<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Download;

class DownloadController extends Controller
{
    public function __invoke(Download $download)
    {
        return response()->download(public_path('storage/' . $download->link));
    }
}
