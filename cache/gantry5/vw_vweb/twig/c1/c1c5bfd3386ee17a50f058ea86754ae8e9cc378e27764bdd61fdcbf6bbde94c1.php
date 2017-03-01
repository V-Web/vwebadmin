<?php

/* @particles/headroom.html.twig */
class __TwigTemplate_d3e19a86858dbb10d47ed5f85698561e41a0a66a3460e239618cc50e26d6cc23 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/headroom.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
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
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "enabled", array())) {
            // line 5
            echo "        ";
            $this->displayParentBlock("stylesheets", $context, $blocks);
            echo "
        <style type=\"text/css\">
        ";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
            echo " {
            /* Needed for Safari (Mac) */
            width: 100%;
        }

        ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
            echo ".g-fixed-active {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1003;
            left: 0;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -ms-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }

        .animated {
          -webkit-transition: transform 200ms linear;
          -moz-transition: transform 200ms linear;
          -ms-transition: transform 200ms linear;
          -o-transition: transform 200ms linear;
          transition: transform 200ms linear;
        }

        .slideDown {
          -webkit-transform: translateY(0%);
          -moz-transform: translateY(0%);
          -ms-transform: translateY(0%);
          -o-transform: translateY(0%);
          transform: translateY(0%);
        }

        .slideUp {
          -webkit-transform: translateY(-100%);
          -moz-transform: translateY(-100%);
          -ms-transform: translateY(-100%);
          -o-transform: translateY(-100%);
          transform: translateY(-100%);
        }

        .animated {
          -webkit-animation-duration: 0.5s;
          -moz-animation-duration: 0.5s;
          -ms-animation-duration: 0.5s;
          -o-animation-duration: 0.5s;
          animation-duration: 0.5s;
          -webkit-animation-fill-mode: both;
          -moz-animation-fill-mode: both;
          -ms-animation-fill-mode: both;
          -o-animation-fill-mode: both;
          animation-fill-mode: both;
        }

        @-webkit-keyframes slideDown {
            0% {
                -webkit-transform: translateY(-100%);
            }

            100% {
                -webkit-transform: translateY(0);
            }
        }

        @-moz-keyframes slideDown {
            0% {
                -moz-transform: translateY(-100%);
            }

            100% {
                -moz-transform: translateY(0);
            }
        }

        @-o-keyframes slideDown {
            0% {
                -o-transform: translateY(-100%);
            }

            100% {
                -o-transform: translateY(0);
            }
        }

        @keyframes slideDown {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animated.slideDown {
            -webkit-animation-name: slideDown;
            -moz-animation-name: slideDown;
            -o-animation-name: slideDown;
            animation-name: slideDown;
        }

        @-webkit-keyframes slideUp {
            0% {
                -webkit-transform: translateY(0);
            }

            100% {
                -webkit-transform: translateY(-100%);
            }
        }

        @-moz-keyframes slideUp {
            0% {
                -moz-transform: translateY(0);
            }

            100% {
                -moz-transform: translateY(-100%);
            }
        }

        @-o-keyframes slideUp {
            0% {
                -o-transform: translateY(0);
            }

            100% {
                -o-transform: translateY(-100%);
            }
        }

        @keyframes slideUp {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        .animated.slideUp {
            -webkit-animation-name: slideUp;
            -moz-animation-name: slideUp;
            -o-animation-name: slideUp;
            animation-name: slideUp;
        }

        @-webkit-keyframes swingInX {
            0% {
                -webkit-transform: perspective(400px) rotateX(-90deg);
            }
            
            100% {
                -webkit-transform: perspective(400px) rotateX(0deg);
            }
        }

        @-moz-keyframes swingInX {
            0% {
                -moz-transform: perspective(400px) rotateX(-90deg);
            }

            100% {
                -moz-transform: perspective(400px) rotateX(0deg);
            }
        }

        @-o-keyframes swingInX {
            0% {
                -o-transform: perspective(400px) rotateX(-90deg);
            }
            
            100% {
                -o-transform: perspective(400px) rotateX(0deg);
            }
        }

        @keyframes swingInX {
            0% {
                transform: perspective(400px) rotateX(-90deg);
            }
            
            100% {
                transform: perspective(400px) rotateX(0deg);
            }
        }

        .animated.swingInX {
            -webkit-transform-origin: top;
            -moz-transform-origin: top;
            -ie-transform-origin: top;
            -o-transform-origin: top;
            transform-origin: top;
          
            -webkit-backface-visibility: visible !important;
            -webkit-animation-name: swingInX;
            -moz-backface-visibility: visible !important;
            -moz-animation-name: swingInX;
            -o-backface-visibility: visible !important;
            -o-animation-name: swingInX;
            backface-visibility: visible !important;
            animation-name: swingInX;
        }

        @-webkit-keyframes swingOutX {
            0% {
                -webkit-transform: perspective(400px) rotateX(0deg);
            }
          100% {
                -webkit-transform: perspective(400px) rotateX(-90deg);
            }
        }

        @-moz-keyframes swingOutX {
            0% {
                -moz-transform: perspective(400px) rotateX(0deg);
            }
          100% {
                -moz-transform: perspective(400px) rotateX(-90deg);
            }
        }

        @-o-keyframes swingOutX {
            0% {
                -o-transform: perspective(400px) rotateX(0deg);
            }
          100% {
                -o-transform: perspective(400px) rotateX(-90deg);
            }
        }

        @keyframes swingOutX {
            0% {
                transform: perspective(400px) rotateX(0deg);
            }
          100% {
                transform: perspective(400px) rotateX(-90deg);
            }
        }

        .animated.swingOutX {
            -webkit-transform-origin: top;
            -webkit-animation-name: swingOutX;
            -webkit-backface-visibility: visible !important;
            -moz-animation-name: swingOutX;
            -moz-backface-visibility: visible !important;
            -o-animation-name: swingOutX;
            -o-backface-visibility: visible !important;
            animation-name: swingOutX;
            backface-visibility: visible !important;
        }

        @-webkit-keyframes flipInX {
            0% {
                -webkit-transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
            
            100% {
                -webkit-transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
        }

        @-moz-keyframes flipInX {
            0% {
                -moz-transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }

            100% {
                -moz-transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
        }

        @-o-keyframes flipInX {
            0% {
                -o-transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
            
            100% {
                -o-transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
        }

        @keyframes flipInX {
            0% {
                transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
            
            100% {
                transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
        }

        .animated.flipInX {
            -webkit-backface-visibility: visible !important;
            -webkit-animation-name: flipInX;
            -moz-backface-visibility: visible !important;
            -moz-animation-name: flipInX;
            -o-backface-visibility: visible !important;
            -o-animation-name: flipInX;
            backface-visibility: visible !important;
            animation-name: flipInX;
        }

        @-webkit-keyframes flipOutX {
            0% {
                -webkit-transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
          100% {
                -webkit-transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
        }

        @-moz-keyframes flipOutX {
            0% {
                -moz-transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
          100% {
                -moz-transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
        }

        @-o-keyframes flipOutX {
            0% {
                -o-transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
          100% {
                -o-transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
        }

        @keyframes flipOutX {
            0% {
                transform: perspective(400px) rotateX(0deg);
                opacity: 1;
            }
          100% {
                transform: perspective(400px) rotateX(90deg);
                opacity: 0;
            }
        }

        .animated.flipOutX {
            -webkit-animation-name: flipOutX;
            -webkit-backface-visibility: visible !important;
            -moz-animation-name: flipOutX;
            -moz-backface-visibility: visible !important;
            -o-animation-name: flipOutX;
            -o-backface-visibility: visible !important;
            animation-name: flipOutX;
            backface-visibility: visible !important;
        }

        @-webkit-keyframes bounceInDown {
            0% {
                opacity: 0;
                -webkit-transform: translateY(-200px);
            }

            60% {
                opacity: 1;
                -webkit-transform: translateY(30px);
            }

            80% {
                -webkit-transform: translateY(-10px);
            }

            100% {
                -webkit-transform: translateY(0);
            }
        }

        @-moz-keyframes bounceInDown {
            0% {
                opacity: 0;
                -moz-transform: translateY(-200px);
            }

            60% {
                opacity: 1;
                -moz-transform: translateY(30px);
            }

            80% {
                -moz-transform: translateY(-10px);
            }

            100% {
                -moz-transform: translateY(0);
            }
        }

        @-o-keyframes bounceInDown {
            0% {
                opacity: 0;
                -o-transform: translateY(-200px);
            }

            60% {
                opacity: 1;
                -o-transform: translateY(30px);
            }

            80% {
                -o-transform: translateY(-10px);
            }

            100% {
                -o-transform: translateY(0);
            }
        }

        @keyframes bounceInDown {
            0% {
                opacity: 0;
                transform: translateY(-200px);
            }

            60% {
                opacity: 1;
                transform: translateY(30px);
            }

            80% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animated.bounceInDown {
            -webkit-animation-name: bounceInDown;
            -moz-animation-name: bounceInDown;
            -o-animation-name: bounceInDown;
            animation-name: bounceInDown;
        }

        @-webkit-keyframes bounceOutUp {
            0% {
                -webkit-transform: translateY(0);
            }

            30% {
                opacity: 1;
                -webkit-transform: translateY(20px);
            }

            100% {
                opacity: 0;
                -webkit-transform: translateY(-200px);
            }
        }

        @-moz-keyframes bounceOutUp {
            0% {
                -moz-transform: translateY(0);
            }

            30% {
                opacity: 1;
                -moz-transform: translateY(20px);
            }

            100% {
                opacity: 0;
                -moz-transform: translateY(-200px);
            }
        }

        @-o-keyframes bounceOutUp {
            0% {
                -o-transform: translateY(0);
            }

            30% {
                opacity: 1;
                -o-transform: translateY(20px);
            }

            100% {
                opacity: 0;
                -o-transform: translateY(-200px);
            }
        }

        @keyframes bounceOutUp {
            0% {
                transform: translateY(0);
            }

            30% {
                opacity: 1;
                transform: translateY(20px);
            }

            100% {
                opacity: 0;
                transform: translateY(-200px);
            }
        }

        .animated.bounceOutUp {
            -webkit-animation-name: bounceOutUp;
            -moz-animation-name: bounceOutUp;
            -o-animation-name: bounceOutUp;
            animation-name: bounceOutUp;
        }
        </style>
    ";
        }
    }

    // line 536
    public function block_javascript_footer($context, array $blocks = array())
    {
        // line 537
        echo "    ";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "enabled", array())) {
            // line 538
            echo "        ";
            if (($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "platform", array()), "getName", array(), "method") == "joomla")) {
                // line 539
                echo "            ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["joomla"]) ? $context["joomla"] : null), "html", array(0 => "jquery.framework"), "method"), "html", null, true);
                echo "
        ";
            }
            // line 541
            echo "
        ";
            // line 542
            if (($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "platform", array()), "getName", array(), "method") == "wordpress")) {
                // line 543
                echo "            ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["wordpress"]) ? $context["wordpress"] : null), "call", array(0 => "wp_enqueue_script", 1 => "jquery"), "method"), "html", null, true);
                echo "
        ";
            }
            // line 545
            echo "        ";
            $this->displayParentBlock("javascript_footer", $context, $blocks);
            echo "
        <script src=\"//cdnjs.cloudflare.com/ajax/libs/headroom/0.9.3/headroom.min.js\"></script>
        <script src=\"//cdnjs.cloudflare.com/ajax/libs/headroom/0.9.3/jQuery.headroom.js\"></script>
        ";
            // line 548
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array())) {
                // line 549
                echo "            <script>
                (function(\$) {
                    \$(window).load(function() {
                        \$(\"";
                // line 552
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                echo "\").headroom({
                            \"offset\": ";
                // line 553
                echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "offset", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "offset", array()), 300)) : (300)));
                echo ",
                            \"tolerance\": 5,
                            \"classes\": {
                                \"initial\": \"animated\",
                                \"pinned\": \"";
                // line 557
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "slide")) {
                    echo "slideDown";
                }
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "swing")) {
                    echo "swingInX";
                }
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "flip")) {
                    echo "flipInX";
                }
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "bounce")) {
                    echo "bounceInDown";
                }
                echo "\",
                                \"unpinned\": \"";
                // line 558
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "slide")) {
                    echo "slideUp";
                }
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "swing")) {
                    echo "swingOutX";
                }
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "flip")) {
                    echo "flipOutX";
                }
                if ((twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "animation", array()), "slide")) : ("slide"))) == "bounce")) {
                    echo "bounceOutUp";
                }
                echo "\"
                            }
                        });

                        var stickyOffset = \$('";
                // line 562
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                echo "').offset().top;                
                        var stickyContainerHeight = \$('";
                // line 563
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                echo "').height();

                        \$('";
                // line 565
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                echo "').wrap( \"<div class='g-fixed-container'></div>\" );
                        \$('.g-fixed-container').css(\"height\", stickyContainerHeight);

                        ";
                // line 568
                if (((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mobile", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mobile", array()), "disable")) : ("disable")) == "disable")) {
                    // line 569
                    echo "                        \$(window).resize(function() {
                            if( \$(window).width() < 768 && \$('.g-fixed-container').length ) {
                                \$('";
                    // line 571
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                    echo "').unwrap();
                            }

                            if( \$(window).width() > 767 && \$('.g-fixed-container').length == 0 ) {
                                \$('";
                    // line 575
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                    echo "').wrap( \"<div class='g-fixed-container'></div>\" );
                                \$('.g-fixed-container').css(\"height\", stickyContainerHeight);
                            }
                        });
                        ";
                }
                // line 580
                echo "
                        \$(window).scroll(function(){
                            var sticky = \$('";
                // line 582
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "cssselector", array()));
                echo "'),
                                scroll = \$(window).scrollTop();

                            if (scroll > stickyOffset ";
                // line 585
                if (((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mobile", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "mobile", array()), "disable")) : ("disable")) == "disable")) {
                    echo "&& \$(window).width() > 767";
                }
                echo ") sticky.addClass('g-fixed-active');
                            else sticky.removeClass('g-fixed-active');
                        });
                    });
                })(jQuery);
            </script>
        ";
            }
            // line 592
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "@particles/headroom.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  718 => 592,  706 => 585,  700 => 582,  696 => 580,  688 => 575,  681 => 571,  677 => 569,  675 => 568,  669 => 565,  664 => 563,  660 => 562,  642 => 558,  627 => 557,  620 => 553,  616 => 552,  611 => 549,  609 => 548,  602 => 545,  596 => 543,  594 => 542,  591 => 541,  585 => 539,  582 => 538,  579 => 537,  576 => 536,  49 => 12,  41 => 7,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/headroom.html.twig", "/Users/Marcel/Sites/hello/templates/vw_vweb/particles/headroom.html.twig");
    }
}
