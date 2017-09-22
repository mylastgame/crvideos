<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormController extends Controller
{
    /**
     * @Route("/form", name="form")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('personName', TextType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'sup meat',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()['personName'];
            $this->sendMail($name);
        }

        return $this->render('form/index.html.twig', [
            'myForm' => $form->createView()
        ]);
    }

    private function sendMail($name)
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject('new mail')
            ->setFrom('lul@lal.lu')
            ->setTo('kek@kkk.jk')
            ->setBody($name);

        $this->get('mailer')->send($mail);
    }

    /**
     * @Route("form/product", name="form_l2")
     * @param Request $request
     */
    public function productAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $product = $form->getData();

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'We saved product with id: ' . $product->getId());
        }

        return $this->render('form/index.html.twig', [
            'myForm' => $form->createView()
        ]);
    }

    /**
     * @Route("form/edit/{product}", name="form_edit")
     * @param Request $request
     */
    public function productEditAction(Request $request, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('info', 'We edited product with id: ' . $product->getId());
        }

        return $this->render('form/index.html.twig', [
            'myForm' => $form->createView()
        ]);
    }
}
