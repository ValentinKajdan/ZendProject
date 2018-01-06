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

    public function editAction()
    {
        $form = $this->meetupForm;
        $id = $this->params()->fromRoute('id');
        $meetup = $this->meetupRepository->findById($id);
        // $form->setDefaults(array(
        //   'title'=> $meetup->getTitle()
        // ));
        var_dump($form);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->meetupRepository->createMeetup(
                    $form->getData()['title'],
                    $form->getData()['description'],
                    $form->getData()['dateDebut'],
                    $form->getData()['dateFin'] ?? ''
                );
                $this->meetupRepository->add($meetup);
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
        var_dump($meetup);
        $this->meetupRepository->delete($meetup);
        return $this->redirect()->toRoute('home');
    }
}
