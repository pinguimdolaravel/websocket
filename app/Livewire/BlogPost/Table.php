<?php

declare(strict_types = 1);

namespace App\Livewire\BlogPost;

use App\Models\BlogPost;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table as FilamentTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Table extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(FilamentTable $table): FilamentTable
    {
        return $table
            ->query(BlogPost::query())
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('body')->wrap(),
                Tables\Columns\IconColumn::make('status')
                    ->icon(fn (string $state): string => match ($state) {
                        'draft'     => 'heroicon-o-pencil',
                        'published' => 'heroicon-o-check-circle',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit')
                    ->url(fn (BlogPost $record): string => route('blog-posts.edit', $record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.blog-posts');
    }
}
