<?php

/* Auth/register.twig */
class __TwigTemplate_41a9acd9596671cc846a080d4a224c4fac875ce13a7425796f33b74bb1f35bf2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "Auth/register.twig", 1);
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
        // line 3
        $context["form"] = $this->loadTemplate("Macro/form.twig", "Auth/register.twig", 3);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "
<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">Register</div>
                <div class=\"panel-body\">
                    <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("register"), "html", null, true);
        echo "\" method=\"POST\">
                        ";
        // line 14
        echo $context["form"]->getgroup("username", null, "username", "Username");
        echo "
                        ";
        // line 15
        echo $context["form"]->getgroup("email", null, "email", "Email", null, "email");
        echo "
                        ";
        // line 16
        echo $context["form"]->getgroup("password", null, "password", "Password", null, "password");
        echo "
                        ";
        // line 17
        echo $context["form"]->getgroup("password-confirm", null, "password-confirm", "Confirm password", null, "password");
        echo "

                        ";
        // line 19
        echo $this->env->getExtension('App\TwigExtension\Csrf')->csrf();
        echo "
                        <input type=\"submit\" value=\"Register\" class=\"btn btn-primary\">
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
        return "Auth/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 19,  59 => 17,  55 => 16,  51 => 15,  47 => 14,  43 => 13,  34 => 6,  31 => 5,  27 => 1,  25 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'layout.twig' %}

{% import 'Macro/form.twig' as form %}

{% block body %}

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">Register</div>
                <div class=\"panel-body\">
                    <form action=\"{{ path_for('register') }}\" method=\"POST\">
                        {{ form.group('username', null, 'username', 'Username') }}
                        {{ form.group('email', null, 'email', 'Email', null, 'email') }}
                        {{ form.group('password', null, 'password', 'Password', null, 'password') }}
                        {{ form.group('password-confirm', null, 'password-confirm', 'Confirm password', null, 'password') }}

                        {{ csrf() }}
                        <input type=\"submit\" value=\"Register\" class=\"btn btn-primary\">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{% endblock %}
", "Auth/register.twig", "/media/owen/0c3c4e82-2ef0-4034-b07a-c1a7d255bc04/www/private/quickslim/src/App/Resources/views/Auth/register.twig");
    }
}
