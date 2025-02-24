<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* server/status/processes/list.twig */
class __TwigTemplate_c299d5990c08d18ee7d130c69a4bf7ceb5526aba2a301d2da5c27f5799b5a943 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"responsivetable row\">
  <table id=\"tableprocesslist\" class=\"table table-light table-striped table-hover sortable w-auto\">
    <thead class=\"table-light\">
      <tr>
        <th>";
echo _gettext("Processes");
        // line 5
        echo "</th>
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
            // line 7
            echo "          <th scope=\"col\">
            <a href=\"";
            // line 8
            echo PhpMyAdmin\Url::getFromRoute("/server/status/processes");
            echo "\" data-post=\"";
            echo PhpMyAdmin\Url::getCommon(twig_get_attribute($this->env, $this->source, $context["column"], "params", [], "any", false, false, false, 8), "", false);
            echo "\" class=\"sortlink\">
              ";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["column"], "name", [], "any", false, false, false, 9), "html", null, true);
            echo "
              ";
            // line 10
            if (twig_get_attribute($this->env, $this->source, $context["column"], "is_sorted", [], "any", false, false, false, 10)) {
                // line 11
                echo "                <img class=\"icon ic_s_desc soimg\" alt=\"";
echo _gettext("Descending");
                // line 12
                echo "\" src=\"themes/dot.gif\" style=\"display: ";
                echo (((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["column"], "sort_order", [], "any", false, false, false, 12), "DESC"))) ? ("none") : ("inline"));
                echo "\">
                <img class=\"icon ic_s_asc soimg hide\" alt=\"";
echo _gettext("Ascending");
                // line 14
                echo "\" src=\"themes/dot.gif\" style=\"display: ";
                echo (((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["column"], "sort_order", [], "any", false, false, false, 14), "DESC"))) ? ("inline") : ("none"));
                echo "\">
              ";
            }
            // line 16
            echo "            </a>
            ";
            // line 17
            if (twig_get_attribute($this->env, $this->source, $context["column"], "has_full_query", [], "any", false, false, false, 17)) {
                // line 18
                echo "              <a href=\"";
                echo PhpMyAdmin\Url::getFromRoute("/server/status/processes");
                echo "\" data-post=\"";
                echo PhpMyAdmin\Url::getCommon(($context["refresh_params"] ?? null), "", false);
                echo "\">
                ";
                // line 19
                if (twig_get_attribute($this->env, $this->source, $context["column"], "is_full", [], "any", false, false, false, 19)) {
                    // line 20
                    echo "                  ";
                    echo PhpMyAdmin\Html\Generator::getImage("s_partialtext", _gettext("Truncate shown queries"), ["class" => "icon_fulltext"]);
                    // line 24
                    echo "
                ";
                } else {
                    // line 26
                    echo "                  ";
                    echo PhpMyAdmin\Html\Generator::getImage("s_fulltext", _gettext("Show full queries"), ["class" => "icon_fulltext"]);
                    // line 30
                    echo "
                ";
                }
                // line 32
                echo "              </a>
            ";
            }
            // line 34
            echo "          </th>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "      </tr>
    </thead>

    <tbody>
      ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 41
            echo "        <tr>
          <td>
            <a class=\"ajax kill_process\" href=\"";
            // line 43
            echo PhpMyAdmin\Url::getFromRoute(("/server/status/processes/kill/" . twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 43)));
            echo "\" data-post=\"";
            echo PhpMyAdmin\Url::getCommon(["kill" => twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 43)], "", false);
            echo "\">
              ";
echo _gettext("Kill");
            // line 45
            echo "            </a>
          </td>
          <td class=\"font-monospace text-end\">";
            // line 47
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 47), "html", null, true);
            echo "</td>
          <td>";
            // line 48
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "user", [], "any", false, false, false, 48), "html", null, true);
            echo "</td>
          <td>";
            // line 49
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "host", [], "any", false, false, false, 49), "html", null, true);
            echo "</td>
          <td>
            ";
            // line 51
            if ((0 !== twig_compare(twig_get_attribute($this->env, $this->source, $context["row"], "db", [], "any", false, false, false, 51), ""))) {
                // line 52
                echo "              ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "db", [], "any", false, false, false, 52), "html", null, true);
                echo "
            ";
            } else {
                // line 54
                echo "              <em>";
echo _gettext("None");
                echo "</em>
            ";
            }
            // line 56
            echo "          </td>
          <td>";
            // line 57
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "command", [], "any", false, false, false, 57), "html", null, true);
            echo "</td>
          <td class=\"font-monospace text-end\">";
            // line 58
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "time", [], "any", false, false, false, 58), "html", null, true);
            echo "</td>
          <td>";
            // line 59
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "state", [], "any", false, false, false, 59), "html", null, true);
            echo "</td>
          <td>";
            // line 60
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "progress", [], "any", false, false, false, 60), "html", null, true);
            echo "</td>
          <td>";
            // line 61
            echo twig_get_attribute($this->env, $this->source, $context["row"], "info", [], "any", false, false, false, 61);
            echo "</td>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "    </tbody>
  </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "server/status/processes/list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  199 => 63,  191 => 61,  187 => 60,  183 => 59,  179 => 58,  175 => 57,  172 => 56,  166 => 54,  160 => 52,  158 => 51,  153 => 49,  149 => 48,  145 => 47,  141 => 45,  134 => 43,  130 => 41,  126 => 40,  120 => 36,  113 => 34,  109 => 32,  105 => 30,  102 => 26,  98 => 24,  95 => 20,  93 => 19,  86 => 18,  84 => 17,  81 => 16,  75 => 14,  69 => 12,  66 => 11,  64 => 10,  60 => 9,  54 => 8,  51 => 7,  47 => 6,  44 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "server/status/processes/list.twig", "/var/www/html/phpMyAdmin/templates/server/status/processes/list.twig");
    }
}
