<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Repository\MeetupRepository;
use Application\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MeetupController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupForm
     */
    public $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        $id = $this->params()->fromRoute('id');
        return new ViewModel([
            'meetup' => $this->meetupRepository->findById($id),
        ]);
    }

    public function updateAction()
    {
        $form = $this->meetupForm;
        $id = $this->params()->fromRoute('id');
        $meetup = $this->meetupRepository->findById($id)[0];
        // $form->setDefaults(array(
        //   'title'=> $meetup->getTitle()
        // ));
        // var_dump($form->title);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup->setTitle($form->getData()['title']);
                $meetup->setDescription($form->getData()['description']);
                $meetup->setDateDebut(new \DateTime($form->getData()['dateDebut']));
                $meetup->setDateFin(new \DateTime($form->getData()['dateFin']));
                $this->meetupRepository->update($meetup);
                return $this->redirect()->toRoute('home');
            }
        }

        $form->prepare();

        return new ViewModel([
            'meetup' => $this->meetupRepository->findById($id),
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $meetup = $this->meetupRepository->findOneBy(array('id' => $id));
        $this->meetupRepository->delete($meetup);
        return $this->redirect()->toRoute('home');
    }
}
