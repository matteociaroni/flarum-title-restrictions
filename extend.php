<?php

namespace Matteo\TitlesRestrictions;

use Flarum\Extend;
use Flarum\Foundation\ValidationException;
use Flarum\Discussion\DiscussionValidator;

return [

	(new Extend\Frontend("admin"))->js(__DIR__ . "/js/dist/admin.js"),

	new Extend\Locales(__DIR__ . "/locale"),

	// extend DiscussionValidator with additional title requirements
	(new Extend\Validator(DiscussionValidator::class))->configure(TitleValidator::class),

	(new Extend\Settings())
		->default("matteo-titles-restrictions.settings.avoid-all-caps", false)
		->default("matteo-titles-restrictions.settings.require-letter", false)
		->default("matteo-titles-restrictions.settings.min", 3)
		->default("matteo-titles-restrictions.settings.max", 80)
];
