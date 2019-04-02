import svelte from 'rollup-plugin-svelte';
import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import { terser } from 'rollup-plugin-terser';
import getPreprocessor from 'svelte-preprocess';

import { upgradeTemplate } from 'svelte-upgrade/dist/index.js';

const production = !process.env.ROLLUP_WATCH;

const preprocess = getPreprocessor({
	transformers: {
		hbs({ content, filename }) {
			const code = upgradeTemplate(content);
			return { code, map: null };
		}
	}
});

export default {
	input: 'src/main.js',
	output: {
		sourcemap: true,
		format: 'iife',
		name: 'app',
		file: 'public/bundle.js'
	},
	plugins: [
		svelte({
			dev: !production,
			hydratable: true,
			immutable: true,
			css: css => {
				css.write('public/bundle.css');
			},
			preprocess
		}),
		resolve(),
		commonjs(),
		production && terser()
	]
};
