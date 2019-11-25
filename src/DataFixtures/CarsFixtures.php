<?php

namespace App\DataFixtures;

use Faker\Factory; 
use App\Entity\Gallery;
use App\Entity\Occasions;
use Faker\Provider\Image;
use Cocur\Slugify\Slugify;
use App\DataFixtures\CarsFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class CarsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('Fr-fr');
        $slugify = new Slugify();



        for ($i=1; $i<=16  ; $i++) {

            $cars = new Occasions();
            $chMod= mt_rand(0,8);
            $chTransmi = mt_rand(0,1);
            $chCarbu = mt_rand(0,1);
            $transmi = ['manuelle','automatique'];
            $carbu = ['essence','diesel'];
            $carburant= $carbu[$chCarbu];
            $transmission= $transmi[$chTransmi];
            $modele = ['Giulia','Spider','Stelvio','Quadrifoglio','Tonale'];
            $modeleImg = ['https://pictures.dealer.com/n/napletonalfaromeoindianapolisfcaar/1746/ccac596ba0ee4d9c3581b623893018b0x.jpg'];
            
            $coverImage = $modeleImg[$chMod];
            $descri = '<p>' . join('</p><p>',$faker->paragraphs(5)).'</p>';
            $options = $faker->paragraph(2);
          
    
            


            $cars->setMarque('Alfa Romeo')
            
                 ->setModele($modele[$chMod])
                 ->setKm(mt_rand(550,20000))
                 ->setPrix(mt_rand(6000,20000))
                 ->setCylindree(mt_rand(100,700))
                 ->setPuissance(mt_rand(50,180))
                 ->setCarburant($carburant)
                 ->setAnneeCircu(mt_rand(1980,2019))
                 ->setTransmission($transmission)
                 ->setDescription($descri)
                 ->setOptions($options)
                 ->setNombreProprio(mt_rand(1,5))
                 ->setImgCouv($coverImage);

                 for($j=1; $j <= mt_rand(2,5) ; $j++){

                    $gallery = new Gallery();
    
                    $gallery->setUrl($faker->imageUrl())
                        ->setCaption($faker->sentence())
                        ->setOccasion($cars);
    
                    $manager->persist($gallery);
                }    
    
    
            $manager->persist($cars);


        

        }
        
         

            // $product = new Product();
            // $manager->persist($product);

        $manager->flush();
    }
}
