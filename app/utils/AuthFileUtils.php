<?php

namespace App\utils;

use Exception;
use Illuminate\Support\Facades\Log;
use JsonException;
use Nette\FileNotFoundException;

class AuthFileUtils
{
    /**
     * @throws Exception
     */
    public static function updateFile(array $request, $password):void {
        try {
            $userFileName = config('backup_values.backup_path').$request['email'].'.json';
            $user = self::readFile($userFileName);
            if ($password == null) {
                Log::debug("Update password is not set");
            } else {
                Log::debug("Update password is set");
                $user->password = $password;
            }
            $user->name = $request['name'];
            $user->birthday = $request['birthday'];
            $user->email = $request['email'];
            $user->updated_at = $request['updated_at'];
            $user->remember_token = $request['remember_token'];
            if ($request['email_verified_at'] !== null) {
                $user->email_verified_at = $request['email_verified_at'];
            }
            $content = json_encode($user);
            file_put_contents($userFileName, $content);
        } catch (FileNotFoundException $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @throws FileNotFoundException
     */
    public static function deleteFile(array $request):void {
        $userFileName = config('backup_values.backup_path').$request['email'].'.json';
        Log::debug("Delete file: ".$userFileName);
        if (!file_exists($userFileName)) {
            throw new FileNotFoundException("Backup file does not exist");
        } else {
            unlink($userFileName);
        }
    }
    public static function createFile(array $userData):void {
        $userFileName = config('backup_values.backup_path').$userData['email'].'.json';
        Log::debug("Create file: ".$userFileName);
        $content = json_encode($userData);
        file_put_contents($userFileName, $content);
    }

    /**
     * @throws FileNotFoundException
     * @throws JsonException
     */
    public static function readFile($fileName)
    {
        Log::debug("Read file: ".$fileName);
        if (!file_exists($fileName)) {
            throw new FileNotFoundException("Backup file does not exist");
        }
        $result = json_decode(file_get_contents($fileName));
        if ($result == null) {
            throw new JsonException("Backup file does not contain valid JSON");
        }
        return $result;
    }
}
