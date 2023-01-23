<?php

namespace MatteoCiaroni\TitleRestrictions;

use Flarum\Extend;
use Flarum\Foundation\ValidationException;
use Flarum\Discussion\DiscussionValidator;

return [

	(new Extend\Frontend("admin"))->js(__DIR__ . "/js/dist/admin.js"),

	new Extend\Locales(__DIR__ . "/locale"),

	// extend DiscussionValidator with additional title requirements
	(new Extend\Validator(DiscussionValidator::class))->configure(TitleValidator::class),

	(new Extend\Settings())
		->default("matteociaroni-title-restrictions.settings.avoid-all-caps", false)
		->default("matteociaroni-title-restrictions.settings.require-letter", false)
		->default("matteociaroni-title-restrictions.settings.min", 3)
		->default("matteociaroni-title-restrictions.settings.max", 80)
];
