<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/02/2018
 * Time: 23:01
 */

namespace App\Controller\Admin;

use App\Entity\ShowRoom;
use FOS\RestBundle\Request\ParamFetcherInterface;
use  FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Finder\Exception\AccessDeniedException;


class ShowRoomController extends \App\Controller\Api\DefaultController
{


    /**
     * @Rest\Get("/api/admin/showrooms")
     * @SWG\Response(
     *     response=200,
     *     description="this Api return the list of the showrooms ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="showrooms")
     *
     */

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $showrooms = $em->getRepository(ShowRoom::class);
        //TODO add custom filter to the request

        $params = $this->getCustomFilters($request);
        $Result = $showrooms->findAll();
        return $this->toResponse($Result, 200);

    }

    /**
     * @Rest\Post("/api/admin/showroom")
     * @SWG\Response(
     *     response=200,
     *     description="this Api create new showroom ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="showrooms")
     *
     */
    public function createAction(Request $request)
    {

        /*
         * instantiate and deserialize new ShowRoom object
         */
        $objectFromContent = $this->getSerializedData(ShowRoom::class, $request->getContent());

        /*
         * save the showroom object into the database using doctrine ORM
         */
        $em = $this->getDoctrine()->getManager();
        $em->persist($objectFromContent);
        $em->flush();

        $view = View::create()->setStatusCode(200)
            ->setData(array('ShowRoom' => $objectFromContent));
        return $this->getViewHandler()->handle($view);

    }
    /**
     * @Rest\Put("/api/admin/showroom/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="showroom id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will update an existing showroom ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="showrooms")
     *
     */
    public function updateShowRoomAction(Request $request,ParamFetcherInterface $paramFetcher,$id){

        $ProjectFromDb=$this->update($request,$paramFetcher,$id,ShowRoom::class);

        $view = View::create()->setStatusCode(200)
            ->setData(array('ShowRooms' =>$ProjectFromDb));
        return $this->getViewHandler()->handle($view);
    }

    /**
     * @Rest\Delete("/api/admin/showroom/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="showroom id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will remove an existing showroom ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="showrooms")
     *
     */
    public function deleteAction(Request $request,ParamFetcherInterface $paramFetcher,$id){
        $this->delete($request,$paramFetcher,$id,ShowRoom::class);
        $view = View::create()->setStatusCode(200);
        return $this->getViewHandler()->handle($view);
    }


}