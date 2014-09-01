<?php

namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Entity\Acme;
use Form\AcmeType;
 
/**
 * Sample controller
 *
 */
class AcmeController implements ControllerProviderInterface {
    
    /**
     * Route settings
     *
     */
    public function connect(Application $app) {
        $indexController = $app['controllers_factory'];
        $indexController->get("/", array($this, 'index'))->bind('acme_index');
        $indexController->get("/show/{id}", array($this, 'show'))->bind('acme_show');
        $indexController->match("/create", array($this, 'create'))->bind('acme_create');
        $indexController->match("/update/{id}", array($this, 'update'))->bind('acme_update');
        $indexController->get("/delete/{id}", array($this, 'delete'))->bind('acme_delete');
        return $indexController;
    }
    
    /**
     * List all entities
     *
     */
    public function index(Application $app) {
        
        $em = $app['db.orm.em'];
        $entities = $em->getRepository('Entity\Acme')->findAll();

        return $app['twig']->render('Acme/index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Show entity
     *
     */
    public function show(Application $app, $id) {
        
        $em = $app['db.orm.em'];
        $entity = $em->getRepository('Entity\Acme')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id '.$id);
        }

        return $app['twig']->render('Acme/show.html.twig', array(
            'entity' => $entity
        ));
    }
    
    /**
     * Create entity
     *
     */
    public function create(Application $app, Request $request) {

        $em = $app['db.orm.em'];
        $entity = new Acme();

        $form = $app['form.factory']->create(new AcmeType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em->persist($entity);
            $em->flush();

            return $app->redirect($app['url_generator']->generate('acme_show', array('id' => $entity->getId())));
        }

        return $app['twig']->render('Acme/create.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Update entity
     *
     */
    public function update(Application $app, Request $request, $id) {
        
        $em = $app['db.orm.em'];
        $entity = $em->getRepository('Entity\Acme')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id '.$id);
        }

        $form = $app['form.factory']->create(new AcmeType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->flush();
            $app['session']->getFlashBag()->add('success', 'Entity update successfull!');
            
            return $app->redirect($app['url_generator']->generate('acme_show', array('id' => $entity->getId())));
        }

        return $app['twig']->render('Acme/update.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Delete entity
     *
     */
    public function delete(Application $app, $id) {
        
        $em = $app['db.orm.em'];
        $entity = $em->getRepository('Entity\Acme')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id '.$id);
        }

        $em->remove($entity);
        $em->flush();

        return $app->redirect($app['url_generator']->generate('acme_index'));
    }
}