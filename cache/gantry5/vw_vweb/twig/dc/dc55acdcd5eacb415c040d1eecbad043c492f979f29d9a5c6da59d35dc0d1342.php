<?php

/* @particles/features.html.twig */
class __TwigTemplate_43817d107056e5a3b6bddec470a230950b3e283c0a9b705d8590c993db8f125a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/features.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["attr_extra"] = "";
        // line 4
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "extra", array())) {
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "extra", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["attributes"]) {
                // line 6
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["attributes"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 7
                    $context["attr_extra"] = ((((((isset($context["attr_extra"]) ? $context["attr_extra"] : null) . " ") . twig_escape_filter($this->env, $context["key"])) . "=\"") . twig_escape_filter($this->env, $context["value"], "html_attr")) . "\"");
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attributes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    public function block_particle($context, array $blocks = array())
    {
        // line 13
        echo "\t";
        if (((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")) == "style1")) {
            // line 14
            echo "\t\t<div class=\"g-features-particle ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")));
            if ($this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array())) {
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array()));
            }
            echo "\" ";
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "extra", array())) {
                echo (isset($context["attr_extra"]) ? $context["attr_extra"] : null);
            }
            echo ">
\t\t\t";
            // line 15
            if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array()) || $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array()))) {
                // line 16
                echo "\t\t\t\t<div class=\"g-particle-intro\">
\t\t\t\t\t";
                // line 17
                if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array())) {
                    // line 18
                    echo "\t\t\t\t\t\t<h3 class=\"g-title g-main-title\">";
                    echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array());
                    echo "</h3>
\t\t\t\t\t";
                }
                // line 19
                echo "\t
\t\t\t\t\t";
                // line 20
                if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array())) {
                    echo "<p class=\"g-introtext\">";
                    echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array());
                    echo "</p>";
                }
                // line 21
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 23
            echo "\t\t\t<div class=\"g-grid\">
\t\t\t\t";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 25
                echo "\t\t\t\t\t";
                $context["attr_extra_item"] = "";
                // line 26
                echo "\t\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "extra", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["extra"]) {
                    // line 27
                    echo "\t\t\t\t\t\t";
                    $context["attr_extra_item"] = ((((((isset($context["attr_extra_item"]) ? $context["attr_extra_item"] : null) . " ") . twig_escape_filter($this->env, twig_first($this->env, twig_get_array_keys_filter($context["extra"])))) . "=\"") . twig_escape_filter($this->env, twig_first($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->valuesFilter($context["extra"])), "html_attr")) . "\"");
                    // line 28
                    echo "\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extra'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "\t\t\t\t\t<div class=\"g-block g-features-particle-item";
                if ($this->getAttribute($context["item"], "class", array())) {
                    echo " ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "class", array()));
                }
                echo "\" ";
                if ($this->getAttribute($context["item"], "extra", array())) {
                    echo (isset($context["attr_extra_item"]) ? $context["attr_extra_item"] : null);
                }
                echo ">
\t\t\t\t\t\t<div class=\"g-content\">
\t\t\t\t\t\t\t";
                // line 31
                if ($this->getAttribute($context["item"], "icon", array())) {
                    if ($this->getAttribute($context["item"], "link", array())) {
                        echo "<a target=\"";
                        echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "target", array()), "_parent")) : ("_parent")));
                        echo "\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                        echo "\">";
                    }
                    echo "<span class=\"g-features-particle-icon ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon", array()));
                    echo "\"><span class=\"g-circle-border\"></span></span>";
                    if ($this->getAttribute($context["item"], "link", array())) {
                        echo "</a>";
                    }
                }
                // line 32
                echo "\t\t\t\t\t\t\t";
                if ($this->getAttribute($context["item"], "title", array())) {
                    echo "<h4 class=\"g-features-particle-title\">";
                    if ($this->getAttribute($context["item"], "link", array())) {
                        echo "<a target=\"";
                        echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "target", array()), "_parent")) : ("_parent")));
                        echo "\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                        echo "\">";
                    }
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                    if ($this->getAttribute($context["item"], "link", array())) {
                        echo "</a>";
                    }
                    echo "</h4>";
                }
                // line 33
                echo "\t\t\t\t\t\t\t";
                if ($this->getAttribute($context["item"], "description", array())) {
                    echo "<p class=\"g-features-particle-desc\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", array()));
                    echo "</p>";
                }
                // line 34
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "\t\t\t</div>
\t\t</div>
\t";
        }
        // line 40
        echo "\t";
        if ((((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")) == "style2") || ((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")) == "style3"))) {
            // line 41
            echo "\t\t<div class=\"g-features2-particle ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")));
            if ($this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array())) {
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array()));
            }
            echo "\" ";
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "extra", array())) {
                echo (isset($context["attr_extra"]) ? $context["attr_extra"] : null);
            }
            echo ">
\t\t\t";
            // line 42
            if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array()) || $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array()))) {
                // line 43
                echo "\t\t\t\t<div class=\"g-particle-intro\">
\t\t\t\t\t";
                // line 44
                if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array())) {
                    // line 45
                    echo "\t\t\t\t\t\t<h3 class=\"g-title g-main-title\">";
                    echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array());
                    echo "</h3>
\t\t\t\t\t\t<div class=\"g-title-separator ";
                    // line 46
                    if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array()) == false)) {
                        echo "no-intro-text";
                    }
                    echo "\"></div>
\t\t\t\t\t";
                }
                // line 47
                echo "\t
\t\t\t\t\t";
                // line 48
                if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array())) {
                    echo "<p class=\"g-introtext\">";
                    echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array());
                    echo "</p>";
                }
                // line 49
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 51
            echo "\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_array_batch($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()), twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columns", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columns", array()), "3")) : ("3")))));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 52
                echo "\t\t\t\t<div class=\"g-grid\">
\t\t\t\t\t";
                // line 53
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["row"]);
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 54
                    echo "\t\t\t\t\t\t";
                    $context["attr_extra_item"] = "";
                    // line 55
                    echo "\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "extra", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["extra"]) {
                        // line 56
                        echo "\t\t\t\t\t\t\t";
                        $context["attr_extra_item"] = ((((((isset($context["attr_extra_item"]) ? $context["attr_extra_item"] : null) . " ") . twig_escape_filter($this->env, twig_first($this->env, twig_get_array_keys_filter($context["extra"])))) . "=\"") . twig_escape_filter($this->env, twig_first($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->valuesFilter($context["extra"])), "html_attr")) . "\"");
                        // line 57
                        echo "\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extra'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 58
                    echo "\t\t\t\t\t\t<div class=\"g-block g-features2-particle-item";
                    if ($this->getAttribute($context["item"], "class", array())) {
                        echo " ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "class", array()));
                    }
                    echo "\" ";
                    if ($this->getAttribute($context["item"], "extra", array())) {
                        echo (isset($context["attr_extra_item"]) ? $context["attr_extra_item"] : null);
                    }
                    echo ">
\t\t\t\t\t\t\t<div class=\"g-content\">
\t\t\t\t\t\t\t\t";
                    // line 60
                    if ($this->getAttribute($context["item"], "title", array())) {
                        echo "<h4 class=\"g-features2-particle-title\">";
                        if ($this->getAttribute($context["item"], "link", array())) {
                            echo "<a target=\"";
                            echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "target", array()), "_parent")) : ("_parent")));
                            echo "\" href=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                            echo "\">";
                        }
                        if ($this->getAttribute($context["item"], "icon", array())) {
                            echo "<span class=\"g-features2-particle-icon ";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon", array()));
                            echo "\"></span>";
                        }
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                        if ($this->getAttribute($context["item"], "link", array())) {
                            echo "</a>";
                        }
                        echo "</h4>";
                    }
                    // line 61
                    echo "\t\t\t\t\t\t\t\t";
                    if ($this->getAttribute($context["item"], "description", array())) {
                        echo "<p class=\"g-features2-particle-desc\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", array()));
                        echo "</p>";
                    }
                    // line 62
                    echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 65
                echo "\t\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "\t\t</div>
\t";
        }
        // line 69
        echo "\t";
        if ((((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")) == "style4") || ((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")) == "style5"))) {
            // line 70
            echo "\t\t<div class=\"g-features2-particle ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "style", array()), "style1")) : ("style1")));
            if ($this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array())) {
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array()));
            }
            echo "\" ";
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "extra", array())) {
                echo (isset($context["attr_extra"]) ? $context["attr_extra"] : null);
            }
            echo ">
\t\t\t";
            // line 71
            if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array()) || $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array()))) {
                // line 72
                echo "\t\t\t\t<div class=\"g-particle-intro\">
\t\t\t\t\t";
                // line 73
                if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array())) {
                    // line 74
                    echo "\t\t\t\t\t\t<h3 class=\"g-title g-main-title\">";
                    echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mainheading", array());
                    echo "</h3>
\t\t\t\t\t\t<div class=\"g-title-separator ";
                    // line 75
                    if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array()) == false)) {
                        echo "no-intro-text";
                    }
                    echo "\"></div>
\t\t\t\t\t";
                }
                // line 76
                echo "\t
\t\t\t\t\t";
                // line 77
                if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array())) {
                    echo "<p class=\"g-introtext\">";
                    echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "introtext", array());
                    echo "</p>";
                }
                // line 78
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 80
            echo "\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_array_batch($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()), twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columns", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "columns", array()), "3")) : ("3")))));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 81
                echo "\t\t\t\t<div class=\"g-grid\">
\t\t\t\t\t";
                // line 82
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["row"]);
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 83
                    echo "\t\t\t\t\t\t";
                    $context["attr_extra_item"] = "";
                    // line 84
                    echo "\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "extra", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["extra"]) {
                        // line 85
                        echo "\t\t\t\t\t\t\t";
                        $context["attr_extra_item"] = ((((((isset($context["attr_extra_item"]) ? $context["attr_extra_item"] : null) . " ") . twig_escape_filter($this->env, twig_first($this->env, twig_get_array_keys_filter($context["extra"])))) . "=\"") . twig_escape_filter($this->env, twig_first($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->valuesFilter($context["extra"])), "html_attr")) . "\"");
                        // line 86
                        echo "\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extra'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 87
                    echo "\t\t\t\t\t\t<div class=\"g-block g-features2-particle-item";
                    if ($this->getAttribute($context["item"], "class", array())) {
                        echo " ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "class", array()));
                    }
                    echo "\" ";
                    if ($this->getAttribute($context["item"], "extra", array())) {
                        echo (isset($context["attr_extra_item"]) ? $context["attr_extra_item"] : null);
                    }
                    echo ">
\t\t\t\t\t\t\t<div class=\"g-content\">
\t\t\t\t\t\t\t\t";
                    // line 89
                    if ($this->getAttribute($context["item"], "icon", array())) {
                        // line 90
                        echo "\t\t\t\t\t\t\t\t\t<div class=\"g-features2-particle-icon\">
\t\t\t\t\t\t\t\t\t\t<span class=\"";
                        // line 91
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon", array()));
                        echo "\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 94
                    echo "\t\t\t\t\t\t\t\t";
                    if (($this->getAttribute($context["item"], "title", array()) || $this->getAttribute($context["item"], "description", array()))) {
                        // line 95
                        echo "\t\t\t\t\t\t\t\t\t<div class=\"g-title-desc-container\">
\t\t\t\t\t\t\t\t\t\t";
                        // line 96
                        if ($this->getAttribute($context["item"], "title", array())) {
                            echo "<h4 class=\"g-features2-particle-title\">";
                            if ($this->getAttribute($context["item"], "link", array())) {
                                echo "<a target=\"";
                                echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "target", array()), "_parent")) : ("_parent")));
                                echo "\" href=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                                echo "\">";
                            }
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                            if ($this->getAttribute($context["item"], "link", array())) {
                                echo "</a>";
                            }
                            echo "</h4>";
                        }
                        // line 97
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($context["item"], "description", array())) {
                            echo "<p class=\"g-features2-particle-desc\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", array()));
                            echo "</p>";
                        }
                        // line 98
                        echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 100
                    echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 103
                echo "\t\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "\t\t</div>
\t";
        }
    }

    public function getTemplateName()
    {
        return "@particles/features.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  473 => 105,  466 => 103,  458 => 100,  454 => 98,  447 => 97,  431 => 96,  428 => 95,  425 => 94,  419 => 91,  416 => 90,  414 => 89,  401 => 87,  395 => 86,  392 => 85,  387 => 84,  384 => 83,  380 => 82,  377 => 81,  372 => 80,  368 => 78,  362 => 77,  359 => 76,  352 => 75,  347 => 74,  345 => 73,  342 => 72,  340 => 71,  327 => 70,  324 => 69,  320 => 67,  313 => 65,  305 => 62,  298 => 61,  277 => 60,  264 => 58,  258 => 57,  255 => 56,  250 => 55,  247 => 54,  243 => 53,  240 => 52,  235 => 51,  231 => 49,  225 => 48,  222 => 47,  215 => 46,  210 => 45,  208 => 44,  205 => 43,  203 => 42,  190 => 41,  187 => 40,  182 => 37,  174 => 34,  167 => 33,  150 => 32,  134 => 31,  121 => 29,  115 => 28,  112 => 27,  107 => 26,  104 => 25,  100 => 24,  97 => 23,  93 => 21,  87 => 20,  84 => 19,  78 => 18,  76 => 17,  73 => 16,  71 => 15,  58 => 14,  55 => 13,  52 => 12,  48 => 1,  37 => 7,  33 => 6,  29 => 5,  27 => 4,  25 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/features.html.twig", "/Users/Marcel/Sites/hello/templates/vw_vweb/particles/features.html.twig");
    }
}
