export default [
	{
		name: "page_type",
		label: "Enter your page type",
		type: "select",
		label: "Select page type",
		multiple: false,
		data_list: [
			{
				label: "Future_plan",
				value: "future_plan",
			},
			{
				label: "Mission",
				value: "mission",
			},
			{
				label: "Vission",
				value: "vission",
			},
			{
				label: "None",
				value: "none",
			},
		],
		value: "",
	},

	{
		name: "description",
		label: "Enter your description",
		type: "textarea",
		value: "",
		row_col_class: "col-md-12",
	},
];
