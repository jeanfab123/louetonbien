<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;

trait EntitySlugTrait
{
    private function generateString(int $length, string $type = 'ALPHANUMERIC'): string
    {

        $numbers = '0123456789';
        $letters = 'abcdefghijklmnopqrstuvwxyz';

        if ($type == 'ALPHANUMERIC') {
            $chars = $numbers . $letters;
        } else if ($type == 'LETTERS') {
            $chars = $letters;
        }

        $charLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCharacter = $chars[mt_rand(0, $charLength - 1)];
            $randomString .= $randomCharacter;
        }

        return $randomString;
    }

    public function generateCode(): void
    {
        $this->code = $this->generateString(10);
    }

    public function generateSlug($char): void
    {
        $this->generateCode();
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($char . ' ' . $this->code);
    }
}
