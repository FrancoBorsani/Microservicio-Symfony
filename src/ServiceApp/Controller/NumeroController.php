<?php
namespace App\ServiceApp\Controller;
use App\ServiceApp\Repository\NumeroRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\ServiceApp\Entity\Numero;

/**
 * @Route("/apiService")
 */
class NumeroController extends AbstractController
{
    private $numeroRepository;

    public function __construct(NumeroRepository $numeroRepository)
    {
        $this->$numeroRepository = $numeroRepository;
    }

    /**
     * @Route("/numero", name="add_numero", methods={"POST"})
     */
    public function addNumero(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $numero = $data['numero'];

        $numeroRepository = $this->getDoctrine()->getRepository(Numero::class);

        $numeroRepository->saveNumero($numero);

        return new JsonResponse(['status' => 'Numero guardado!'], Response::HTTP_CREATED);
    }

}

?>