<?php

/* Macro/form.twig */
class __TwigTemplate_23bb34ede5fb5e8c8d8fd7e38c3abda4bd6ee040eabf7054745c8686bae660c8 extends Twig_Template
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
        echo "
";
        // line 9
        echo "

";
    }

    // line 2
    public function getgroup($__name__ = null, $__value__ = null, $__id__ = null, $__label__ = null, $__class__ = null, $__type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "label" => $__label__,
            "class" => $__class__,
            "type" => $__type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 3
            echo "    <div class=\"form-group";
            if ($this->env->getExtension('Awurth\Slim\Validation\ValidatorExtension')->hasError((isset($context["name"]) ? $context["name"] : null))) {
                echo " has-error";
            }
            echo "\">
        <label for=\"";
            // line 4
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "</label>
        <input type=\"";
            // line 5
            echo twig_escape_filter($this->env, ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : null), "text")) : ("text")), "html", null, true);
            echo "\" name=\"";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"form-control ";
            echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
            echo "\" aria-describedby=\"";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "-help-block\">
        <span id=\"";
            // line 6
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "-help-block\" class=\"help-block\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Awurth\Slim\Validation\ValidatorExtension')->getError((isset($context["name"]) ? $context["name"] : null)), "html", null, true);
            echo "</span>
    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "Macro/form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 6,  58 => 5,  52 => 4,  45 => 3,  28 => 2,  22 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
{% macro group(name, value, id, label, class, type) %}
    <div class=\"form-group{% if has_error(name) %} has-error{% endif %}\">
        <label for=\"{{ id }}\">{{ label }}</label>
        <input type=\"{{ type|default('text') }}\" name=\"{{ name }}\" value=\"{{ value }}\" id=\"{{ id }}\" class=\"form-control {{ class }}\" aria-describedby=\"{{ id }}-help-block\">
        <span id=\"{{ id }}-help-block\" class=\"help-block\">{{ error(name) }}</span>
    </div>
{% endmacro %}


", "Macro/form.twig", "/media/owen/0c3c4e82-2ef0-4034-b07a-c1a7d255bc04/www/private/quickslim/src/App/Resources/views/Macro/form.twig");
    }
}
