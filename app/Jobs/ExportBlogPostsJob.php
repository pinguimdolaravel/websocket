<?php

declare(strict_types = 1);

namespace App\Jobs;

use App\Exports\BlogPostsExport;
use App\Models\Download;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportBlogPostsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public int $requester,
        public string $username
    ) {
    }

    public function handle(): void
    {
        $name = Str::uuid()->toString() . '-blog-posts.xlsx';

        Excel::store(
            export: new BlogPostsExport(),
            filePath: $name,
            disk: 'public'
        );

        Download::create([
            'user_id' => $this->requester,
            'link'    => $name,
        ]);

        sleep(2);

        // dispatch event
    }
}
