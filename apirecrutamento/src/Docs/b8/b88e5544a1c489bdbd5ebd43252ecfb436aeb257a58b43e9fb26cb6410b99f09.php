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

/* swagger.twig */
class __TwigTemplate_f410a8dba0d72cd567f2879442c0184e6d920f28a2bdeac8d7046183be0da64a extends Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>API Specification - Swagger UI</title>
    <link rel=\"stylesheet\" type=\"text/css\"
          href=\"https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.26.1/swagger-ui.css\">
</head>
<body>
<div id=\"swagger-ui\"></div>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.26.1/swagger-ui-bundle.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.26.1/swagger-ui-standalone-preset.js\"></script>
<script>
    window.onload = function () {
        const ui = SwaggerUIBundle({
            spec: ";
        // line 16
        echo ($context["spec"] ?? null);
        echo ",
            dom_id: '#swagger-ui',
            deepLinking: true,
            supportedSubmitMethods: [],
            presets: [
                SwaggerUIBundle.presets.apis,
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
        })
        window.ui = ui
    }
</script>
</body>
";
    }

    public function getTemplateName()
    {
        return "swagger.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 16,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "swagger.twig", "/home/jandelson/git/apirecrutamento/templates/swagger.twig");
    }
}
