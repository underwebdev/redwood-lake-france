/**
 * Generates WebP versions of hero background images and optionally
 * compresses/resizes originals. Run: npm run optimize-hero
 * Requires: npm install --save-dev sharp
 */

const fs = require('fs');
const path = require('path');

let sharp;
try {
  sharp = require('sharp');
} catch (e) {
  console.error('sharp is required. Run: npm install --save-dev sharp');
  process.exit(1);
}

const ROOT = path.join(__dirname, '..', 'public', 'img', 'backgrounds');
const DIRS = ['', 'tablet', 'mobile'];
const MAX_WIDTH = { '': 1920, tablet: 1024, mobile: 430 };
const JPEG_QUALITY = 82;
const WEBP_QUALITY = 80;

async function processFile(dir, filename) {
  const base = path.join(ROOT, dir);
  const filepath = path.join(base, filename);
  if (!fs.existsSync(filepath)) return;
  const ext = path.extname(filename).toLowerCase();
  if (ext !== '.jpg' && ext !== '.jpeg') return;

  const name = path.basename(filename, ext);
  const webpPath = path.join(base, name + '.webp');
  const maxW = MAX_WIDTH[dir] || 1920;

  try {
    let pipeline = sharp(filepath);
    const meta = await pipeline.metadata();
    const width = meta.width || 1920;
    if (width > maxW) {
      pipeline = pipeline.resize(maxW, null, { withoutEnlargement: true });
    }
    await pipeline
      .webp({ quality: WEBP_QUALITY })
      .toFile(webpPath);
    console.log('  created', path.relative(ROOT, webpPath));
  } catch (err) {
    console.error('  error', filepath, err.message);
  }
}

async function main() {
  if (!fs.existsSync(ROOT)) {
    console.log('Backgrounds folder not found:', ROOT);
    return;
  }
  console.log('Optimizing hero images in', ROOT);
  for (const dir of DIRS) {
    const base = path.join(ROOT, dir);
    if (!fs.existsSync(base)) continue;
    const files = fs.readdirSync(base).filter(f => /\.(jpe?g)$/i.test(f));
    for (const f of files) {
      await processFile(dir, f);
    }
  }
  console.log('Done. Rebuild CSS (npm run dev or npm run build) if needed.');
}

main();
