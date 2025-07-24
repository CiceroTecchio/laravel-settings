<?php

if (! function_exists('setting')) {
    function setting($key = null, $default = null, $centralId = null)
    {
        $setting = app('setting');
    
        if (isset($centralId) && $centralId != $setting->centralId) {
            $setting->centralId = $centralId;
            try {
                $setting->load(true);
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else if (!isset($centralId) && auth()->check() && isset(auth()->user()->central_id) && auth()->user()->central_id != $setting->centralId) {
            $setting->centralId = auth()->user()->central_id;
            try {
                $setting->load(true);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    
        if (is_array($key)) {
            $setting->set($key);
        } elseif (! is_null($key)) {
            return $setting->get($key, $default);
        }
    
        return $setting;
    }
}
