<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GenusController extends Controller 
{
 /**
  * @Route("/genus/{genusName}")
  */
    public function showAction($genusName)
    {
//        $notes=[
//            'hi hru',
//            'i am fine','then whtzup'
//        ];
        $funFact='Octopuses can change the color of their body in just *three-tenths* of a second!';
        $funFact=$this->container->get('markdown.parser');
       return $this->render('genus/show.html.twig',[
            'name'=>$genusName,
           'funFact'=>$funFact
               ]);
//           'notes'=>$notes]);
//        return new Response($html);
    }
    /**
     * @Route("/genus/{genusName}/notes",name="genus_show_notes")
     * @Method("GET)
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
