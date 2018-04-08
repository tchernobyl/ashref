<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/02/2018
 * Time: 23:01
 */

namespace App\Controller\Admin;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends \App\Controller\Api\DefaultController
{


    /**
     * @Rest\Post("/api/admin/login")
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
     * @SWG\Tag(name="admin")
     *
     */

    public function loginAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $Userrepo= $em->getRepository(User::class);
        $User=$Userrepo->findbyEmail($request->get('email'));
        if (! $User) {
            return $this->toResponse(array("Validation exception"),405);
        }

        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($User, $request->get('password'));

        if (!$isValid) {
            return $this->toResponse(array("Invalid credentials"),403);
            //return  new View(array("code" => "403","message" => "Invalid credentials."), "403");

        }

        //Update Public Key
        ///$User->setPublicKey(md5(time().uniqid()));
        $userManager = $this->get('fos_user.user_manager');
        $userManager->updateUser($User);

        $arraydata=array(
            "user"=>$User,
            // "token" => $User->getPublicKey()
        );

        return $this->toResponse($arraydata,200);
        //return $User->toArray();
    }


}