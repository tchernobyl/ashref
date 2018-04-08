<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/02/2018
 * Time: 23:01
 */

namespace App\Controller\Admin;

use App\Entity\Product;
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


class ProductController extends \App\Controller\Api\DefaultController
{


    /**
     * @Rest\Get("/api/admin/products")
     * @SWG\Response(
     *     response=200,
     *     description="this Api return the list of the products ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="products")
     *
     */

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class);
        //TODO add custom filter to the request

        $params = $this->getCustomFilters($request);
        $Result = $products->findAll();
        return $this->toResponse($Result, 200);

    }

    /**
     * @Rest\Post("/api/admin/product")
     * @SWG\Response(
     *     response=200,
     *     description="this Api create new product ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="products")
     *
     */
    public function createAction(Request $request)
    {

        /*
         * instantiate and deserialize new Product object
         */
        $objectFromContent = $this->getSerializedData(Product::class, $request->getContent());

        /*
         * save the product object into the database using doctrine ORM
         */
        $em = $this->getDoctrine()->getManager();
        $em->persist($objectFromContent);
        $em->flush();

        $view = View::create()->setStatusCode(200)
            ->setData(array('Product' => $objectFromContent));
        return $this->getViewHandler()->handle($view);

    }
    /**
     * @Rest\Put("/api/admin/product/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="product id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will update an existing product ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="products")
     *
     */
    public function updateProductAction(Request $request,ParamFetcherInterface $paramFetcher,$id){

        $ProjectFromDb=$this->update($request,$paramFetcher,$id,Product::class);

        $view = View::create()->setStatusCode(200)
            ->setData(array('Products' =>$ProjectFromDb));
        return $this->getViewHandler()->handle($view);
    }

    /**
     * @Rest\Delete("/api/admin/product/{id}")
     *
     * @REST\QueryParam(name="id", requirements="\d+", default="1", description="product id")
     * @SWG\Response(
     *     response=200,
     *     description="this Api will remove an existing product ",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=\stdClass::class, groups={"full"})
     *     )
     * )
     * @SWG\Tag(name="products")
     *
     */
    public function deleteAction(Request $request,ParamFetcherInterface $paramFetcher,$id){
        $this->delete($request,$paramFetcher,$id,Product::class);
        $view = View::create()->setStatusCode(200);
        return $this->getViewHandler()->handle($view);
    }


}