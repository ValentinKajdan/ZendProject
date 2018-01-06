<?php

declare(strict_types=1);

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
// use Zend\Form\View\Helper\FormDate;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('meetup');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);

        $this->add([
            'type' => Element\DatetimeLocal::class,
            'name' => 'dateDebut',
            'options' => [
                'label' => 'Date de début',
            ],
        ]);

        $this->add([
            'type' => Element\DatetimeLocal::class,
            'name' => 'dateFin',
            'options' => [
                'label' => 'Date de fin',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'max' => 50,
                        ],
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'max' => 2000,
                        ],
                    ],
                ],
            ],
        ];
    }
}
