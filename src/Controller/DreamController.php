<?php

namespace App\Controller;

use App\Entity\Dream;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * Class DreamController
 */
class DreamController extends Controller
{
    /**
     * @Route("/dreams/create", name="dreams_create")
     * @Method("POST")
     * @return Response
     */
    public function create(Request $request, ValidatorInterface $validator)
    {
        $data = $request->getContent();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        /** @var Dream $dream */
        $dream = $serializer->deserialize($data, Dream::class, 'json');
        $dream->setCreatedAt(new \DateTime('now'));
        $dream->setUpdatedAt(new \DateTime('now'));
        $errors = $validator->validate($dream);
        if (count($errors) > 0) {
            return new JsonResponse(Response::HTTP_BAD_REQUEST);
        }

        $this->getDoctrine()->getManager()->persist($dream);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(Response::HTTP_OK);
    }

    /**
     * @Route("/dreams/edit/{id}", name="dreams_edit")
     * @Method("PUT")
     * @return Response
     */
    public function edit(Request $request, Dream $dream, ValidatorInterface $validator)
    {
        $data = $request->getContent();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $errors = $validator->validate($dream);

        if (count($errors) > 0) {
            return new JsonResponse(Response::HTTP_BAD_REQUEST);
        }
        $serializer->deserialize($data, Dream::class, 'json', array('object_to_populate' => $dream));

        $em = $this->getDoctrine()->getManager();
        $em->persist($dream);
        $em->flush();
        $jsonDream = $serializer->serialize($dream, 'json');


        return new JsonResponse(Response::HTTP_OK);
    }
}
