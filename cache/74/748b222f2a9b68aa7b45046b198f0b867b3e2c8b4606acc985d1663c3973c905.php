<?php

/* App/navbar.twig */
class __TwigTemplate_bcac1312959ee74a45505befa30112de49c5d46320b6c8d50aea66751d4a474c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<nav class=\"navbar navbar-default navbar-static-top\">
    <div class=\"container-fluid\">
        <div class=\"navbar-header\">
            <a class=\"navbar-brand\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("home"), "html", null, true);
        echo "\">Quick slim</a>
        </div>
        <div class=\"collapse navbar-collapse\" id=\"navbar-collapse\">
            <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("register"), "html", null, true);
        echo "\">Register</a></li>
                <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("login"), "html", null, true);
        echo "\">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
";
    }

    public function getTemplateName()
    {
        return "App/navbar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 9,  31 => 8,  24 => 4,  19 => 1,);
    }

    public function getSource()
    {
        return "<nav class=\"navbar navbar-default navbar-static-top\">
    <div class=\"container-fluid\">
        <div class=\"navbar-header\">
            <a class=\"navbar-brand\" href=\"{{ path_for('home') }}\">Quick slim</a>
        </div>
        <div class=\"collapse navbar-collapse\" id=\"navbar-collapse\">
            <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"{{ path_for('register') }}\">Register</a></li>
                <li><a href=\"{{ path_for('login') }}\">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
";
    }
}
