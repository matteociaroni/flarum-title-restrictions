import app from "flarum/admin/app";

app.initializers.add("matteociaroni/flarum-title-restrictions", () => {

	// register permission to write all-caps titles
	app.extensionData
		.for("matteociaroni-title-restrictions")

		// set min title length
		.registerSetting({
			setting: "matteociaroni-title-restrictions.settings.min",
			label: app.translator.trans("matteociaroni-title-restrictions.admin.min.label"),
			help: app.translator.trans("matteociaroni-title-restrictions.admin.min.help"),
			type: "number",
			min: 1,
			default: 3,
			max: 200
		})
		// set max title length
		.registerSetting({
			setting: "matteociaroni-title-restrictions.settings.max",
			label: app.translator.trans("matteociaroni-title-restrictions.admin.max.label"),
			help: app.translator.trans("matteociaroni-title-restrictions.admin.max.help"),
			type: "number",
			min: 1,
			default: 80,
			max: 200
		})
		// avoid all-caps titles
		.registerSetting({
			setting: "matteociaroni-title-restrictions.settings.avoid-all-caps",
			label: app.translator.trans("matteociaroni-title-restrictions.admin.avoid-all-caps.label"),
			help: app.translator.trans("matteociaroni-title-restrictions.admin.avoid-all-caps.help"),
			type: "boolean",
			default: false,
		})
		// require at least a letter
		.registerSetting({
			setting: "matteociaroni-title-restrictions.settings.require-letter",
			label: app.translator.trans("matteociaroni-title-restrictions.admin.require-letter.label"),
			help: app.translator.trans("matteociaroni-title-restrictions.admin.require-letter.help"),
			type: "boolean",
			default: false,
		})
});