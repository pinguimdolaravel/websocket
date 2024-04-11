<?php

declare(strict_types = 1);

namespace App\Livewire\BlogPost;

use App\Events\PostCreatedEvent;
use App\Models\BlogPost;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ])
            ->statePath('data')
            ->model(BlogPost::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = auth()->user()->posts()->create($data);

        $this->form->model($record)->saveRelationships();

        PostCreatedEvent::dispatch(auth()->user()->username);

        $this->redirectRoute('blog-posts');
    }

    public function render(): View
    {
        return view('livewire.blog-post.create');
    }
}
