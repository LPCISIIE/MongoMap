<?php

/* Auth/register.twig */
class __TwigTemplate_9d8f6227ea374c9b58eadd58acbde510eeebe4e2828b981f407ac10df73622ff extends Twig_Template
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
                <div class=\"panel-heading\">Register</div>
                <div class=\"panel-body\">
                    <form action=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("register"), "html", null, true);
        echo "\" method=\"POST\">
                        <div class=\"form-group\">
                            <label for=\"username\">Username</label>
                            <input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"email\">Email</label>
                            <input type=\"text\" class=\"form-control\" name=\"email\" id=\"email\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password\">Password</label>
                            <input type=\"text\" class=\"form-control\" name=\"password\" id=\"password\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password-confirm\">Confirm password</label>
                            <input type=\"text\" class=\"form-control\" name=\"password-confirm\" id=\"password-confirm\">
                        </div>
                        ";
        // line 28
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
        return array (  60 => 28,  40 => 11,  31 => 4,  28 => 3,  11 => 1,);
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

{% block body %}

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-4 col-md-offset-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">Register</div>
                <div class=\"panel-body\">
                    <form action=\"{{ path_for('register') }}\" method=\"POST\">
                        <div class=\"form-group\">
                            <label for=\"username\">Username</label>
                            <input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"email\">Email</label>
                            <input type=\"text\" class=\"form-control\" name=\"email\" id=\"email\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password\">Password</label>
                            <input type=\"text\" class=\"form-control\" name=\"password\" id=\"password\">
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password-confirm\">Confirm password</label>
                            <input type=\"text\" class=\"form-control\" name=\"password-confirm\" id=\"password-confirm\">
                        </div>
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
