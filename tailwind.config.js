module.exports = {
	purge: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
	  ],
	theme: {
		extend: {
			colors: {
				"modal-700": "rgba(0, 0, 0, 0.70)",
				'primary': '#c53030',
			},
		},
	},
	variants: {},
	plugins: [],
}
