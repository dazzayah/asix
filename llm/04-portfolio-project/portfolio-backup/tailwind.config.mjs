/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}',
		"./node_modules/flowbite/**/*.js"
	],
	darkMode: 'class',
	theme: {
		extend: {
			colors: {
				'papaya': '#FFEFD3',
				'peach': '#FFC39B',
				'french-gray': '#ADB6C4',
				'charcoal': '#294C60',
				'oxford-blue': '#1C1B22'
			},
		},
		screens: {
			'lg': '1200px', // Breakpoint añadido
		},
	},
	plugins: [
		require('flowbite/plugin')
	],
};
