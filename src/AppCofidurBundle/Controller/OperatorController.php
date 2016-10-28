<?php
namespace AppCofidurBundle\Controller;

use AppCofidurBundle\Entity\User;
use AppCofidurBundle\Entity\Operator;
use AppCofidurBundle\Entity\OperatorFormation;
use AppCofidurBundle\Form\Type\OperatorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OperatorController extends Controller
{

    public function showAction($idOp)
    {
        $em = $this->getDoctrine()->getManager();

        $operator = $em->getRepository('AppCofidurBundle:User')->find($idOp);

        $operatorsFormations= $em->getRepository('AppCofidurBundle:OperatorFormation')->findAll();
        $formationsIds= [];
        $formationsStatus= [];

        /* Récupération des IDs des formations liées à l'opérateur $idOp */
        if (!$operatorsFormations){
            throw $this->createNotFoundException('Pas de formation en cours');
        }

        for ($i= 0; $i < count($formationsIds); ++$i){
            if ($idOp == $formationsIds[$i]->getOperator()->getId()){
                array_push($operatorsFormations, $formationsIds[$i]->getFormation()->getId());
                $formationsStatus[$i]= $formationsIds[$i]->getValidation();
            }
        }

        /* Récupération des formations de l'opérateur $idOp */
        $formations= array();
        if ($formationsIds){
            $repo= $em->getRepository('AppCofidurBundle:Formation');
            for ($i= 0; $i < count($formationsIds); ++$i){
                $formations[$i]= $repo->find($formationsIds[$i]);
            }

            if (!$operator) {
                throw $this->createNotFoundException('Pas d\'opérateur trouvé');
            }

        }

        return $this->render('AppCofidurBundle:Page/Operator:operator_show.html.twig', array(
            'operator'     => $operator,
            'formations'   => $formations,
            'formationsStatus' => $formationsStatus
        ));
    }

    public function showAllAction()
    {
        $em = $this->getDoctrine()->getRepository('AppCofidurBundle:User');

        $operators = $em->findAll();

        return $this->render('AppCofidurBundle:Page/Operator:operator_show_all.html.twig', array(
            'operators'      => $operators,
        ));
    }

    public function deleteAction($idOp)
    {
        $em = $this->getDoctrine()->getManager();

        $operator = $em->getRepository('AppCofidurBundle:User')->find($idOp);

        if (!$operator) {
            throw $this->createNotFoundException('Pas d\'objet');
        }

        $em->remove($operator);
        $em->flush();

        return $this->redirectToRoute('AppCofidurBundle_operator_show_all');
    }

    public function editAction(Request $request, $idOp)
    {
        $em = $this->getDoctrine()->getManager();

        $operator = $em->getRepository('AppCofidurBundle:User')->find($idOp);

        $form = $this->createForm(OperatorType::class, $operator);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operator = $form->getData();

            $em->persist($operator);
            $em->flush();

            return $this->redirectToRoute('AppCofidurBundle_operator_show_all');
        }

        return $this->render('AppCofidurBundle:Page/Operator:operator_edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function addAction(Request $request)
    {
        $operator = new User();

        $form = $this->createForm(OperatorType::class, $operator);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operator = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($operator);
            $em->flush();

            return $this->redirectToRoute('AppCofidurBundle_operator_show_all');
        }

        return $this->render('AppCofidurBundle:Page/Operator:operator_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
