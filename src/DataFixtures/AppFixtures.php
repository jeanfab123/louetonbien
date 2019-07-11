<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Area;
use App\Entity\Rubric;
use App\Entity\Category;
use App\Entity\Item;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\DataFixtures\CategoryTypeManagement;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Tag;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements OrderedFixtureInterface
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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

        /********************************************/
        /********************************************/
        /*      STEP 2 : CREATE BASIC FIXTURES      */
        /********************************************/
        /********************************************/

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

            // -- Get All Users -- //

            $userRepository = $manager->getRepository(User::class);
            $allUsers = $userRepository->findAll();

            // -- Generate Random Items -- //

            for ($cpt = 0; $cpt <= mt_rand(0, 500); $cpt++) {

                $randUserKey = mt_rand(0, count($allUsers) - 1);

                $item = new Item();
                $item
                    ->setName($faker->sentence(15))
                    ->setDescription($faker->paragraph(15))
                    ->addCategory($category)
                    ->setUser($allUsers[$randUserKey]);
                $manager->persist($item);
            }
        }

        $manager->flush();

        /*****************************************************/
        /*****************************************************/
        /*      STEP 3 : CREATE SPECIFIC FIXTURES (GAME)     */
        /*****************************************************/
        /*****************************************************/

        // -- Create Game User

        $user = new User();
        $user->setUsername('gamer');
        $user->setEmail('gamer@demo.fr');
        $user->setPassword($this->encoder->encodePassword($user, 'mypassword'));
        $manager->persist($user);
        $manager->flush();

        // -- Find Game Rubric -- //

        $rubricRepository = $manager->getRepository(Rubric::class);
        $gameRubric = $rubricRepository->findOneBy(
            array('slug' => 'jeux-videos')
        );

        // -- Generate Standard Game Tags -- //

        $stdGameTags = ['plateforme', 'combat', 'western', 'football', 'guerre'];

        foreach ($stdGameTags as $thisStdGameTag) {
            $tag = new Tag();
            $tag
                ->setName($thisStdGameTag)
                ->setDescription($faker->paragraph(3))
                ->setUser($user);
            $manager->persist($tag);

            //$createdStdGameTags[$tag->getSlug()] = $tag;
        }

        $manager->flush();

        // -- Generate Game Tags for Game Rubric -- //

        $rubricGameTags = ['PS4', 'Xbox One', 'Xbox 360', 'Nintendo Switch', 'PS3', 'PC'];

        foreach ($rubricGameTags as $thisRubricGameTag) {
            $tag = new Tag();
            $tag
                ->setName($thisRubricGameTag)
                ->setDescription($faker->paragraph(3))
                ->setUser($user)
                ->addRubric($gameRubric);
            $manager->persist($tag);

            $createdRubricGameTags[] = $tag;
        }

        $manager->flush();

        // -- Find Game Category -- //

        $categoryRepository = $manager->getRepository(Category::class);
        $gameCategory = $categoryRepository->findOneBy(
            array('slug' => 'jeux')
        );

        // -- Generate Game Items in Game Category with Tags -- //

        $cptGameItems = 0;
        $gameItems[$cptGameItems]['name'] = "Tekken 7";
        $gameItems[$cptGameItems]['stdTagsSlug'] = ["combat"];
        $cptGameItems++;
        $gameItems[$cptGameItems]['name'] = "Fifa 19";
        $gameItems[$cptGameItems]['stdTagsSlug'] = ["football"];
        $cptGameItems++;
        $gameItems[$cptGameItems]['name'] = "Forza 6";
        $gameItems[$cptGameItems]['stdTagsSlug'] = ["course"];
        $cptGameItems++;
        $gameItems[$cptGameItems]['name'] = "Crash Bandicoot";
        $gameItems[$cptGameItems]['stdTagsSlug'] = ["plateforme"];
        $cptGameItems++;
        $gameItems[$cptGameItems]['name'] = "Red Dead Redemption";
        $gameItems[$cptGameItems]['stdTagsSlug'] = ["western"];
        $cptGameItems++;
        $gameItems[$cptGameItems]['name'] = "GTA V";
        $gameItems[$cptGameItems]['stdTagsSlug'] = [];
        $cptGameItems++;

        foreach ($gameItems as $thisGameItem) {

            // -- Select Random Tag Number to associate with game

            $randomTagsNb = mt_rand(1, count($createdRubricGameTags));
            $randGameTagsByKeyTemp = array_rand($createdRubricGameTags, $randomTagsNb);
            if (!is_array($randGameTagsByKeyTemp)) {
                $randGameTagsByKey = [$randGameTagsByKeyTemp];
            } else {
                $randGameTagsByKey = $randGameTagsByKeyTemp;
            }

            // -- Create Games

            $item = new Item();
            $item
                ->setName($thisGameItem['name'])
                ->setDescription($faker->paragraph(15))
                ->addCategory($gameCategory)
                ->setUser($user);

            // -- Add Game Tags for Game Rubric

            foreach ($randGameTagsByKey as $thisRandGameTagsByKey) {
                $item->addTag($createdRubricGameTags[$thisRandGameTagsByKey]);
            }

            $manager->persist($item);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
