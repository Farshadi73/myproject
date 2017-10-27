<?php
/**
 * Created by PhpStorm.
 * User: farshadi
 * Date: 10/27/17
 * Time: 5:01 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Attachment;
use AppBundle\Entity\Document;
use AppBundle\Form\DocumentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Document controller.
 *
 * @Route("document")
 */
class DocumentController extends Controller
{
    const TARGET_DIR = '../myproject/src/AppBundle/upload/';

    /**
     * Lists all category entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Document:index.html.twig');
    }

    /**
     * Creates a new document entity.
     *
     * @Route("/new", name="document_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show', array('id' => $document->getId()));
        }

        return $this->render('AppBundle:Document:new.html.twig', array(
            'document' => $document,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Finds and displays a document entity.
     *
     * @Route("/{id}", name="document_show")
     * @Method("GET")
     */
    public function showAction(Document $document)
    {
        return $this->render('AppBundle:Document:show.html.twig', array(
            'document' => $document,
        ));
    }

}