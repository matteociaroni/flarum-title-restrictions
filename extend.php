<?php

use Flarum\Extend;
use Flarum\Foundation\ValidationException;
use Flarum\Discussion\Event\Saving;

return [

	(new Extend\Frontend("admin"))->js(__DIR__ . "/js/dist/admin.js"),

	new Extend\Locales(__DIR__ . "/locale"),

	(new Extend\Event)->listen(Saving::class, function($event) {

		$title = $event->data["attributes"]["title"];
		$userCanBypass = $event->actor->hasPermission("matteo-prevent-all-caps-titles.bypass");

		if($title && !$userCanBypass && $title == strtoupper($title))
			throw new ValidationException(["error" => app("translator")->trans("matteo-prevent-all-caps-titles.api.error")]);
	})
];
