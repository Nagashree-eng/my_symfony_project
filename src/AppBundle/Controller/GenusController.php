<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GenusController extends Controller 
{
    /**
     * @Route("/genus")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genuses = $em->getRepository('AppBundle:Genus')
            ->findAll();
        
          return $this->render('genus/list.html.twig', [
            'genuses' => $genuses
        ]);
    }
    
   /**
     * @Route("/genus/new")
     */
    public function newAction()
    {
         $genus = new Genus();
        $genus->setName('Octopus'.rand(1, 100));
        $genus->setSubFamily('Octopodinae');
        $genus->setSpeciesCount(rand(100,99999));
        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();
    
         return new Response('<html><body>Genus created!</body></html>');
    }
 /**
  * @Route("/genus/{genusName}",name="genus_show")
  */
    public function showAction($genusName)
    {
        $em = $this->getDoctrine()->getManager();
         $genus = $em->getRepository('AppBundle:Genus')
                  ->findOneBy(['name' => $genusName]);
         
         
          if (!$genus) {
            throw $this->createNotFoundException('genus not found');
        }
//        $notes=[
//            'hi hru',
//            'i am fine','then whtzup'
//        ];
//        $funFact='Octopuses can change the color of their body in just *three-tenths* of a second!';
//        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
//        
//        $key = md5($funFact);
//        
//         if ($cache->contains($key)) {
//            $funFact = $cache->fetch($key);
//          
//        } else {
//           sleep(1);
//            $funFact = $this->get('markdown.parser')
//                ->transform($funFact);
//             
//            $cache->save($key, $funFact);
//             
//        }
         $this->get('logger')
               ->info('Showing genus :'. $genusName);        
         return $this->render('genus/show.html.twig', array(
            'genus' => $genus
        ));
       
//       return $this->render('genus/show.html.twig',
//               [
//            'name'=>$genusName,
//           'funFact'=>$funFact
//               ]);
//           'notes'=>$notes]);
//        return new Response($html);
    }
    /**
     * @Route("/genus/{genusName}/notes",name="genus_show_notes")
     * @Method("GET")
     */
    public  function getNotesAction()
    {
        $notes=[
            ['id'=>1, 'username'=>'AquaPelham','avatarUri'=>'images/leanna.jpeg','note'=>'hi hru'],
            ['id'=>2, 'username'=>'AquaWeaver','avatarUri'=>'images/ryan.jpeg','note'=>'i am fine'],
            ['id'=>3, 'username'=>'AquaPelham','avatarUri'=>'images/leanna.jpeg','note'=>'then wtzup'],
        ];
        
        $data=[
            'notes'=>$notes,
        ];
        return new JsonResponse($data);
    }
}
