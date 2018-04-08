<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/02/2018
 * Time: 23:01
 */

namespace App\Controller\Api;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;

class UserLoginController extends DefaultController
{

    /**
     * @Rest\Post("/api/login")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="rewards")
     *
     */

    public function loginAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $Userrepo= $this->get('fos_user.user_manager');
        $User=$Userrepo->findUserByEmail($request->get('email'));

        if (! $User) {
            return $this->toResponse(array("Validation exception"),405);
        }

        $isValid = true;

        if (!$isValid) {
            return $this->toResponse(array("Invalid credentials"),403);
            //return  new View(array("code" => "403","message" => "Invalid credentials."), "403");

        }



        $arraydata=array(
            "user"=>$User,
            "token" => $User->getPublicKey()
        );

        return $this->toResponse($arraydata,200);
        //return $User->toArray();
    }


    /**
     * @Rest\Post("/api/register")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="rewards")
     *
     */
    public function registerAction(){

    }
}