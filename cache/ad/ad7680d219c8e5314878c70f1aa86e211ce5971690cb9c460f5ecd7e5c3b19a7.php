<?php

/* App/home.twig */
class __TwigTemplate_fdc7322d428e11c2a09dbc1c00a49883028c3df1d99cd5cabaa209c508111e85 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "App/home.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
<div class=\"container\">
    <div class=\"jumbotron\">
        <h1>Hello world!</h1>
    </div>
    <pre>";
        // line 9
        echo twig_escape_filter($this->env, twig_var_dump($this->env, $context, (isset($context["container"]) ? $context["container"] : null)), "html", null, true);
        echo "</pre>
</div>

";
    }

    public function getTemplateName()
    {
        return "App/home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 9,  31 => 4,  28 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends 'layout.twig' %}

{% block body %}

<div class=\"container\">
    <div class=\"jumbotron\">
        <h1>Hello world!</h1>
    </div>
    <pre>{{ dump(container) }}</pre>
</div>

{% endblock %}
";
    }
}
