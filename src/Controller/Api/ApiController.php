<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 19/02/2018
 * Time: 17:43
 */

namespace App\Controller\Api;


use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
class ApiController extends DefaultController
{
    /**
     * @Rest\Get("/api")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Parameter(
     *     name="user_id",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="rewards")
     *
     */

    public function indexAction(Request $request){
        return $this->toResponse( array($request->get("user_id")));
    }


    /**
     * @Rest\Get("/api3")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Parameter(
     *     name="user_id",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="rewards")
     *
     */

    public function index3Action(Request $request){
       echo 4444;exit;
    }
}