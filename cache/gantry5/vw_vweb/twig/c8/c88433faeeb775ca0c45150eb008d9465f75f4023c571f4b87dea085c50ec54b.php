<?php

/* @particles/googlemap.html.twig */
class __TwigTemplate_5ebfd7b67f15f2d7a947fb4209b515f5e41f7cb5cb4e334ce05db76971b4d824 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/googlemap.html.twig", 1);
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
        echo "    ";
        $context["indentifier"] = twig_random($this->env);
        // line 14
        echo "
    ";
        // line 16
        echo "    ";
        $assetFunction = $this->env->getFunction('parse_assets')->getCallable();
        $assetVariables = array("priority" => 10);
        if ($assetVariables && !is_array($assetVariables)) {
            throw new UnexpectedValueException('{% scripts with x %}: x is not an array');
        }
        $location = "footer";
        if ($location && !is_string($location)) {
            throw new UnexpectedValueException('{% scripts in x %}: x is not a string');
        }
        $priority = isset($assetVariables['priority']) ? $assetVariables['priority'] : 0;
        ob_start();
        // line 17
        echo "        <script type=\"text/javascript\" src=\"https://maps.googleapis.com/maps/api/js";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "apikey", array())) {
            echo "?key=";
            echo twig_escape_filter($this->env, trim(twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "apikey", array()))), "html", null, true);
        }
        echo "\"></script>
        <script type=\"text/javascript\">
            function initialize";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["indentifier"]) ? $context["indentifier"] : null));
        echo "() {

                var latlng = new google.maps.LatLng(";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "latitude", array()));
        echo ",";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "longitude", array()));
        echo ");

                var myOptions =
                {
                    zoom: ";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "zoom", array()));
        echo ",
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.";
        // line 27
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "maptype", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "maptype", array()), "ROADMAP")) : ("ROADMAP")));
        echo ",

                    ";
        // line 29
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "snazzymaps", array())) {
            // line 30
            echo "                        styles: ";
            echo $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "snazzymaps", array());
            echo ",
                    ";
        }
        // line 32
        echo "
                    scrollwheel: ";
        // line 33
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "scrollwheel", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "scrollwheel", array()), 0)) : (0)));
        echo "
                };

                var map = new google.maps.Map(document.getElementById(\"g-map-";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["indentifier"]) ? $context["indentifier"] : null));
        echo "\"), myOptions);

                ";
        // line 38
        if (((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "defaultmarker", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "defaultmarker", array()), "show")) : ("show")) == "show")) {
            // line 39
            echo "                    var myMarker = new google.maps.Marker(
                    {
                        position: latlng,
                        map: map,
                    });

                    var contentString = '";
            // line 45
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "markertext", array()), "js"), "html", null, true);
            echo "';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    ";
            // line 51
            if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "markertext", array())) {
                // line 52
                echo "                        myMarker.addListener('click', function() {
                            infowindow.open(map, myMarker);
                        });

                        ";
                // line 56
                if ((($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "markerstate", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "markerstate", array()), 1)) : (1))) {
                    // line 57
                    echo "                            infowindow.open(map, myMarker);
                        ";
                }
                // line 59
                echo "                    ";
            }
            // line 60
            echo "                ";
        }
        // line 61
        echo "
                ";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "markers", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["marker"]) {
            // line 63
            echo "                    ";
            $context["marker_id"] = twig_random($this->env);
            // line 64
            echo "
                    var myMarker";
            // line 65
            echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
            echo " = new google.maps.Marker(
                    {
                        position: {lat: ";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute($context["marker"], "latitude", array()));
            echo ", lng: ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["marker"], "longitude", array()));
            echo "},
                        map: map,
                    });

                    var contentString";
            // line 71
            echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
            echo " = '";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($context["marker"], "markertext", array()), "js"), "html", null, true);
            echo "';

                    var infowindow";
            // line 73
            echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
            echo " = new google.maps.InfoWindow({
                        content: contentString";
            // line 74
            echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
            echo "
                    });

                    ";
            // line 77
            if ($this->getAttribute($context["marker"], "markertext", array())) {
                // line 78
                echo "                    myMarker";
                echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
                echo ".addListener('click', function() {
                        infowindow";
                // line 79
                echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
                echo ".open(map, myMarker";
                echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
                echo ");
                    });

                        ";
                // line 82
                if ((($this->getAttribute($context["marker"], "markerstate", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["marker"], "markerstate", array()), 1)) : (1))) {
                    // line 83
                    echo "                            infowindow";
                    echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
                    echo ".open(map, myMarker";
                    echo twig_escape_filter($this->env, (isset($context["marker_id"]) ? $context["marker_id"] : null));
                    echo ");
                        ";
                }
                // line 85
                echo "                    ";
            }
            // line 86
            echo "
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['marker'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "
                // Resize stuff...
                google.maps.event.addDomListener(window, \"resize\", function() {
                    var center = map.getCenter();
                    google.maps.event.trigger(map, \"resize\");
                    map.setCenter(center); 
                });

            }
            google.maps.event.addDomListener(window, 'load', initialize";
        // line 97
        echo twig_escape_filter($this->env, (isset($context["indentifier"]) ? $context["indentifier"] : null));
        echo ");
        </script>
    ";
        $content = ob_get_clean();
        echo $assetFunction($content, $location, $priority);
        // line 101
        echo "
    <div class=\"g-googlemap";
        // line 102
        if ($this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array())) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "css", array()), "class", array()));
        }
        echo "\" ";
        if ($this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "extra", array())) {
            echo (isset($context["attr_extra"]) ? $context["attr_extra"] : null);
        }
        echo " >
        <div id=\"g-map-";
        // line 103
        echo twig_escape_filter($this->env, (isset($context["indentifier"]) ? $context["indentifier"] : null));
        echo "\" style=\"width: ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "width", array()));
        echo "; height: ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["particle"]) ? $context["particle"] : null), "height", array()));
        echo ";\">
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "@particles/googlemap.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  279 => 103,  268 => 102,  265 => 101,  258 => 97,  247 => 88,  240 => 86,  237 => 85,  229 => 83,  227 => 82,  219 => 79,  214 => 78,  212 => 77,  206 => 74,  202 => 73,  195 => 71,  186 => 67,  181 => 65,  178 => 64,  175 => 63,  171 => 62,  168 => 61,  165 => 60,  162 => 59,  158 => 57,  156 => 56,  150 => 52,  148 => 51,  139 => 45,  131 => 39,  129 => 38,  124 => 36,  118 => 33,  115 => 32,  109 => 30,  107 => 29,  102 => 27,  97 => 25,  88 => 21,  83 => 19,  74 => 17,  61 => 16,  58 => 14,  55 => 13,  52 => 12,  48 => 1,  37 => 7,  33 => 6,  29 => 5,  27 => 4,  25 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/googlemap.html.twig", "/Users/Marcel/Sites/hello/templates/vw_vweb/particles/googlemap.html.twig");
    }
}
