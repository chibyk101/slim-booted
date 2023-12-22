<?php

namespace App\Support;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class Validator
{
    /**
     * Create new validator instance
     */
    static function make(array|null $data, array $rules, array $messages = [], array $attributes = [])
    {
        $data = $data ?: [];

        $filesystem = new Filesystem();

        $loader = new FileLoader(
            $filesystem,
            __DIR__ . '/../../lang'
        );

        $loader->addNamespace(
            'lang',
            __DIR__ . '/../../lang'
        );

        $loader->load('en', 'validation', 'lang');

        $translator = new Translator($loader, 'en');

        $factory = new Factory($translator);

        return $factory->make(data: $data, rules: $rules, messages: $messages, attributes: $attributes);
    }
}
