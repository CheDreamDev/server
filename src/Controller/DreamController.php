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
     * @param Request            $request
     * @param ValidatorInterface $validator
     *
     * @Route("/dreams/create", name="dreams_create")
     *
     * @Method("POST")
     *
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
        $date = new \DateTime('now');
        $dream->setCreatedAt($date->format('Y-d-m H:i'));
        $dream->setUpdatedAt($date->format('Y-d-m H:i'));
        $errors = $validator->validate($dream);
        if (count($errors) > 0) {
            return new JsonResponse(Response::HTTP_BAD_REQUEST);
        }

        $this->getDoctrine()->getManager()->persist($dream);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(Response::HTTP_OK);
    }

    /**
     * @param Request            $request
     * @param Dream              $dream
     * @param ValidatorInterface $validator
     *
     * @Route("/dreams/{id}", name="dreams_edit")
     *
     * @Method("PUT")
     *
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

        $response = new Response($jsonDream);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param Dream $dream
     *
     * @Route("/dreams/{id}", name="dreams_view")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function dreamView(Dream $dream)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $jsonDream = $serializer->serialize($dream, 'json');
        $response = new Response($jsonDream);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/dreams", name="dreams_list")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function dreamList()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $dreamList = $this->getDoctrine()
            ->getRepository(Dream::class)
            ->findAll();

        $jsonDream = $serializer->serialize($dreamList, 'json');
        $response = new Response($jsonDream);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param Dream $dream
     *
     * @Route("/dreams/{id}", name="dreams_delete")
     *
     * @Method("DELETE")
     *
     * @return JsonResponse
     */
    public function dreamDelete(Dream $dream)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($dream);
        $em->flush();

        return new JsonResponse(Response::HTTP_OK);
    }
}
