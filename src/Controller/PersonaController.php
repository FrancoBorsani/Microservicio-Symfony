<?php
namespace App\Controller;
use App\Repository\PersonaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Persona;


/**
 * @Route("/api")
 */
class PersonaController extends AbstractController
{
    private $PersonaRepository;

    public function __construct(PersonaRepository $PersonaRepository)
    {
        $this->PersonaRepository = $PersonaRepository;
    }

    /**
     * @Route("/person", name="add_person", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['nombre'];
        $lastname = $data['apellido'];

        if (empty($name) || empty($lastname)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $PersonaRepository = $this->getDoctrine()->getRepository(Persona::class);

    //    $entityManager = $this->getDoctrine()->getManager();
     //   $entityManager->persist($persona);
    //    $entityManager->flush();


        $PersonaRepository->savePerson($name, $lastname);

        return new JsonResponse(['status' => 'Person created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("person/{id}", name="get_one_person", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $person = $this->PersonaRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $person->getId(),
            'nombre' => $person->getNombre(),
            'apellido' => $person->getApellido(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("persons", name="get_all_persons", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $persons = $this->PersonaRepository->findAll();
        $data = [];

        foreach ($persons as $person) {
            $data[] = [
                'id' => $person->getId(),
                'nombre' => $person->getNombre(),
                'apellido' => $person->getApellido(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("person/{id}", name="update_person", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $person = $this->PersonaRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['nombre']) ? true : $person->setName($data['nombre']);
        empty($data['apellido']) ? true : $person->setType($data['apellido']);

        $updatedPerson = $this->PersonaRepository->updatePerson($person);

		return new JsonResponse(['status' => 'Person updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("person/{id}", name="delete_person", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $person = $this->PersonaRepository->findOneBy(['id' => $id]);

        $this->PersonaRepository->removePerso($person);

        return new JsonResponse(['status' => 'Person deleted'], Response::HTTP_OK);
    }
}

?>