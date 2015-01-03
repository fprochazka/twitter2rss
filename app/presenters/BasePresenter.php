<?php

namespace App\Presenters;

use Nette;


/**
 * Base presenter for all application presenters.
 * @property Nette\Bridges\ApplicationLatte\Template $template
 * @property-read Nette\Bridges\ApplicationLatte\Template $template
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

}
