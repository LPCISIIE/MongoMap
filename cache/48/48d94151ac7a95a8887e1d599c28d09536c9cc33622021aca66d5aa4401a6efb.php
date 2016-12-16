<?php

/* App/flash.twig */
class __TwigTemplate_ba6c65d6b3d39c3ac7988034d89c22a361742c0beb9dacc996f098c4d4441ff0 extends Twig_Template
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
        echo "<div class=\"container\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "getMessages", array(), "method"));
        foreach ($context['_seq'] as $context["name"] => $context["messages"]) {
            // line 3
            echo "        <div class=\"alert alert-";
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "\">
            ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 5
                echo "                ";
                echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 7
            echo "        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "App/flash.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 9,  44 => 7,  35 => 5,  31 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"container\">
    {% for name, messages in flash.getMessages() %}
        <div class=\"alert alert-{{ name }}\">
            {% for message in messages %}
                {{ message }}
            {% endfor %}
        </div>
    {% endfor %}
</div>
", "App/flash.twig", "/media/owen/0c3c4e82-2ef0-4034-b07a-c1a7d255bc04/www/private/quickslim/src/App/Resources/views/App/flash.twig");
    }
}
