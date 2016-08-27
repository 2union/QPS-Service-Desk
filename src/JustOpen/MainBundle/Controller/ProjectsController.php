<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 27.08.16
 * Time: 18:14
 */

namespace JustOpen\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectsController extends Controller
{
    /**
     * List of projects
     *
     * @param Request $request
     */
    public function indexAction(Request $request)
    {

    }

    /**
     * Show project
     *
     * @param Request $request
     * @param $project_id
     */
    public function showAction(Request $request, $project_id)
    {

    }

    /**
     * Add/Edit project
     *
     * @param Request $request
     * @param int $project_id
     */
    public function editAction(Request $request, $project_id = 0)
    {

    }

    /**
     * Remove project
     *
     * @param Request $request
     * @param int $project_id
     */
    public function removeAction(Request $request, $project_id)
    {

    }
}