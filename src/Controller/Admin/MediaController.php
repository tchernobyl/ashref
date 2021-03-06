<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/02/2018
 * Time: 23:01
 */

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Entity\User;
use FOS\RestBundle\Request\ParamFetcherInterface;
use  FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Finder\Exception\AccessDeniedException;


class MediaController extends \App\Controller\Api\DefaultController
{


    /**
     * @Rest\Get("/api/admin/medias")
     * @SWG\Response(
     *     response=200,
     *     description="this Api return the list of the medias ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="medias")
     *
     */

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $medias = $em->getRepository(Media::class);
        //TODO add custom filter to the request

        $params = $this->getCustomFilters($request);
        $Result = $medias->findAll();
        return $this->toResponse($Result, 200);

    }

    /**
     * @Rest\Post("/api/admin/media")
     * @SWG\Response(
     *     response=200,
     *     description="this Api create new media ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="medias")
     *
     */
    public function createAction(Request $request)
    {

        /*
         * instantiate and deserialize new Media object
         */
        $objectFromContent = $this->getSerializedData(Media::class, $request->getContent());

        /*
         * save the media object into the database using doctrine ORM
         */
        $em = $this->getDoctrine()->getManager();
        $em->persist($objectFromContent);
        $em->flush();

        $view = View::create()->setStatusCode(200)
            ->setData(array('Media' => $objectFromContent));
        return $this->getViewHandler()->handle($view);

    }
    /**
     * @Rest\Put("/api/admin/media/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="media id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will update an existing media ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="medias")
     *
     */
    public function updateMediaAction(Request $request,ParamFetcherInterface $paramFetcher,$id){

        $ProjectFromDb=$this->update($request,$paramFetcher,$id,Media::class);

        $view = View::create()->setStatusCode(200)
            ->setData(array('Medias' =>$ProjectFromDb));
        return $this->getViewHandler()->handle($view);
    }

    /**
     * @Rest\Delete("/api/admin/media/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="media id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will remove an existing media ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="medias")
     *
     */
    public function deleteAction(Request $request,ParamFetcherInterface $paramFetcher,$id){
        $this->delete($request,$paramFetcher,$id,Media::class);
        $view = View::create()->setStatusCode(200);
        return $this->getViewHandler()->handle($view);
    }


}