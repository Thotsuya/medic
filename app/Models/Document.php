<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    public const DOCUMENT = 0;
    public const IMAGE = 1;

    protected $fillable = [
        'title', 'url', 'filetype'
    ];

    protected $appends = [
        'thumbnail_url',
        'original_url',
        'size',
        'type',
        'subtitle'
    ];

    public function documentable()
    {
        return $this->MorphTo();
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url('documents/' . $this->documentable_id . '/thumbnails/' . $this->url)
        );
    }

    public function originalUrl(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::url('documents/' . $this->documentable_id . '/' . $this->url)
        );
    }

    public function size(): Attribute
    {
        return new Attribute(
            get: fn() => $this->filetype == Document::DOCUMENT ?
                'p-5' : '',
        );
    }

    public function type(): Attribute
    {
        return new Attribute(
            get: fn() => $this->filetype == Document::DOCUMENT ?
                'Document' : 'Image',
        );
    }

    public function subtitle(): Attribute
    {
        return new Attribute(
            get: fn() => Str::limit($this->title, 25)
        );
    }
}
