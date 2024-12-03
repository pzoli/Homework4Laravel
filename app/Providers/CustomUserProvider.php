<?php

namespace App\Providers;

use App\Models\User;
use App\utils\AuthFileUtils;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class CustomUserProvider implements UserProvider
{

    public function retrieveById($identifier)
    {
        $dirPath = config('backup_values.backup_path');
        $files = scandir($dirPath);
        foreach ($files as $file) {
            $filePath = $dirPath . '/' . $file;
            if (is_file($filePath)) {
                try {
                    $user = AuthFileUtils::readFile($filePath);
                    if ($user->id == $identifier) {
                        $locatedUser = new User();
                        foreach ($user as $key => $value) {
                            $locatedUser->{$key} = $value;
                        }
                        return $locatedUser;
                    }
                } catch (\Exception $e) {

                }
            }
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function retrieveByToken($identifier, #[\SensitiveParameter] $token)
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function updateRememberToken(Authenticatable $user, #[\SensitiveParameter] $token)
    {

    }

    /**
     * @inheritDoc
     */
    public function retrieveByCredentials(#[\SensitiveParameter] array $credentials)
    {
        $fileName = config('backup_values.backup_path') . $credentials['email'] . '.json';
        try {
            $userFromFile = AuthFileUtils::readFile($fileName);
        } catch (\Exception $e) {
            return null;
        }
        $user = new User();
        foreach ($userFromFile as $key => $value) {
            $user->$key = $value;
        }
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function validateCredentials(Authenticatable $user, #[\SensitiveParameter] array $credentials)
    {
        $userPassword = $user->password;
        $result = Hash::check($credentials['password'], $userPassword);
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
        if (Hash::needsRehash($user->getAuthPassword())) {
            $user->password = hash::make($credentials['password']);
        }
    }
}
