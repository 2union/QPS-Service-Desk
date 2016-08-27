<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 27.08.16
 * Time: 17:56
 */

namespace JustOpen\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketsController extends Controller
{
    /**
     * List of tickets
     *
     * @param Request $request
     */
    public function indexAction(Request $request)
    {

    }

    /**
     * Show ticket
     *
     * @param Request $request
     * @param $ticket_id
     */
    public function showAction(Request $request, $ticket_id)
    {

    }

    /**
     * Add/Edit ticket
     *
     * @param Request $request
     * @param int $ticket_id
     */
    public function editAction(Request $request, $ticket_id = 0)
    {

    }

    /**
     * Remove ticket
     *
     * @param Request $request
     * @param int $ticket_id
     */
    public function removeAction(Request $request, $ticket_id)
    {

    }
}