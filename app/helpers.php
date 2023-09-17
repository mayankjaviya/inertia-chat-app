<?php

use App\Models\User;

function version()
    {
        if (config('app.asset_url')) {
            return md5(config('app.asset_url'));
        }

        if (file_exists($manifest = public_path('mix-manifest.json'))) {
            return md5_file($manifest);
        }

        if (file_exists($manifest = public_path('build/manifest.json'))) {
            return md5_file($manifest);
        }

        return null;
    }

    function currentLoginUser()
    {
        return auth()->user();
    }

    function AllUsers(){
        return User::where('id', '!=', auth()->id())->get()->toArray();
    }
