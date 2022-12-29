<?php

namespace Matteo\TitlesRestrictions;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Validation\Validator;
use Symfony\Contracts\Translation\TranslatorInterface;

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

			// if rule start with "min:", replace the value
			if(\Illuminate\Support\Str::startsWith($rule, "min:"))
				return "min:" . $this->settings->get("matteo-prevent-all-caps-titles.settings.min");

			// if rule start with "max:", replace the value
			if(\Illuminate\Support\Str::startsWith($rule, "max:"))
				return "max:" . $this->settings->get("matteo-prevent-all-caps-titles.settings.max");

			// else return the original value
			return $rule;

		}, $rules["title"]);

		// rule to require at least one letter in titles
		$rules["title"][] = function($attribute, $value, $fail) {
			$enabled = $this->settings->get("matteo-prevent-all-caps-titles.settings.require-letter");

			if($enabled && !preg_match('/[A-Za-z]/', $value))
				$fail("The title must contain some letters");
		};

		// rule to avoid all-caps in titles
		$rules["title"][] = function($attribute, $value, $fail) {
			$enabled = $this->settings->get("matteo-prevent-all-caps-titles.settings.avoid-all-caps");

			if($enabled && $value == strtoupper($value) && $value != strtolower($value))
				$fail("You can not write all-caps titles");
		};

		$validator->setRules($rules);
	}
}