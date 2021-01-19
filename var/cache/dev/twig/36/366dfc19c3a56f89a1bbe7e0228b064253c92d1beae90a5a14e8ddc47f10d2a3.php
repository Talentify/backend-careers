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

/* admin/jobs/list.html.twig */
class __TwigTemplate_2dd8af0b474050a20694b2eeed9ca86cec2cc3751cf2957a68d237ad9dbf45b8 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/jobs/list.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/jobs/list.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "ADMIN - TALENTIFY";
        
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
        <div class=\"col-12\">
            ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 7, $this->source); })()), "session", [], "any", false, false, false, 7), "flashBag", [], "any", false, false, false, 7), "all", [], "method", false, false, false, 7));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 8
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 9
                echo "                    <div class=\"alert alert-";
                echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                echo " alert-dismissible fade show\" role=\"alert\">
                        ";
                // line 10
                echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                echo "
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-3\">
            ";
        // line 21
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 21, $this->source); })()), 'form');
        echo "
        </div>
        <div class=\"col-9 text-right\">
            <a href=\"";
        // line 24
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_new");
        echo "\" class=\"btn btn-sm badge-pill btn-warning\">A NEW JOB?</a>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-12\">
            ";
        // line 30
        if (twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 30, $this->source); })()), "count", [], "any", false, false, false, 30)) {
            // line 31
            echo "                <table class=\"table table-hover\">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th colspan=\"2\" class=\"w-25\"></th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 41, $this->source); })()), "result", [], "any", false, false, false, 41));
            foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
                // line 42
                echo "                        <tr>
                            <td>";
                // line 43
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "id", [], "any", false, false, false, 43), "html", null, true);
                echo "</td>
                            <td>";
                // line 44
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "title", [], "any", false, false, false, 44), "html", null, true);
                echo "</td>
                            <td>";
                // line 45
                echo twig_escape_filter($this->env, $this->extensions['App\Presentation\Twig\Filter\StatusTranslate']->translate(twig_get_attribute($this->env, $this->source, $context["job"], "status", [], "any", false, false, false, 45)), "html", null, true);
                echo "</td>
                            <td>
                                <a href=\"";
                // line 47
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_edit", ["job" => twig_get_attribute($this->env, $this->source, $context["job"], "id", [], "any", false, false, false, 47)]), "html", null, true);
                echo "\" class=\"text-info\"><i class=\"far fa-edit\"></i> edit</a>
                            </td>
                            <td>
                                <a href=\"";
                // line 50
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_confirme_delete", ["job" => twig_get_attribute($this->env, $this->source, $context["job"], "id", [], "any", false, false, false, 50)]), "html", null, true);
                echo "\" class=\"text-danger\">
                                    <i class=\"far fa-trash-alt\"></i> remove
                                </a>
                            </td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "                    </tbody>
                </table>
                <div>
                    <nav aria-label=\"Page\">
                        <ul class=\"pagination justify-content-center\">
                            ";
            // line 61
            $context["pages"] = ((twig_round((twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 61, $this->source); })()), "count", [], "any", false, false, false, 61) / twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 61, $this->source); })()), "limit", [], "any", false, false, false, 61)), 0, "ceil")) ? (twig_round((twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 61, $this->source); })()), "count", [], "any", false, false, false, 61) / twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 61, $this->source); })()), "limit", [], "any", false, false, false, 61)), 0, "ceil")) : (1));
            // line 62
            echo "                            ";
            $context["page"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 62, $this->source); })()), "request", [], "any", false, false, false, 62), "get", [0 => "page", 1 => 1], "method", false, false, false, 62);
            // line 63
            echo "                            ";
            $context["pagination"] = ["init" => (((1 === twig_compare(((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 63, $this->source); })()) - 5), 1))) ? (((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 63, $this->source); })()) - 5)) : (1)), "max" => (((-1 === twig_compare(((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 63, $this->source); })()) + 5), (isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 63, $this->source); })())))) ? (((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 63, $this->source); })()) + 5)) : ((isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 63, $this->source); })())))];
            // line 64
            echo "                            ";
            $context["routerName"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 64, $this->source); })()), "request", [], "any", false, false, false, 64), "get", [0 => "status"], "method", false, false, false, 64)) ? ("jobs_list_status_page") : ("jobs_list_page"));
            // line 65
            echo "
                            <li class=\"page-item ";
            // line 66
            echo (((0 === twig_compare(1, (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 66, $this->source); })())))) ? ("disabled") : (""));
            echo "\">
                                <a class=\"page-link\"
                                   href=\"";
            // line 68
            (((1 === twig_compare((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 68, $this->source); })()), 1))) ? (print (twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath((isset($context["routerName"]) || array_key_exists("routerName", $context) ? $context["routerName"] : (function () { throw new RuntimeError('Variable "routerName" does not exist.', 68, $this->source); })()), ["page" => ((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 68, $this->source); })()) - 1)]), "html", null, true))) : (print ("#")));
            echo "\">
                                    Prev
                                </a>
                            </li>
                            ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(twig_get_attribute($this->env, $this->source, (isset($context["pagination"]) || array_key_exists("pagination", $context) ? $context["pagination"] : (function () { throw new RuntimeError('Variable "pagination" does not exist.', 72, $this->source); })()), "init", [], "any", false, false, false, 72), twig_get_attribute($this->env, $this->source, (isset($context["pagination"]) || array_key_exists("pagination", $context) ? $context["pagination"] : (function () { throw new RuntimeError('Variable "pagination" does not exist.', 72, $this->source); })()), "max", [], "any", false, false, false, 72)));
            foreach ($context['_seq'] as $context["_key"] => $context["pageIndex"]) {
                // line 73
                echo "                                <li class=\"page-item ";
                echo (((0 === twig_compare($context["pageIndex"], (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 73, $this->source); })())))) ? ("active") : (""));
                echo "\">
                                    <a class=\"page-link\"
                                       href=\"";
                // line 75
                (((0 !== twig_compare($context["pageIndex"], (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 75, $this->source); })())))) ? (print (twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath((isset($context["routerName"]) || array_key_exists("routerName", $context) ? $context["routerName"] : (function () { throw new RuntimeError('Variable "routerName" does not exist.', 75, $this->source); })()), ["page" => $context["pageIndex"]]), "html", null, true))) : (print ("#")));
                echo "\">
                                        ";
                // line 76
                echo twig_escape_filter($this->env, $context["pageIndex"], "html", null, true);
                echo "
                                    </a>
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pageIndex'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 80
            echo "                            <li class=\"page-item ";
            echo (((0 === twig_compare((isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 80, $this->source); })()), (isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 80, $this->source); })())))) ? ("disabled") : (""));
            echo "\">
                                <a class=\"page-link\"
                                   href=\"";
            // line 82
            (((-1 === twig_compare((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 82, $this->source); })()), (isset($context["pages"]) || array_key_exists("pages", $context) ? $context["pages"] : (function () { throw new RuntimeError('Variable "pages" does not exist.', 82, $this->source); })())))) ? (print (twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath((isset($context["routerName"]) || array_key_exists("routerName", $context) ? $context["routerName"] : (function () { throw new RuntimeError('Variable "routerName" does not exist.', 82, $this->source); })()), ["page" => ((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 82, $this->source); })()) + 1)]), "html", null, true))) : (print ("#")));
            echo "\">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            ";
        } else {
            // line 90
            echo "                <p>Nenhum registro encontrado</p>
            ";
        }
        // line 92
        echo "        </div>
    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 96
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 97
        echo "<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('#status').on('change', function (event) {
            window.location.href = '/admin/jobs/status/' + \$(this).val();
        });
    });
</script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "admin/jobs/list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  277 => 97,  270 => 96,  261 => 92,  257 => 90,  246 => 82,  240 => 80,  230 => 76,  226 => 75,  220 => 73,  216 => 72,  209 => 68,  204 => 66,  201 => 65,  198 => 64,  195 => 63,  192 => 62,  190 => 61,  183 => 56,  171 => 50,  165 => 47,  160 => 45,  156 => 44,  152 => 43,  149 => 42,  145 => 41,  133 => 31,  131 => 30,  122 => 24,  116 => 21,  110 => 17,  104 => 16,  92 => 10,  87 => 9,  82 => 8,  78 => 7,  74 => 5,  67 => 4,  54 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}ADMIN - TALENTIFY{% endblock %}
{% block body %}
    <div class=\"row\">
        <div class=\"col-12\">
            {% for type, messages in app.session.flashBag.all() %}
                {% for message in messages %}
                    <div class=\"alert alert-{{ type }} alert-dismissible fade show\" role=\"alert\">
                        {{ message }}
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                {% endfor %}
            {% endfor %}
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-3\">
            {{ form(search) }}
        </div>
        <div class=\"col-9 text-right\">
            <a href=\"{{ path('job_new') }}\" class=\"btn btn-sm badge-pill btn-warning\">A NEW JOB?</a>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-12\">
            {% if data.count %}
                <table class=\"table table-hover\">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th colspan=\"2\" class=\"w-25\"></th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for job in data.result %}
                        <tr>
                            <td>{{ job.id }}</td>
                            <td>{{ job.title }}</td>
                            <td>{{ job.status|statusTranslate }}</td>
                            <td>
                                <a href=\"{{ path('job_edit', {'job': job.id }) }}\" class=\"text-info\"><i class=\"far fa-edit\"></i> edit</a>
                            </td>
                            <td>
                                <a href=\"{{ path('job_confirme_delete', {'job': job.id }) }}\" class=\"text-danger\">
                                    <i class=\"far fa-trash-alt\"></i> remove
                                </a>
                            </td>
                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
                <div>
                    <nav aria-label=\"Page\">
                        <ul class=\"pagination justify-content-center\">
                            {% set pages = (data.count / data.limit)|round(0, 'ceil') ?: 1 %}
                            {% set page = app.request.get('page', 1) %}
                            {% set pagination = { init: (page - 5)  > 1 ? page - 5 : 1, max: (page + 5) < pages ? page + 5 : pages } %}
                            {% set routerName = app.request.get('status') ? 'jobs_list_status_page' : 'jobs_list_page' %}

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
                <p>Nenhum registro encontrado</p>
            {% endif %}
        </div>
    </div>
{% endblock %}

{% block javascripts %}
<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('#status').on('change', function (event) {
            window.location.href = '/admin/jobs/status/' + \$(this).val();
        });
    });
</script>
{% endblock %}", "admin/jobs/list.html.twig", "/var/www/talentify/src/Presentation/Views/admin/jobs/list.html.twig");
    }
}
