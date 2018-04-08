<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 19/02/2018
 * Time: 17:51
 */

namespace App\Controller\Api;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class DefaultController extends FOSRestController
{

    /**
     * Forcer la réponse du serveur
     *
     * @param array $datarespense
     * @return mixed
     */
    public function toResponse($datarespense=array(),$status=200){
        $resp=array('success'=>true,'data'=>$datarespense);
        $view=new View($resp, $status);
        $view->setFormat('json');
        //$view->setTemplate("json.html.twig");
        //$view->setData(array("data"=>$datarespense));
        return $view;
        // Gestion de la réponse

    }

    public function getSerializedData($objectType,$data,$format='json'){
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $objectFromContent = $serializer->deserialize($data, $objectType, $format);
        return $objectFromContent;
    }

    public function getCustomFilters($request){
        $params=[];
        return $params;
    }
    public function update(Request $request, ParamFetcher $paramFetcher, $id,$repository, $format = "json")
    {


        $em = $this->getDoctrine()->getManager();
        $ObjectFromDb = $em->getRepository($repository)->find($id);


        $data = json_decode($request->getContent(), true);
        while (current($data)) {
            $ObjectFromDb->setOption(key($data), $data[key($data)]);
            next($data);
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $ObjectFromDb;
    }

    public function delete(Request $request, ParamFetcher $paramFetcher, $id,$repository, $format = "json"){
        $em = $this->getDoctrine()->getManager();
        $ObjectFromDb = $em->getRepository($repository)->find($id);



        $em->remove($ObjectFromDb);
        $em->flush();
        return true;
    }
    public function getSecureResourceAction()
    {
        # this is it
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        // [...]
    }

}