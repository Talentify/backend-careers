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

/* admin/jobs/confirme.delete.html.twig */
class __TwigTemplate_3deb5ac0f1e130884b51cf5a8566ecbcaaa4994d930a771a7c4be7ce87fe68d4 extends Template
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
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/jobs/confirme.delete.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/jobs/confirme.delete.html.twig", 1);
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
            <h2 class=\"mb-5\">Job</h2>
            <h6 class=\"text-primary\">";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 8, $this->source); })()), "title", [], "any", false, false, false, 8), "html", null, true);
        echo "</h6>
            <p>
                <small class=\"text-secondary\">";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 10, $this->source); })()), "description", [], "any", false, false, false, 10), "html", null, true);
        echo "</small>
            </p>

            ";
        // line 13
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 13, $this->source); })()), "workplace", [], "any", false, false, false, 13))) {
            // line 14
            echo "                <address class=\"text-info\">
                    ";
            // line 15
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 15, $this->source); })()), "workplace", [], "any", false, false, false, 15), "html", null, true);
            echo "
                </address>
            ";
        }
        // line 18
        echo "
            ";
        // line 19
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 19, $this->source); })()), "salary", [], "any", false, false, false, 19))) {
            // line 20
            echo "                <p class=\"text-right text-danger\">";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 20, $this->source); })()), "salary", [], "any", false, false, false, 20), 2, ".", ","), "html", null, true);
            echo " US\$</p>
            ";
        }
        // line 22
        echo "
            <h2 class=\"mb-5\">Do you really want to delete this job?</h2>
            <nav>
                <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_delete", ["job" => twig_get_attribute($this->env, $this->source, (isset($context["job"]) || array_key_exists("job", $context) ? $context["job"] : (function () { throw new RuntimeError('Variable "job" does not exist.', 25, $this->source); })()), "id", [], "any", false, false, false, 25)]), "html", null, true);
        echo "\" class=\"btn btn-md btn-danger\">YES</a>
                <a href=\"";
        // line 26
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("jobs_list");
        echo "\" class=\"btn btn-md btn-secondary\">NO</a>
            </nav>
        </div>
    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "admin/jobs/confirme.delete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 26,  116 => 25,  111 => 22,  105 => 20,  103 => 19,  100 => 18,  94 => 15,  91 => 14,  89 => 13,  83 => 10,  78 => 8,  73 => 5,  66 => 4,  53 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}ADMIN - TALENTIFY{% endblock %}
{% block body %}
    <div class=\"row\">
        <div class=\"col-12\">
            <h2 class=\"mb-5\">Job</h2>
            <h6 class=\"text-primary\">{{ job.title }}</h6>
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

            <h2 class=\"mb-5\">Do you really want to delete this job?</h2>
            <nav>
                <a href=\"{{ path('job_delete', {'job': job.id }) }}\" class=\"btn btn-md btn-danger\">YES</a>
                <a href=\"{{ path('jobs_list') }}\" class=\"btn btn-md btn-secondary\">NO</a>
            </nav>
        </div>
    </div>
{% endblock %}", "admin/jobs/confirme.delete.html.twig", "/var/www/talentify/src/Presentation/Views/admin/jobs/confirme.delete.html.twig");
    }
}
