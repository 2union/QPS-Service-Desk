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

class UsersController extends Controller
{

    /**
     * List of users
     *
     * @param Request $request
     */
    public function indexAction(Request $request)
    {

    }

    /**
     * Show user
     *
     * @param Request $request
     * @param $user_id
     */
    public function showAction(Request $request, $user_id)
    {
        //Redirect to profile looks user by self
    }

    /**
     * Add/Edit user
     *
     * @param Request $request
     * @param int $user_id
     */
    public function editAction(Request $request, $user_id = 0)
    {

    }

    /**
     * Remove user
     *
     * @param Request $request
     * @param int $user_id
     */
    public function removeAction(Request $request, $user_id)
    {

    }

    /**
     * Show self profile
     *
     * @param Request $request
     * @param int $user_id
     */
    public function profileAction(Request $request, $user_id)
    {

    }
}