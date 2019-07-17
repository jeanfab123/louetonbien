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

    public function generateCode(string $char): void
    {
        $this->code = substr(md5($char), 0, 10) . $this->generateString(10);
    }

    public function generateSlug(string $char): void
    {
        $this->generateCode($char);
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($char . ' ' . $this->code);
    }
}
