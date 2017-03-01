<?php

/* @particles/scrollreveal-js.html.twig */
class __TwigTemplate_43c5cff78743676c36ae224fec7c7a8d916dc6329f827c2451fffff771a40ebc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/scrollreveal-js.html.twig", 1);
        $this->blocks = array(
            'javascript_footer' => array($this, 'block_javascript_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_javascript_footer($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "enabled", array())) {
            // line 5
            echo "\t\t";
            $this->displayParentBlock("javascript_footer", $context, $blocks);
            echo "
\t\t<script src=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/scrollReveal.min.js"), "html", null, true);
            echo "\" type=\"text/javascript\"></script>
\t\t<script type=\"text/javascript\">
\t\t\twindow.sr = new scrollReveal({ mobile: ";
            // line 8
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mobile", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mobile", array()), "false")) : ("false")));
            echo " });
\t\t</script>
\t";
        }
    }

    public function getTemplateName()
    {
        return "@particles/scrollreveal-js.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 8,  39 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/scrollreveal-js.html.twig", "/Users/Marcel/Sites/hello/templates/vw_vweb/particles/scrollreveal-js.html.twig");
    }
}
