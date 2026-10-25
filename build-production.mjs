import { cpSync, mkdirSync, readFileSync, rmSync, writeFileSync, readdirSync, statSync } from 'node:fs';
import { join, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';
import * as sass from 'sass';
import { minify } from 'terser';

const root = dirname(fileURLToPath(import.meta.url));
const out = join(root, 'production', 'blog');

const files = ['style.css', 'theme.json', 'screenshot.jpg'];
const dirs = ['inc', 'template-parts', 'assets/fonts', 'assets/images'];

rmSync(join(root, 'production'), { recursive: true, force: true });
mkdirSync(out, { recursive: true });

for (const name of readdirSync(root)) {
  if (name.endsWith('.php')) files.push(name);
}
for (const file of files) cpSync(join(root, file), join(out, file));
for (const dir of dirs) cpSync(join(root, dir), join(out, dir), { recursive: true });

const css = sass.compile(join(root, 'assets/scss/main.scss'), { style: 'compressed', sourceMap: false }).css;
mkdirSync(join(out, 'assets/css'), { recursive: true });
writeFileSync(join(root, 'assets/css/main.css'), css);
writeFileSync(join(out, 'assets/css/main.css'), css);

const js = await minify(readFileSync(join(root, 'assets/js/main.js'), 'utf8'), {
  compress: true,
  mangle: true,
  format: { comments: false },
});
mkdirSync(join(out, 'assets/js'), { recursive: true });
writeFileSync(join(out, 'assets/js/main.js'), js.code);

let count = 0;
let size = 0;
const walk = (dir) => {
  for (const name of readdirSync(dir)) {
    const path = join(dir, name);
    const stat = statSync(path);
    if (stat.isDirectory()) walk(path);
    else { count++; size += stat.size; }
  }
};
walk(out);
console.log(`production/blog: ${count} files, ${(size / 1024).toFixed(0)} KB`);
