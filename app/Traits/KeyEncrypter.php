<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

trait KeyEncrypter
{
    public static function encryptKey(int|string $key): string
    {
        return Crypt::encryptString((string) $key);
    }

    public function decryptKey(int|string $key): string
    {
        return Crypt::decryptString((string) $key);
    }

    public function getByKey(): int|string
    {
        $id = $this->{$this->getKeyName()};

        return config('crypt.crypt.active')
            ? $this->encryptKey($id)
            : $id;
    }

    /**
     * Find a model instance using a (possibly encrypted) key.
     *
     * If encryption is active, $key is expected to be an encrypted string and
     * will be decrypted before being used in the query. Returns null when
     * the key cannot be decrypted or the model is not found.
     *
     * @param string|int $key
     * @return ?Model
     */
    public static function findByKey(string|int $key): ?Model
    {
        $class = static::class;

        if (config('crypt.crypt.active')) {
            try {
                $id = Crypt::decryptString($key);
            } catch (\Throwable $e) {
                // Failed to decrypt -> treat as not found
                return null;
            }
        } else {
            $id = $key;
        }

        return $class::find($id);
    }

    /**
     * Resolve an id from a key (decrypt when necessary). Returns the raw id
     * (string) or null if decryption fails.
     *
     * @param string $key
     * @return int|string|null
     */
    public static function resolveIdFromKey(string $key): int|string|null
    {
        if (config('crypt.crypt.active')) {
            try {
                return Crypt::decryptString($key);
            } catch (\Throwable $e) {
                return null;
            }
        }

        return $key;
    }
}