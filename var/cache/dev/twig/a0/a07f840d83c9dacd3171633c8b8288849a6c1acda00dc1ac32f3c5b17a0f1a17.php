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

/* home.html.twig */
class __TwigTemplate_ef75842c9a56e6d61bef51ad4771d846b217faa1e70e1e1c12b5e0b2d66698da extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home.html.twig"));

        $this->parent = $this->loadTemplate("/base.html.twig", "home.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Vagas - TALENTIFY";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 4
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "    <div class=\"row\">
        ";
        // line 6
        if (twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 6, $this->source); })()), "count", [], "any", false, false, false, 6)) {
            // line 7
            echo "            <div class=\"col-12 mx-auto\">
                <ul class=\"list-unstyled\">
                    ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 9, $this->source); })()), "result", [], "any", false, false, false, 9));
            foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
                // line 10
                echo "                        <li class=\"pb-3 border-bottom text-left\">
                            <h4 class=\"text-primary\">";
                // line 11
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "title", [], "any", false, false, false, 11), "html", null, true);
                echo "</h4>
                            <p>
                                <small class=\"text-secondary\">";
                // line 13
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "description", [], "any", false, false, false, 13), "html", null, true);
                echo "</small>
                            </p>

                            ";
                // line 16
                if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["job"], "workplace", [], "any", false, false, false, 16))) {
                    // line 17
                    echo "                                <address class=\"text-info\">
                                    ";
                    // line 18
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "workplace", [], "any", false, false, false, 18), "html", null, true);
                    echo "
                                </address>
                            ";
                }
                // line 21
                echo "
                            ";
                // line 22
                if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["job"], "salary", [], "any", false, false, false, 22))) {
                    // line 23
                    echo "                                <p class=\"text-right text-danger\">";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "salary", [], "any", false, false, false, 23), 2, ".", ","), "html", null, true);
                    echo " US\$</p>
                            ";
                }
                // line 25
                echo "                        </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "                </ul>
            </div>
            <div>
                <nav aria-label=\"Page\">
                    <ul class=\"pagination justify-content-center\">
                        ";
            // line 32
            $context["pages"] = ((twig_round((twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 32, $this->source); })()), "count", [], "any", false, false, false, 32) / twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 32, $this->source); })()), "limit", [], "any", false, false, false, 32)), 0, "ceil")) ? (twig_round((twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 32, $this->source); })()), "count", [], "any", false, false, false, 32) / twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 32, $this->source); })()), "limit", [], "any", false, false, false, 32)), 0, "ceil")) : (1));
            // line 33
            echo "                        ";
            $context["page"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 33, $this->source); })()), "request", [], "any", false, false, false, 33), "get", [0 => "page", 1 => 1], "method", false, false, false, 33);
            // line 34
            echo "                        ";
            $context["pagination"] = ["init" => (((1 === twig_compare(((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 34, $this->source); })()) - 5), 1))) ? (((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 34, $this->source); })()) - 5)) : (1)), "max" => (((-1 === twig_compare(((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 34, $this->source); })()) + 5), (isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 34, $this->source); })())))) ? (((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 34, $this->source); })()) + 5)) : ((isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 34, $this->source); })())))];
            // line 35
            echo "                        ";
            $context["routerName"] = "home_page";
            // line 36
            echo "
                        <li class=\"page-item ";
            // line 37
            echo (((0 === twig_compare(1, (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 37, $this->source); })())))) ? ("disabled") : (""));
            echo "\">
                            <a class=\"page-link\"
                               href=\"";
            // line 39
            (((1 === twig_compare((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 39, $this->source); })()), 1))) ? (print (twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath((isset($context["routerName"]) || array_key_exists("routerName", $context) ? $context["routerName"] : (function () { throw new RuntimeError('Variable "routerName" does not exist.', 39, $this->source); })()), ["page" => ((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 39, $this->source); })()) - 1)]), "html", null, true))) : (print ("#")));
            echo "\">
                                Prev
                            </a>
                        </li>
                        ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(twig_get_attribute($this->env, $this->source, (isset($context["pagination"]) || array_key_exists("pagination", $context) ? $context["pagination"] : (function () { throw new RuntimeError('Variable "pagination" does not exist.', 43, $this->source); })()), "init", [], "any", false, false, false, 43), twig_get_attribute($this->env, $this->source, (isset($context["pagination"]) || array_key_exists("pagination", $context) ? $context["pagination"] : (function () { throw new RuntimeError('Variable "pagination" does not exist.', 43, $this->source); })()), "max", [], "any", false, false, false, 43)));
            foreach ($context['_seq'] as $context["_key"] => $context["pageIndex"]) {
                // line 44
                echo "                            <li class=\"page-item ";
                echo (((0 === twig_compare($context["pageIndex"], (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 44, $this->source); })())))) ? ("active") : (""));
                echo "\">
                                <a class=\"page-link\"
                                   href=\"";
                // line 46
                (((0 !== twig_compare($context["pageIndex"], (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 46, $this->source); })())))) ? (print (twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath((isset($context["routerName"]) || array_key_exists("routerName", $context) ? $context["routerName"] : (function () { throw new RuntimeError('Variable "routerName" does not exist.', 46, $this->source); })()), ["page" => $context["pageIndex"]]), "html", null, true))) : (print ("#")));
                echo "\">
                                    ";
                // line 47
                echo twig_escape_filter($this->env, $context["pageIndex"], "html", null, true);
                echo "
                                </a>
                            </li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pageIndex'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            echo "                        <li class=\"page-item ";
            echo (((0 === twig_compare((isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 51, $this->source); })()), (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 51, $this->source); })())))) ? ("disabled") : (""));
            echo "\">
                            <a class=\"page-link\"
                               href=\"";
            // line 53
            (((-1 === twig_compare((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 53, $this->source); })()), (isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 53, $this->source); })())))) ? (print (twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath((isset($context["routerName"]) || array_key_exists("routerName", $context) ? $context["routerName"] : (function () { throw new RuntimeError('Variable "routerName" does not exist.', 53, $this->source); })()), ["page" => ((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 53, $this->source); })()) + 1)]), "html", null, true))) : (print ("#")));
            echo "\">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        ";
        } else {
            // line 61
            echo "            <p>No Jobs</p>
        ";
        }
        // line 63
        echo "    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  207 => 63,  203 => 61,  192 => 53,  186 => 51,  176 => 47,  172 => 46,  166 => 44,  162 => 43,  155 => 39,  150 => 37,  147 => 36,  144 => 35,  141 => 34,  138 => 33,  136 => 32,  129 => 27,  122 => 25,  116 => 23,  114 => 22,  111 => 21,  105 => 18,  102 => 17,  100 => 16,  94 => 13,  89 => 11,  86 => 10,  82 => 9,  78 => 7,  76 => 6,  73 => 5,  66 => 4,  53 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends '/base.html.twig' %}

{% block title %}Vagas - TALENTIFY{% endblock %}
{% block body %}
    <div class=\"row\">
        {% if data.count %}
            <div class=\"col-12 mx-auto\">
                <ul class=\"list-unstyled\">
                    {% for job in data.result %}
                        <li class=\"pb-3 border-bottom text-left\">
                            <h4 class=\"text-primary\">{{ job.title }}</h4>
                            <p>
                                <small class=\"text-secondary\">{{ job.description }}</small>
                            </p>

                            {% if job.workplace is not empty %}
                                <address class=\"text-info\">
                                    {{ job.workplace }}
                                </address>
                            {% endif %}

                            {% if job.salary is not empty %}
                                <p class=\"text-right text-danger\">{{ job.salary|number_format(2, '.', ',') }} US\$</p>
                            {% endif %}
                        </li>
                    {% endfor %}
                </ul>
            </div>
            <div>
                <nav aria-label=\"Page\">
                    <ul class=\"pagination justify-content-center\">
                        {% set pages = (data.count / data.limit)|round(0, 'ceil') ?: 1 %}
                        {% set page = app.request.get('page', 1) %}
                        {% set pagination = { init: (page - 5)  > 1 ? page - 5 : 1, max: (page + 5) < pages ? page + 5 : pages } %}
                        {% set routerName = 'home_page' %}

                        <li class=\"page-item {{ 1 == page ? 'disabled' : '' }}\">
                            <a class=\"page-link\"
                               href=\"{{ page > 1 ? path(routerName, { 'page': page - 1 }) : '#' }}\">
                                Prev
                            </a>
                        </li>
                        {% for pageIndex in pagination.init .. pagination.max %}
                            <li class=\"page-item {{ pageIndex == page ? 'active' : '' }}\">
                                <a class=\"page-link\"
                                   href=\"{{ pageIndex != page ? path(routerName, { 'page': pageIndex }) : '#' }}\">
                                    {{ pageIndex }}
                                </a>
                            </li>
                        {% endfor %}
                        <li class=\"page-item {{ pages == page ? 'disabled' : '' }}\">
                            <a class=\"page-link\"
                               href=\"{{ page < pages ? path(routerName, { 'page': page + 1 }) : '#' }}\">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        {% else %}
            <p>No Jobs</p>
        {% endif %}
    </div>
{% endblock %}", "home.html.twig", "/var/www/talentify/src/Presentation/Views/home.html.twig");
    }
}
