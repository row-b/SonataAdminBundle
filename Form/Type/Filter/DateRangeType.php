<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Sonata\AdminBundle\Form\Type\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class DateRangeType
 *
 * @package Sonata\AdminBundle\Form\Type\Filter
 * @author  Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class DateRangeType extends AbstractType
{
    const TYPE_BETWEEN = 1;
    const TYPE_NOT_BETWEEN = 2;

    protected $translator;

    /**
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'sonata_type_filter_date_range';
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array(
            self::TYPE_BETWEEN     => $this->translator->trans('label_date_type_between', array(), 'SonataAdminBundle'),
            self::TYPE_NOT_BETWEEN => $this->translator->trans('label_date_type_not_between', array(), 'SonataAdminBundle'),
        );

        $builder
            ->add('type', 'choice', array('choices' => $choices, 'required' => false))
            ->add('value', $options['field_type'], $options['field_options'])
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @todo Remove it when bumping requirements to SF 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'field_type'    => 'sonata_type_date_range',
            'field_options' => array('format' => 'yyyy-MM-dd')
        ));
    }
}
