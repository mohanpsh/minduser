<?php
/*
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Company controller.
 *@Route("admin")
 *
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_homepage")
     *
     * @param Request $request Request
     *
     * @return Response
     */
    public function homepageAction(Request $request)
    {
        return $this->render('app/admin/dashboard.html.twig', []);
    }
}
