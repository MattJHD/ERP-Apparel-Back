<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use JMS\Serializer\SerializerBuilder;

use AppBundle\Entity\Article_Solded;
use AppBundle\Entity\Article;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Description of ArticleSoldedController
 *
 * @author matthieudurand
 */
class ArticleSoldedController extends Controller{
    
    /**
     * @Route("/articles/solded")
     * @Method("GET")
     * @ApiDoc(
     *  description="Récupère la liste des articles vendu de l'application",
     *  filters={
     *      {"name"="articles_solded", "dataType"="string"}
     *  },
     *    output= { "class"=Article_Solded::class, "collection"=true, "groups"={"Article_Solded"} }
     * )
     */
    public function getArticlesAction(){
        //jms
        $serializer = SerializerBuilder::create()->build();

        $em = $this->getDoctrine()->getManager();
        $articleSolded = $em->getRepository(Article_Solded::class)->findAll();
        
        $data = $serializer->serialize($articleSolded, 'json');
        
        return new Response($data);
    }
    
    /**
     * 
     * @Method("POST")
     * @Route("/articles/solded")
     * @ApiDoc(
     *  description="Création d'un article vendu et décrémente Article",
     *  filters={
     *      {"name"="article solded", "dataType"="string"}
     *  },
     *    output= { "class"=Article_Solded::class}
     * )
     */
    public function postArticleSoldedAction(Request $request){
        $serializer = SerializerBuilder::create()->build();
        
        $em = $this->getDoctrine()->getManager();
        
        $jsonData = $request->getContent();
        
        $articleSolded = $serializer->deserialize($jsonData, Article_Solded::class, 'json');
        
        $thisArticleId = $articleSolded->getArticle()->getId();
        $tabQuantity = $em->getRepository(Article::class)->countArticleQuantity($thisArticleId);
        foreach($tabQuantity as $key=>$value){
            $thisArticleQuantity = $value['quantity'];
        }
        $newQuantity = $thisArticleQuantity -1 ;
        
        $errors = $this->get("validator")->validate($articleSolded);
       
        if(count($errors) == 0){
            
            $article = $em->merge($articleSolded->getArticle());
            $articleSolded->setArticle($article);
            
            $em->persist($articleSolded);
            $em->flush();
            $updateQuantity = $em->getRepository(Article::class)->decrementQuantityArticle($newQuantity, $thisArticleId);
            
            return new JsonResponse("OK POST");
        }else {
            return new JsonResponse("ERROR-NOT-VALID");
        }
    }
}
