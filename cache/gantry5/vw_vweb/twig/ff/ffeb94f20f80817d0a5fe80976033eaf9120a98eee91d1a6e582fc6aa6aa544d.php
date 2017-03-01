<?php

/* @particles/owlcarousel.html.twig */
class __TwigTemplate_5d5d815dc0d74a0082f59b89f90c02d66004a648fb064bfe97d7871aec05ead8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/owlcarousel.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
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
    public function block_particle($context, array $blocks = array())
    {
        // line 4
        echo "
    ";
        // line 5
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()) == "showcase")) {
            // line 6
            echo "        <div class=\"g-container-wrapper-panel\">
            <div class=\"g-container carousel\">

                ";
            // line 9
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array())) {
                echo "<h2 class=\"g-title\">";
                echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array());
                echo "</h2>";
            }
            // line 10
            echo "
                <div class=\"g-owlcarousel-panel-container\" id=\"g-owlcarousel-panel-";
            // line 11
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">

                    ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 14
                echo "                        <div class=\"g-owlcarousel-panel ";
                if ($this->getAttribute($context["loop"], "first", array())) {
                    echo "selected";
                }
                echo "\" id=\"g-owlcarousel-panel-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\">
                            <a href=\"#";
                // line 15
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\">
                                ";
                // line 16
                if ($this->getAttribute($context["item"], "title", array())) {
                    echo "<span class=\"g-owlcarousel-panel-title\">";
                    echo $this->getAttribute($context["item"], "title", array());
                    echo "</span>";
                }
                // line 17
                echo "                                ";
                if ($this->getAttribute($context["item"], "subtitle", array())) {
                    echo "<span class=\"g-owlcarousel-panel-subtitle\">";
                    echo $this->getAttribute($context["item"], "subtitle", array());
                    echo "</span>";
                }
                // line 18
                echo "                            </a>
                        </div>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "
                </div>
            </div>
        </div>

        <div class=\"g-container-wrapper\">
        <div class=\"g-container carousel\">
            <div class=\"";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "class", array()));
            echo " g-owlcarousel-layout-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()));
            echo "\">

                <div id=\"g-owlcarousel-panel-indicator-";
            // line 30
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"g-owlcarousel-panel-indicator\">
                    <svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" width=\"95.13px\" height=\"45.44px\" viewBox=\"0 0 95.13 45.44\" enable-background=\"new 0 0 95.13 45.44\" xml:space=\"preserve\">
                        <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" fill=\"#FFFFFF\" d=\"M0,14.75c28.5-1.13,22.56,30.69,48.25,30.69c20.44,0.03,24.25-32.69,46.88-30.69V0H0V14.75z\"/>
                    </svg>
                </div>

                <div id=\"g-owlcarousel-";
            // line 36
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"g-owlcarousel owl-carousel ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "width", array()));
            echo "\">

                    ";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 39
                echo "                        <div class=\"item\" data-hash=\"";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\">
                            <div class=\"g-owlcarousel-content-left\">
                                <div class=\"g-owlcarousel-content-padding\">
                                    ";
                // line 42
                if ($this->getAttribute($context["item"], "title", array())) {
                    echo "<div class=\"g-owlcarousel-item-title\">";
                    echo $this->getAttribute($context["item"], "title", array());
                    echo "</div>";
                }
                // line 43
                echo "                                    ";
                if ($this->getAttribute($context["item"], "desc", array())) {
                    echo "<div class=\"g-owlcarousel-item-desc\">";
                    echo $this->getAttribute($context["item"], "desc", array());
                    echo "</div>";
                }
                // line 44
                echo "                                    ";
                if ($this->getAttribute($context["item"], "link", array())) {
                    // line 45
                    echo "                                        <div class=\"g-owlcarousel-item-link\">
                                            <a target=\"";
                    // line 46
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "buttontarget", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "buttontarget", array()), "_self")) : ("_self")));
                    echo "\" class=\"g-owlcarousel-item-button button ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttonclass", array()));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                    echo "\">
                                                ";
                    // line 47
                    echo $this->getAttribute($context["item"], "linktext", array());
                    echo "
                                            </a>
                                        </div>
                                    ";
                }
                // line 51
                echo "                                </div>
                            </div>

                            <div class=\"g-owlcarousel-content-right\">
                                <div class=\"g-owlcarousel-content-padding\">
                                ";
                // line 56
                if ($this->getAttribute($context["item"], "icon", array())) {
                    echo "<i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon", array()), "html", null, true);
                    echo "\"></i>";
                }
                // line 57
                echo "                                ";
                if ($this->getAttribute($context["item"], "icon2", array())) {
                    echo "<i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon2", array()), "html", null, true);
                    echo "\"></i>";
                }
                // line 58
                echo "                                ";
                if ($this->getAttribute($context["item"], "image", array())) {
                    // line 59
                    echo "                                    <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "image", array())));
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                    echo "\" />
                                ";
                }
                // line 61
                echo "                            </div>
                            </div>
                        </div>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            echo "
                </div>
            </div>
        </div>
        </div>

    ";
        } elseif (($this->getAttribute(        // line 71
(isset($context["particle"]) ? $context["particle"] : null), "layout", array()) == "standard")) {
            // line 72
            echo "
        <div class=\"";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "class", array()));
            echo " g-owlcarousel-layout-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()));
            echo "\">

            ";
            // line 75
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array())) {
                echo "<h2 class=\"g-title\">";
                echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array());
                echo "</h2>";
            }
            // line 76
            echo "
            <div id=\"g-owlcarousel-";
            // line 77
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"g-owlcarousel owl-carousel ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "width", array()));
            echo "\">

                ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 80
                echo "                    <div>
                        ";
                // line 81
                if ($this->getAttribute($context["item"], "image", array())) {
                    // line 82
                    echo "                            <div class=\"image\">
                                <img src=\"";
                    // line 83
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "image", array())));
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                    echo "\" />
                            </div>
                        ";
                }
                // line 86
                echo "                        ";
                if ($this->getAttribute($context["item"], "title", array())) {
                    echo "<div class=\"g-owlcarousel-item-title\">";
                    echo $this->getAttribute($context["item"], "title", array());
                    echo "</div>";
                }
                // line 87
                echo "                        ";
                if ($this->getAttribute($context["item"], "desc", array())) {
                    echo "<div class=\"g-owlcarousel-item-desc\">";
                    echo $this->getAttribute($context["item"], "desc", array());
                    echo "</div>";
                }
                // line 88
                echo "                        ";
                if ($this->getAttribute($context["item"], "link", array())) {
                    // line 89
                    echo "                            <div class=\"g-owlcarousel-item-link\">
                                <a target=\"";
                    // line 90
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "buttontarget", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "buttontarget", array()), "_self")) : ("_self")));
                    echo "\" class=\"g-owlcarousel-item-button button ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttonclass", array()));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                    echo "\">
                                    ";
                    // line 91
                    echo $this->getAttribute($context["item"], "linktext", array());
                    echo "
                                </a>
                            </div>
                        ";
                }
                // line 95
                echo "                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 97
            echo "
            </div>
        </div>

    ";
        } elseif (($this->getAttribute(        // line 101
(isset($context["particle"]) ? $context["particle"] : null), "layout", array()) == "testimonial")) {
            // line 102
            echo "
        <div class=\"";
            // line 103
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "class", array()));
            echo " g-owlcarousel-layout-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()));
            echo "\">

            ";
            // line 105
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array())) {
                echo "<h2 class=\"g-title\">";
                echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "title", array());
                echo "</h2>";
            }
            // line 106
            echo "
            <div id=\"g-owlcarousel-";
            // line 107
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"g-owlcarousel owl-carousel ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "width", array()));
            echo "\">

                ";
            // line 109
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 110
                echo "                    ";
                if ($this->getAttribute($context["item"], "desc", array())) {
                    // line 111
                    echo "                        <div class=\"g-owlcarousel-item-desc\">
                            ";
                    // line 112
                    if ($this->getAttribute($context["item"], "icon", array())) {
                        echo "<i class=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "icon", array()), "html", null, true);
                        echo "\"></i>";
                    }
                    // line 113
                    echo "
                            ";
                    // line 114
                    echo $this->getAttribute($context["item"], "desc", array());
                    echo "

                            ";
                    // line 116
                    if ($this->getAttribute($context["item"], "title", array())) {
                        // line 117
                        echo "                                <div class=\"g-owlcarousel-item-title\">";
                        echo $this->getAttribute($context["item"], "title", array());
                        echo "</div>
                            ";
                    }
                    // line 119
                    echo "                        </div>
                    ";
                }
                // line 121
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo "
            </div>
        </div>

    ";
        }
        // line 127
        echo "
";
    }

    // line 130
    public function block_javascript_footer($context, array $blocks = array())
    {
        // line 131
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/owlcarousel.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\">
        jQuery(window).load(function() {
            var owl";
        // line 134
        echo twig_escape_filter($this->env, twig_replace_filter((isset($context["id"]) ? $context["id"] : null), array("-" => "_")), "html", null, true);
        echo " = jQuery('#g-owlcarousel-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "');
            owl";
        // line 135
        echo twig_escape_filter($this->env, twig_replace_filter((isset($context["id"]) ? $context["id"] : null), array("-" => "_")), "html", null, true);
        echo ".owlCarousel({
                items: 1,
                rtl: ";
        // line 137
        if (($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "page", array()), "direction", array()) == "rtl")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
                ";
        // line 138
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateOut", array()) && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateOut", array()) != "default"))) {
            // line 139
            echo "                animateOut: '";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateOut", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateOut", array()), "fadeOut")) : ("fadeOut")));
            echo "',
                ";
        }
        // line 141
        echo "                ";
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateIn", array()) && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateIn", array()) != "default"))) {
            // line 142
            echo "                animateIn: '";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateIn", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animateIn", array()), "fadeIn")) : ("fadeIn")));
            echo "',
                ";
        }
        // line 144
        echo "                ";
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "nav", array()) == "enabled")) {
            // line 145
            echo "                nav: true,
                navText: ['";
            // line 146
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "prevText", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "prevText", array()), "<i class=\"fa fa-chevron-circle-left\"></i>")) : ("<i class=\"fa fa-chevron-circle-left\"></i>")), "js"), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "nextText", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "nextText", array()), "<i class=\"fa fa-chevron-circle-right\"></i>")) : ("<i class=\"fa fa-chevron-circle-right\"></i>")), "js"), "html", null, true);
            echo "'],
                ";
        } else {
            // line 148
            echo "                nav: false,
                ";
        }
        // line 150
        echo "                ";
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "dots", array()) == "enabled")) {
            // line 151
            echo "                dots: true,
                ";
        } else {
            // line 153
            echo "                dots: false,
                ";
        }
        // line 155
        echo "                ";
        if ((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "loop", array()) == "enabled") && ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()) != "showcase"))) {
            // line 156
            echo "                loop: true,
                ";
        } else {
            // line 158
            echo "                loop: false,
                ";
        }
        // line 160
        echo "                ";
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "autoplay", array()) == "enabled")) {
            // line 161
            echo "                autoplay: true,
                autoplayTimeout: ";
            // line 162
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "autoplaySpeed", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "autoplaySpeed", array()), "5000")) : ("5000")), "html", null, true);
            echo ",
                ";
            // line 163
            if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "pauseOnHover", array()) == "enabled")) {
                // line 164
                echo "                autoplayHoverPause: true,
                ";
            } else {
                // line 166
                echo "                autoplayHoverPause: false,
                ";
            }
            // line 168
            echo "                ";
        } else {
            // line 169
            echo "                autoplay: false,
                ";
        }
        // line 171
        echo "                URLhashListener: true,
                startPosition: 'URLHash'
            })

            ";
        // line 175
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()) == "showcase")) {
            // line 176
            echo "            owl";
            echo twig_escape_filter($this->env, twig_replace_filter((isset($context["id"]) ? $context["id"] : null), array("-" => "_")), "html", null, true);
            echo ".on('changed.owl.carousel', function(event) {
                var currentItem = \"#g-owlcarousel-panel-";
            // line 177
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo " #g-owlcarousel-panel-\" + (event.item.index + 1);
                jQuery(currentItem).trigger(\"click\");
            })
            ";
        }
        // line 181
        echo "        });
    </script>

    ";
        // line 184
        if (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "layout", array()) == "showcase")) {
            // line 185
            echo "    <script type=\"text/javascript\">
        indicator = jQuery('#g-owlcarousel-panel-indicator-";
            // line 186
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "');
        var owlPanelItems";
            // line 187
            echo twig_escape_filter($this->env, twig_replace_filter((isset($context["id"]) ? $context["id"] : null), array("-" => "_")), "html", null, true);
            echo " = jQuery('#g-owlcarousel-panel-";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo " .g-owlcarousel-panel');
        ";
            // line 188
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "items", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 189
                echo "                jQuery(\"#g-owlcarousel-panel-";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo " #g-owlcarousel-panel-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\").click(function(event) {
                    owlPanelItems";
                // line 190
                echo twig_escape_filter($this->env, twig_replace_filter((isset($context["id"]) ? $context["id"] : null), array("-" => "_")), "html", null, true);
                echo ".removeClass('selected');
                    jQuery(this).addClass('selected');
                    indicator.css({
                        left: jQuery(this).position().left";
                // line 193
                if (($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "page", array()), "direction", array()) == "rtl")) {
                    echo " + 200";
                }
                echo " + 'px',
                    });
                });
        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 197
            echo "        </script>
    ";
        }
        // line 199
        echo "
";
    }

    public function getTemplateName()
    {
        return "@particles/owlcarousel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  649 => 199,  645 => 197,  625 => 193,  619 => 190,  612 => 189,  595 => 188,  589 => 187,  585 => 186,  582 => 185,  580 => 184,  575 => 181,  568 => 177,  563 => 176,  561 => 175,  555 => 171,  551 => 169,  548 => 168,  544 => 166,  540 => 164,  538 => 163,  534 => 162,  531 => 161,  528 => 160,  524 => 158,  520 => 156,  517 => 155,  513 => 153,  509 => 151,  506 => 150,  502 => 148,  495 => 146,  492 => 145,  489 => 144,  483 => 142,  480 => 141,  474 => 139,  472 => 138,  464 => 137,  459 => 135,  453 => 134,  446 => 131,  443 => 130,  438 => 127,  431 => 122,  425 => 121,  421 => 119,  415 => 117,  413 => 116,  408 => 114,  405 => 113,  399 => 112,  396 => 111,  393 => 110,  389 => 109,  382 => 107,  379 => 106,  373 => 105,  366 => 103,  363 => 102,  361 => 101,  355 => 97,  348 => 95,  341 => 91,  333 => 90,  330 => 89,  327 => 88,  320 => 87,  313 => 86,  305 => 83,  302 => 82,  300 => 81,  297 => 80,  293 => 79,  286 => 77,  283 => 76,  277 => 75,  270 => 73,  267 => 72,  265 => 71,  257 => 65,  240 => 61,  232 => 59,  229 => 58,  222 => 57,  216 => 56,  209 => 51,  202 => 47,  194 => 46,  191 => 45,  188 => 44,  181 => 43,  175 => 42,  166 => 39,  149 => 38,  142 => 36,  133 => 30,  126 => 28,  117 => 21,  101 => 18,  94 => 17,  88 => 16,  82 => 15,  73 => 14,  56 => 13,  51 => 11,  48 => 10,  42 => 9,  37 => 6,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/owlcarousel.html.twig", "/Users/Marcel/Sites/hello/templates/vw_vweb/particles/owlcarousel.html.twig");
    }
}
