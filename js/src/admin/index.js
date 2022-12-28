import app from "flarum/admin/app";

app.initializers.add("matteo/flarum-ext-prevent-all-caps-titles", () => {

	// register permission to write all-caps titles
	app.extensionData
		.for("matteo-prevent-all-caps-titles")
		.registerPermission(
			{
				icon: "fas square-a-lock",
				label: "Can write title in all-caps",
				permission: "matteo-prevent-all-caps-titles.bypass",
				tagScoped: false,
				allowGuest: false
			},
			"start"
		);
});