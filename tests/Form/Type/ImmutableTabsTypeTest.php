<?php

/*
 * This file is part of the ekino/sonata project.
 *
 * (c) Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\HelpersBundle\Tests\Form\Type;

use PHPUnit\Framework\MockObject\MockObject;
use Sonata\CoreBundle\Form\Type\ImmutableArrayType;
use Sonata\HelpersBundle\Form\Type\ImmutableTabsType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class ImmutableTabsTypeTest.
 *
 * @author  Benoit de Jacobet <benoit.de-jacobet@ekino.com>
 */
class ImmutableTabsTypeTest extends TypeTestCase
{
    /**
     * Test testBuildForm.
     */
    public function testBuildForm()
    {
        /** @var FormBuilderInterface|MockObject $formBuilder */
        $formBuilder = $this->createMock(FormBuilderInterface::class);
        $formBuilder
            ->expects($this->once())
            ->method('add')
            ->with(
                'fr',
                ImmutableArrayType::class,
                [
                    'keys' => [
                        0 => [
                            0 => 'foo',
                            1 => 'fooClass',
                            2 => ['attr' => ['class' => 'bar']],
                        ],
                    ],
                    'label' => false,
                ]
            );

        $type = new ImmutableTabsType();
        $type->buildForm($formBuilder, [
            'keys' => [
                ['foo', 'fooClass', ['attr' => ['class' => 'bar']]],
            ],
            'tabs' => ['fr' => 'francais'],
        ]);
    }

    /**
     * Test getBlockPrefix.
     */
    public function testGetBlockPrefix()
    {
        $type = new ImmutableTabsType();
        $this->assertSame('sonata_immutable_tabs_type', $type->getBlockPrefix());
    }
}
