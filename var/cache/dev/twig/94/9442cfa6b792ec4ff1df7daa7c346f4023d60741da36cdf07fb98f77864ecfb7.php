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

/* base.html.twig */
class __TwigTemplate_d3f052268f2e688422131545211d9ac7851676f3f481505305079b5c0e80934f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'section' => [$this, 'block_section'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <link rel=\"stylesheet\" href=\"//stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css\"
          integrity=\"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk\"
          crossorigin=\"anonymous\">

    <link rel=\"stylesheet\" href=\"//use.fontawesome.com/releases/v5.7.0/css/all.css\"
          integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
    ";
        // line 12
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "</head>
<body class=\"bg-light\">

<header>
    <div class=\"d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow\">
        <div class=\"my-0 mr-md-auto py-2\">
            <a class=\"font-weight-normal text-decoration-none  text-dark\" href=\"";
        // line 19
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        echo "\">
                <figure>
                    <img src=\"https://media.glassdoor.com/sql/1084025/talentify-io-squarelogo-1531358257461.png\" class=\"w-25\" alt=\"logo\"/>
                    <h5 class=\"d-inline ml-3\">Talentify.io</h5>
                </figure>
            </a>
        </div>
        <ul class=\"nav\">
            <li class=\"py-2 mr-5 d-inline-block\">
                <a class=\"text-dark\" href=\"";
        // line 28
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("jobs_list");
        echo "\">ADMIN</a>
            </li>
        </ul>
        ";
        // line 31
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 31, $this->source); })()), "user", [], "any", false, false, false, 31))) {
            // line 32
            echo "            <div>
                <a class=\"py-2 text-decoration-none text-dark mr-5 dropdown-toggle\" href=\"#\" id=\"userp\" data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"true\">
                    <i class=\"fa h2 fa-user-circle\"> </i>
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"userp\">
                    <a class=\"dropdown-item\" href=\"";
            // line 38
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            echo "\">Logout</a>
                </div>
            </div>
        ";
        }
        // line 42
        echo "    </div>
</header>


<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-12 my-4\">
            <div class=\"text-center\">
                <h3>";
        // line 50
        $this->displayBlock('section', $context, $blocks);
        echo "</h3>
            </div>
        </div>
    </div>

    ";
        // line 55
        $this->displayBlock('body', $context, $blocks);
        // line 56
        echo "</div>
<script src=\"//code.jquery.com/jquery-3.5.1.min.js\"
        integrity=\"sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=\" crossorigin=\"anonymous\"></script>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\"
        integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\"
        crossorigin=\"anonymous\"></script>
<script src=\"//stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js\" type=\"text/javascript\"></script>

";
        // line 64
        $this->displayBlock('javascripts', $context, $blocks);
        // line 65
        echo "</body>
</html>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Talentify";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 12
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 50
    public function block_section($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "section"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 55
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 64
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 64,  184 => 55,  172 => 50,  160 => 12,  147 => 5,  138 => 65,  136 => 64,  126 => 56,  124 => 55,  116 => 50,  106 => 42,  99 => 38,  91 => 32,  89 => 31,  83 => 28,  71 => 19,  63 => 13,  61 => 12,  51 => 5,  45 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>{% block title %}Talentify{% endblock %}</title>
    <link rel=\"stylesheet\" href=\"//stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css\"
          integrity=\"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk\"
          crossorigin=\"anonymous\">

    <link rel=\"stylesheet\" href=\"//use.fontawesome.com/releases/v5.7.0/css/all.css\"
          integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
    {% block stylesheets %}{% endblock %}
</head>
<body class=\"bg-light\">

<header>
    <div class=\"d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow\">
        <div class=\"my-0 mr-md-auto py-2\">
            <a class=\"font-weight-normal text-decoration-none  text-dark\" href=\"{{ path('home') }}\">
                <figure>
                    <img src=\"https://media.glassdoor.com/sql/1084025/talentify-io-squarelogo-1531358257461.png\" class=\"w-25\" alt=\"logo\"/>
                    <h5 class=\"d-inline ml-3\">Talentify.io</h5>
                </figure>
            </a>
        </div>
        <ul class=\"nav\">
            <li class=\"py-2 mr-5 d-inline-block\">
                <a class=\"text-dark\" href=\"{{ path('jobs_list') }}\">ADMIN</a>
            </li>
        </ul>
        {% if app.user is not empty %}
            <div>
                <a class=\"py-2 text-decoration-none text-dark mr-5 dropdown-toggle\" href=\"#\" id=\"userp\" data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"true\">
                    <i class=\"fa h2 fa-user-circle\"> </i>
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"userp\">
                    <a class=\"dropdown-item\" href=\"{{ path('app_logout') }}\">Logout</a>
                </div>
            </div>
        {% endif %}
    </div>
</header>


<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-12 my-4\">
            <div class=\"text-center\">
                <h3>{% block section %}{% endblock %}</h3>
            </div>
        </div>
    </div>

    {% block body %}{% endblock %}
</div>
<script src=\"//code.jquery.com/jquery-3.5.1.min.js\"
        integrity=\"sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=\" crossorigin=\"anonymous\"></script>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\"
        integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\"
        crossorigin=\"anonymous\"></script>
<script src=\"//stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js\" type=\"text/javascript\"></script>

{% block javascripts %}{% endblock %}
</body>
</html>
", "base.html.twig", "/var/www/talentify/src/Presentation/Views/base.html.twig");
    }
}
