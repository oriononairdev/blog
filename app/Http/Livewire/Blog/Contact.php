<?php

namespace App\Http\Livewire\Blog;

use App\Models\BlogMessage;
use Livewire\Component;

class Contact extends Component
{
    public $name;

    public $email;

    public $message;

    public function render()
    {
        return view('livewire.blog.contact');
    }

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function messages()
    {
        return [
            'name.required' => __('blog.contact.field.required'),
            'name.min' => __('blog.contact.name.min.2'),
            'email.required' => __('blog.contact.field.required'),
            'email.email' => __('blog.contact.email.valid'),
            'message.required' => __('blog.contact.field.required'),
            'message.min' => __('blog.contact.message.min.10'),
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitMessage()
    {
        BlogMessage::create($this->validate());
        $this->reset();
        session()->flash('success', __('blog.contact.success.message'));
    }
}
