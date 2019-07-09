<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Area;
use App\Entity\Rubric;
use App\Entity\Category;
use App\Entity\Item;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\CategoryTypeManagement;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        /*************************************/
        /*************************************/
        /*      STEP 0 : Initialization      */
        /*************************************/
        /*************************************/

        $faker = Faker\Factory::create('fr_FR');
        $slugify = new Slugify();

        $categoriesFile = getcwd() . '/src/DataFixtures/datas/categories.txt';

        $area = [];
        $rubric = [];
        $category = [];

        if (\file_exists($categoriesFile)) {

            /*********************************/
            /*********************************/
            /*      STEP 1 : INIT DATAS      */
            /*********************************/
            /*********************************/

            // -- Open File -- //

            $file = fopen($categoriesFile, "r");

            $cptArea = 0;
            $cptRubric = 0;
            $cptCategory = 0;

            // -- Line by line -- //

            while (!feof($file)) {

                $line = fgets($file);
                preg_match('/^(\s+)/', $line, $matches);
                if (isset($matches[1])) {
                    $spaceNumber = strlen($matches[1]);
                } else {
                    $spaceNumber = 0;
                }

                $line = trim($line);
                $lineCharNumber = \strlen($line);

                // -- Areas -- //

                if (($spaceNumber == 0) && ($lineCharNumber > 0)) {

                    $cptArea++;
                    $area[$cptArea]['name'] = $line;
                    $area[$cptArea]['slug'] = $slugify->slugify($area[$cptArea]['name']);
                    $area[$cptArea]['descr'] = $faker->paragraph(8);
                }

                // -- Rubrics -- //

                if (($spaceNumber == 4) && ($lineCharNumber > 0)) {

                    $cptRubric++;

                    $CTManager = new CategoryTypeManagement;
                    $CTManager->extractOthersParents($line);
                    $rubric[$cptRubric]['name'] = $CTManager->getRealCategoryName();
                    $rubric[$cptRubric]['slug'] = $slugify->slugify(
                        $CTManager->getRealCategoryName()
                    );

                    $rubric[$cptRubric]['area-slug'] = $CTManager->getOthersParents();
                    array_push($rubric[$cptRubric]['area-slug'], $slugify->slugify($area[$cptArea]['slug']));

                    $rubric[$cptRubric]['descr'] = $faker->paragraph(8);
                }

                // -- Categories -- //

                if (($spaceNumber == 8) && ($lineCharNumber > 0)) {

                    $cptCategory++;

                    $CTManager = new CategoryTypeManagement;
                    $CTManager->extractOthersParents($line);
                    $category[$cptCategory]['name'] = $CTManager->getRealCategoryName();
                    $category[$cptCategory]['slug'] = $slugify->slugify(
                        $CTManager->getRealCategoryName()
                    );

                    $category[$cptCategory]['rubric-slug'] = $CTManager->getOthersParents();
                    array_push($category[$cptCategory]['rubric-slug'], $slugify->slugify($rubric[$cptRubric]['slug']));

                    $category[$cptCategory]['descr'] = $faker->paragraph(8);
                }
            }

            fclose($file);
        }

        /**************************************/
        /**************************************/
        /*      STEP 2 : CREATE FIXTURES      */
        /**************************************/
        /**************************************/

        // -- Generate Areas -- //

        foreach ($area as $value) {

            $area = new Area();
            $area->setTitle($value['name'])
                ->setSlug($value['slug'])
                ->setDescription($value['descr']);
            $manager->persist($area);
        }

        $manager->flush();

        // -- Generate Rubrics -- //

        $areaRepository = $manager->getRepository(Area::class);

        foreach ($rubric as $value) {

            $queryBuilder = $areaRepository->createQueryBuilder('area');
            $cptSlug = 1;
            foreach ($value['area-slug'] as $slugValue) {
                $queryBuilder->orWhere('area.slug = :areaSlug' . $cptSlug);
                $queryBuilder->setParameter('areaSlug' . $cptSlug, $slugValue);
                $cptSlug++;
            }

            $rubricArea = $queryBuilder->getQuery()->getResult();

            $rubric = new Rubric();
            $rubric
                ->setName($value['name'])
                ->setSlug($value['slug'])
                ->setDescription($value['descr']);

            foreach ($rubricArea as $thisRubricArea) {
                $rubric->addArea($thisRubricArea);
            }

            $manager->persist($rubric);
        }

        $manager->flush();

        // -- Generate Categories -- //

        $rubricRepository = $manager->getRepository(Rubric::class);

        foreach ($category as $value) {

            $queryBuilder = $rubricRepository->createQueryBuilder('rubric');
            $cptSlug = 1;
            foreach ($value['rubric-slug'] as $slugValue) {
                $queryBuilder->orWhere('rubric.slug = :rubricSlug' . $cptSlug);
                $queryBuilder->setParameter('rubricSlug' . $cptSlug, $slugValue);
                $cptSlug++;
            }

            $categoryRubric = $queryBuilder->getQuery()->getResult();

            $category = new Category();
            $category
                ->setName($value['name'])
                ->setSlug($value['slug'])
                ->setDescription($value['descr']);

            foreach ($categoryRubric as $thisCategoryRubric) {
                $category->addRubric($thisCategoryRubric);
            }

            $manager->persist($category);

            // -- Generate Random Items -- //

            for ($cpt = 0; $cpt <= mt_rand(0, 500); $cpt++) {
                $item = new Item();
                $item
                    ->setName($faker->sentence(15))
                    ->setDescription($faker->paragraph(15))
                    ->addCategory($category);
                $manager->persist($item);
            }
        }

        $manager->flush();
    }
}
