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
        }
    
        if (is_array($key)) {
            try {

                if (auth()->check() && auth()->id() == 11835) {
                    \Log::info(
                        "User set settings",
                        [
                            'key' => $key,
                            'defaulut' => $default,
                            'centralId' => $centralId,
                            'user' => auth()->user(),
                        ]
                    );
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
            $setting->set($key);
        } elseif (! is_null($key)) {
            return $setting->get($key, $default);
        }
    
        return $setting;
    }
}
