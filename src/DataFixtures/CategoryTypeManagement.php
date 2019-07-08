<?php

namespace App\DataFixtures;

class CategoryTypeManagement
{

    private $othersParents = [];
    private $realCategoryName;

    public function extractOthersParents($categoryNameRaw)
    {

        $this->realCategoryName = $categoryNameRaw;

        $pattern = "/\[(.*?)\]/i";
        preg_match($pattern, $categoryNameRaw, $matches);

        $this->othersParents = [];
        if (isset($matches[1])) {
            $this->othersParents = explode('|', $matches[1]);
            if (isset($matches[0])) {
                $this->realCategoryName = trim(\str_replace($matches[1], '', $categoryNameRaw));
            }
        }
    }

    public function getOthersParents()
    {
        return $this->othersParents;
    }

    public function getRealCategoryName()
    {
        return $this->realCategoryName;
    }
}
