<?php

/* Auth/login.twig */
class __TwigTemplate_a93a4beed94bbf153967bf1fd9dcd12317a474320deb69abc6383ca15e4b6167 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "Auth/login.twig", 1);
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
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">Login</div>
                <div class=\"panel-body\">
                    <form action=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("login"), "html", null, true);
        echo "\" method=\"POST\">
                        <div class=\"form-group\">
                            <label for=\"username\">Username</label>
                            <input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password\">Password</label>
                            <input type=\"text\" class=\"form-control\" name=\"password\" id=\"password\">
                        </div>
                        ";
        // line 20
        echo $this->env->getExtension('App\TwigExtension\Csrf')->csrf();
        echo "
                        <input type=\"submit\" value=\"Login\" class=\"btn btn-primary\">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "Auth/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 20,  40 => 11,  31 => 4,  28 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends 'layout.twig' %}

{% block body %}

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">Login</div>
                <div class=\"panel-body\">
                    <form action=\"{{ path_for('login') }}\" method=\"POST\">
                        <div class=\"form-group\">
                            <label for=\"username\">Username</label>
                            <input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password\">Password</label>
                            <input type=\"text\" class=\"form-control\" name=\"password\" id=\"password\">
                        </div>
                        {{ csrf() }}
                        <input type=\"submit\" value=\"Login\" class=\"btn btn-primary\">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{% endblock %}
";
    }
}
