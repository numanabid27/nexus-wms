<?php

namespace App\Support;

class Form
{
    // protected static function actionFromOptions(array $options): string
    // {
    //     if (isset($options['route'])) {
    //         return route($options['route'], $options['params'] ?? []);
    //     }

    //     if (isset($options['url'])) {
    //         return $options['url'];
    //     }

    //     return $options['action'] ?? '#';
    // }
    protected static function actionFromOptions(array $options): string
    {
        if (isset($options['route'])) {
            $route  = $options['route'];
            $params = $options['params'] ?? [];

            // If route is passed as ['route.name', param1, param2, ...]
            if (is_array($route)) {
                $params = array_merge($params, array_slice($route, 1));
                $route  = $route[0];   // first element is the route name
            }

            return route($route, $params);
        }

        if (isset($options['url'])) {
            return $options['url'];
        }

        return $options['action'] ?? '#';
    }

    public static function open(array $options = [])
    {
        $method = strtoupper($options['method'] ?? 'POST');
        $action = static::actionFromOptions($options);
    
        // Copy all options so we can strip out the special ones
        $attributes = $options;
    
        // Remove keys that are NOT HTML attributes
        unset($attributes['route'], $attributes['url'], $attributes['action'], $attributes['method']);
    
        // Handle numeric keys like ['novalidate'] (LaravelCollective style)
        foreach ($attributes as $key => $value) {
            if (is_int($key)) {
                // Turn 0 => 'novalidate' into 'novalidate' => true
                $attributes[$value] = true;
                unset($attributes[$key]);
            }
        }
    
        return html()
            ->form($method, $action)
            ->attributes($attributes)
            ->open();
    }

    public static function close()
    {
        return html()->form()->close();
    }

    public static function text(string $name, $value = null, array $attributes = [])
    {
        return html()->text($name, $value)->attributes($attributes);
    }

    public static function password(string $name, array $attributes = [])
    {
        return html()->password($name)->attributes($attributes);
    }

    public static function textarea(string $name, $value = null, array $attributes = [])
    {
        return html()->textarea($name, $value)->attributes($attributes);
    }

    public static function email(string $name, $value = null, array $attributes = [])
    {
        return html()->email($name, $value)->attributes($attributes);
    }

    public static function select(string $name, array $list = [], $selected = null, array $attributes = [])
    {
        return html()->select($name, $list, $selected)->attributes($attributes);
    }

    public static function submit(string $value = 'Submit', array $attributes = [])
    {
        return html()->submit($value)->attributes($attributes);
    }
    public static function hidden(string $name, $value = null, array $attributes = [])
    {
        return html()
            ->input('hidden', $name, $value)
            ->attributes($attributes);
    }
    public static function number(string $name, $value = null, array $attributes = [])
    {
        return html()
            ->input('number', $name, $value)
            ->attributes($attributes);
    }
}
