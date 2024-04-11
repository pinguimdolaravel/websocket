<?php

declare(strict_types = 1);

namespace App\Exports;

use App\Models\BlogPost;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class BlogPostsExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return BlogPost::all();
    }
}
