import app from "flarum/admin/app";

app.initializers.add("matteo/flarum-titles-restrictions", () => {

	// register permission to write all-caps titles
	app.extensionData
		.for("matteo-titles-restrictions")

		// set min title length
		.registerSetting({
			setting: "matteo-titles-restrictions.settings.min",
			label: app.translator.trans("matteo-titles-restrictions.admin.min.label"),
			help: app.translator.trans("matteo-titles-restrictions.admin.min.help"),
			type: "number",
			min: 1,
			default: 3,
			max: 200
		})
		// set max title length
		.registerSetting({
			setting: "matteo-titles-restrictions.settings.max",
			label: app.translator.trans("matteo-titles-restrictions.admin.max.label"),
			help: app.translator.trans("matteo-titles-restrictions.admin.max.help"),
			type: "number",
			min: 1,
			default: 80,
			max: 200
		})
		// avoid all-caps titles
		.registerSetting({
			setting: "matteo-titles-restrictions.settings.avoid-all-caps",
			label: app.translator.trans("matteo-titles-restrictions.admin.avoid-all-caps.label"),
			help: app.translator.trans("matteo-titles-restrictions.admin.avoid-all-caps.help"),
			type: "boolean",
			default: false,
		})
		// require at least a letter
		.registerSetting({
			setting: "matteo-titles-restrictions.settings.require-letter",
			label: app.translator.trans("matteo-titles-restrictions.admin.require-letter.label"),
			help: app.translator.trans("matteo-titles-restrictions.admin.require-letter.help"),
			type: "boolean",
			default: false,
		})
});