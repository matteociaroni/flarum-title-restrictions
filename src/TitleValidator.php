<?php

namespace Matteo\TitleRestrictions;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * This class manages requirements for discussion titles:
 * - replace min and max length
 * - avoid all-caps (if enabled)
 * - require at least one letter (if enabled)
 */
class TitleValidator
{
	public function __construct(SettingsRepositoryInterface $settings)
	{
		$this->settings = $settings;
	}

	public function __invoke($flarumValidator, Validator $validator)
	{
		$rules = $validator->getRules();

		// replace the default min and max values for titles
		$rules["title"] = array_map(function(string $rule) {
			$min = max($this->settings->get("matteo-title-restrictions.settings.min"), 1);		// min must be greater than 0
			$max = min($this->settings->get("matteo-title-restrictions.settings.max"), 200);	// max must be less than 201

			if($min <= $max && Str::startsWith($rule, "min:"))
				return "min:" . $min;

			if($min <= $max && Str::startsWith($rule, "max:"))
				return "max:" . $max;

			return $rule;

		}, $rules["title"]);

		// rule to require at least one letter in titles
		$rules["title"][] = function($attribute, $value, $fail) {
			$enabled = $this->settings->get("matteo-title-restrictions.settings.require-letter");

			if($enabled && !preg_match('/[A-Za-z]/', $value))
				$fail("The title must contain some letters");
		};

		// rule to avoid all-caps in titles
		$rules["title"][] = function($attribute, $value, $fail) {
			$enabled = $this->settings->get("matteo-title-restrictions.settings.avoid-all-caps");

			if($enabled && $value == strtoupper($value) && $value != strtolower($value))
				$fail("You can not write all-caps titles");
		};

		$validator->setRules($rules);
	}
}