<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\Ver;
use App\Entity\Response;
use App\Entity\ProfileXLike;
use App\Entity\ProfileXProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        /*
         * ======================
         * 1. PROFILES
         * ======================
         */
        $names = ['Alice', 'Bob', 'Charles', 'AbdulMalik'];
        $profiles = [];

        foreach ($names as $name) {
            $profile = new Profile();
            $profile->setUsername($name);
            $profile->setEmail(strtolower($name) . '@coda.fr');
            $profile->setPassword(password_hash('password', PASSWORD_BCRYPT));
            $profile->setBio($faker->sentence(10));
            $profile->setFollowers(0);
            $profile->setFollowing(0);

            $manager->persist($profile);
            $profiles[] = $profile;
        }
        $profile = new Profile();
        $profile->setUsername("Tom");
        $profile->setEmail('tom@coda.fr');
        $profile->setPassword('123456789');
        $profile->setBio($faker->sentence(10));
        $profile->setFollowers(0);
        $profile->setFollowing(0);

        $manager->persist($profile);
        $profiles[] = $profile;

        /*
         * ======================
         * 2. VERS
         * ======================
         */
        $vers = [];

        for ($i = 0; $i < 15; $i++) {
            $ver = new Ver();
            $ver->setContent($faker->realText(120));
            $ver->setDate($faker->dateTimeBetween('-10 days', 'now'));
            $ver->setLikes(0);
            $ver->setComments(0);
            $ver->setShares($faker->numberBetween(0, 5));

            $author = $profiles[array_rand($profiles)];
            $ver->setUserId($author);

            $manager->persist($ver);
            $vers[] = $ver;
        }

        /*
         * ======================
         * 3. FOLLOWERS
         * ======================
         */
        foreach ($profiles as $profile) {
            $others = array_values(array_filter(
                $profiles,
                fn ($p) => $p !== $profile
            ));

            $followedIndexes = array_rand($others, 2);

            foreach ($followedIndexes as $index) {
                $relation = new ProfileXProfile();
                $relation->setProfileOneId($profile);
                $relation->setProfileTwoId($others[$index]);

                $manager->persist($relation);

                $profile->setFollowing($profile->getFollowing() + 1);
                $others[$index]->setFollowers($others[$index]->getFollowers() + 1);
            }
        }

        /*
         * ======================
         * 4. LIKES
         * ======================
         */
        foreach ($profiles as $profile) {
            $likedVersIndexes = array_rand($vers, 5);

            foreach ($likedVersIndexes as $index) {
                $like = new ProfileXLike();
                $like->setProfileId($profile);
                $like->setVerId($vers[$index]);

                $vers[$index]->setLikes($vers[$index]->getLikes() + 1);

                $manager->persist($like);
            }
        }

        /*
         * ======================
         * 5. RESPONSES
         * ======================
         */
        $answeredVersIndexes = array_rand($vers, 10);

        foreach ($answeredVersIndexes as $index) {
            $response = new Response();
            $response->setVerId($vers[$index]);
            $response->setContent($faker->sentence(12));

            $vers[$index]->setComments($vers[$index]->getComments() + 1);

            $manager->persist($response);
        }

        $manager->flush();
    }
}
