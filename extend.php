<?php

namespace Matteo\TitlesRestrictions;

use Flarum\Extend;
use Flarum\Foundation\ValidationException;
use Flarum\Discussion\DiscussionValidator;

return [

	(new Extend\Frontend("admin"))->js(__DIR__ . "/js/dist/admin.js"),

	new Extend\Locales(__DIR__ . "/locale"),

	(new Extend\Validator(DiscussionValidator::class))->configure(TitleValidator::class),

	(new Extend\Settings())
		->default("matteo-prevent-all-caps-titles.settings.avoid-all-caps", false)
		->default("matteo-prevent-all-caps-titles.settings.avoid-all-numbers", false)
		->default("matteo-prevent-all-caps-titles.settings.min", 3)
		->default("matteo-prevent-all-caps-titles.settings.max", 80)
];
