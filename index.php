<?php

$routes = [
    'donate'      => 'https://patreon.com/phalcon',
    'fund'        => 'https://patreon.com/phalcon',
    'funding'     => 'https://patreon.com/phalcon',
    'support_us'  => 'https://patreon.com/phalcon',
    'forum'       => 'https://forum.phalconphp.com',
    'slack'       => 'https://phalconchats.slack.com/messages/general/',
    'github'      => 'https://github.com/phalcon/cphalcon',
    'github-docs' => 'https://github.com/phalcon/docs',
    'docs'        => 'https://docs.phalconphp.com',
    'download'    => 'https://phalconphp.com/en/download',
    'team'        => 'https://phalconphp.com/en/team',
    'store'       => 'https://teespring.com/phalcon',
    't'           => 'https://twitter.com/phalconphp',
    'twitter'     => 'https://twitter.com/phalconphp',
    'fb'          => 'https://www.facebook.com/Phalcon-Framework-134230726685897/',
    'facebook'    => 'https://teespring.com/phalcon',
    'g+'          => 'https://plus.google.com/u/0/b/102376109340560896457/+PhalconPHP',
    'gab'         => 'https://gab.ai/phalcon',
    'resources'   => 'http://phalconist.com',
    'default'     => 'https://phalconphp.com',
];

$app = new \Phalcon\Mvc\Micro();

$app->notFound(
    function () use ($app) {
        $app->response->setStatusCode(404, "Not Found");
        $app->response->sendHeaders();

        echo "This link does not exist";
    }
);

$app->get(
    '/{url}',
    function ($url) use ($app, $routes) {

        /**
         * Landing page
         */
        if (true === empty($url)) {
            $output   = <<<EOF
<!DOCTYPE html>
<html lang="en">
<title>Phalcon Link</title>
<body>
%s
</body>
</html>
EOF;
            $template = '<a href="%s">%s</a>' . PHP_EOL;
            $links    = sprintf($template, $routes['default'], 'Website');
            foreach ($routes as $key => $url) {
                if ('default' !== $key) {
                    $links .= sprintf($template, $url, $key);
                }
            }

            $output = sprintf($output, $links);
            $app->response->setContent($output);

            return $app->response->send();
        } else {
            $url = strtolower($url);
            if (true === array_key_exists($url, $routes)) {
                 $redirect = $routes[$url];
            } else {
                $redirect = $routes['default'];
            }

            return $app->response->redirect($redirect, true);
        }
    }
);


$app->handle();
