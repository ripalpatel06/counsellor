<?php
/**
 *
 *
 * Author: MSkelton
 * Date: 2015-12-06
 * Change Log:
 *
 */

namespace Waterloomatt\Providers\Providers;


use Waterloomatt\Html\FormBuilder;
use Collective\Html\HtmlServiceProvider as IlluminateHtmlServiceProvider;

class HtmlServiceProvider extends IlluminateHtmlServiceProvider {

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function($app)
        {
            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

}