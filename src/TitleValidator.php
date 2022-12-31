<?php

namespace Matteo\TitlesRestrictions;

use Flarum\Settings\SettingsRepositoryInterface;
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
			$min = $this->settings->get("matteo-titles-restrictions.settings.min");
			$max = $this->settings->get("matteo-titles-restrictions.settings.max");

			// if rule start with "min:", replace the value
			if($min > 0 && $min < $max && \Illuminate\Support\Str::startsWith($rule, "min:"))
				return "min:" . $min;

			// if rule start with "max:", replace the value
			if($max > $min && \Illuminate\Support\Str::startsWith($rule, "max:"))
				return "max:" . $max;

			// else return the original value
			return $rule;

		}, $rules["title"]);

		// rule to require at least one letter in titles
		$rules["title"][] = function($attribute, $value, $fail) {
			$enabled = $this->settings->get("matteo-titles-restrictions.settings.require-letter");

			if($enabled && !preg_match('/[A-Za-z]/', $value))
				$fail("The title must contain some letters");
		};

		// rule to avoid all-caps in titles
		$rules["title"][] = function($attribute, $value, $fail) {
			$enabled = $this->settings->get("matteo-titles-restrictions.settings.avoid-all-caps");

			if($enabled && $value == strtoupper($value) && $value != strtolower($value))
				$fail("You can not write all-caps titles");
		};

		$validator->setRules($rules);
	}
}