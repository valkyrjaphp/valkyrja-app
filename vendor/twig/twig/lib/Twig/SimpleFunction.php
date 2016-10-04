<?php

/*
 * This file is part of Twig.
 *
 * (c) 2010-2012 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a template function.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_SimpleFunction
{
    protected $name;
    protected $callable;
    protected $options;
    protected $arguments = [];

    public function __construct($name, $callable, array $options = [])
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->options = array_merge(
            [
                'needs_environment' => false,
                'needs_context'     => false,
                'is_variadic'       => false,
                'is_safe'           => null,
                'is_safe_callback'  => null,
                'node_class'        => 'Twig_Node_Expression_Function',
                'deprecated'        => false,
                'alternative'       => null,
            ],
            $options
        );
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function getNodeClass()
    {
        return $this->options['node_class'];
    }

    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function needsEnvironment()
    {
        return $this->options['needs_environment'];
    }

    public function needsContext()
    {
        return $this->options['needs_context'];
    }

    public function getSafe(Twig_Node $functionArgs)
    {
        if (null !== $this->options['is_safe']) {
            return $this->options['is_safe'];
        }

        if (null !== $this->options['is_safe_callback']) {
            return call_user_func($this->options['is_safe_callback'], $functionArgs);
        }

        return [];
    }

    public function isVariadic()
    {
        return $this->options['is_variadic'];
    }

    public function isDeprecated()
    {
        return (bool)$this->options['deprecated'];
    }

    public function getDeprecatedVersion()
    {
        return $this->options['deprecated'];
    }

    public function getAlternative()
    {
        return $this->options['alternative'];
    }
}
