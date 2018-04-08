<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/02/2018
 * Time: 23:01
 */

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Entity\ShowRoom;
use App\Entity\User;
use FOS\RestBundle\Request\ParamFetcherInterface;
use  FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Finder\Exception\AccessDeniedException;


class GalleryController extends \App\Controller\Api\DefaultController
{


    /**
     * @Rest\Get("/api/admin/galleries")
     * @SWG\Response(
     *     response=200,
     *     description="this Api return the list of the galleries ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="galleries")
     *
     */

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $galleries = $em->getRepository(Gallery::class);
        //TODO add custom filter to the request

        $params = $this->getCustomFilters($request);
        $Result = $galleries->findAll();
        return $this->toResponse($Result, 200);

    }

    /**
     * @Rest\Post("/api/admin/gallery")
     * @SWG\Response(
     *     response=200,
     *     description="this Api create new gallery ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="galleries")
     *
     */
    public function createAction(Request $request)
    {

        /*
         * instantiate and deserialize new Gallery object
         */
        $objectFromContent = $this->getSerializedData(Gallery::class, $request->getContent());

        /*
         * save the gallery object into the database using doctrine ORM
         */
        $em = $this->getDoctrine()->getManager();
        $em->persist($objectFromContent);
        $em->flush();

        $view = View::create()->setStatusCode(200)
            ->setData(array('Gallery' => $objectFromContent));
        return $this->getViewHandler()->handle($view);

    }
    /**
     * @Rest\Put("/api/admin/gallery/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="gallery id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will update an existing gallery ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="galleries")
     *
     */
    public function updateGalleryAction(Request $request,ParamFetcherInterface $paramFetcher,$id){

        $ProjectFromDb=$this->update($request,$paramFetcher,$id,Gallery::class);

        $view = View::create()->setStatusCode(200)
            ->setData(array('Gallerys' =>$ProjectFromDb));
        return $this->getViewHandler()->handle($view);
    }

    /**
     * @Rest\Delete("/api/admin/gallery/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="gallery id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will remove an existing gallery ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="galleries")
     *
     */
    public function deleteAction(Request $request,ParamFetcherInterface $paramFetcher,$id){
        $this->delete($request,$paramFetcher,$id,Gallery::class);
        $view = View::create()->setStatusCode(200);
        return $this->getViewHandler()->handle($view);
    }


}