<?php

namespace Pushberryfinn\LaravelDomains;

class LaravelDomains
{
    public function domains(): array
    {
        $path = app_path(config('laravel-domains.path', 'Domains'));

        if (!is_dir($path)) {
            return [];
        }

        return array_values(array_map(
            'basename',
            array_filter(glob($path . '/*'), 'is_dir')
        ));
    }
}

