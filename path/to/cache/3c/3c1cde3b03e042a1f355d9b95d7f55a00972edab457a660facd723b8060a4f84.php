<?php

/* index.phtml */
class __TwigTemplate_9ce18f11bcff140456ca79511237ef5392a02592caacd820081358a6b4c5b6eb extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\"/>
        <title>Slim 3</title>
        <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
        <style>
            body {
                margin: 50px 0 0 0;
                padding: 0;
                width: 100%;
                font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif;
                text-align: center;
                color: #aaa;
                font-size: 18px;
            }

            h1 {
                color: #719e40;
                letter-spacing: -3px;
                font-family: 'Lato', sans-serif;
                font-size: 100px;
                font-weight: 200;
                margin-bottom: 0;
            }
        </style>
    </head>
    <body>
        <h1>Slim</h1>
        <div>a microframework for PHP</div>

        <?php if (isset(\$name)) : ?>
            <h2>Hello <?= htmlspecialchars(\$name); ?>!</h2>
        <?php else: ?>
            <p>Try <a href=\"http://www.slimframework.com\">SlimFramework</a></p>
        <?php endif; ?>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.phtml";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.phtml", "/var/www/html/carmudi-exam/templates/index.phtml");
    }
}
