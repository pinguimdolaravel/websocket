<?php

declare(strict_types = 1);

namespace App\Livewire\BlogPost;

use App\Models\BlogPost;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public BlogPost $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Section::make([
                    TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->placeholder('Enter the title of the blog post'),
                    RichEditor::make('body')
                        ->label('Body')
                        ->required()
                        ->placeholder('Enter the body of the blog post'),
                    Select::make('status')
                        ->options([
                            'draft'     => 'Draft',
                            'published' => 'Published',
                        ]),
                ])->columnSpan(2),

                Section::make([

                    Placeholder::make('Created At')
                        ->content(fn (BlogPost $record): string => $record->created_at->toFormattedDateString()),

                    Placeholder::make('Created By')
                        ->content(fn (BlogPost $record): string => $record->user->name),

                ])->columnSpan(1),

            ])

            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.blog-post.edit');
    }
}
