/**
 * Generates WebP versions of key content images at display and full widths
 * for responsive delivery. Run: npm run optimize-content-images
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

const IMG_DIR = path.join(__dirname, '..', 'public', 'img');
const WEBP_QUALITY = 80;

// [filename, [widths in px for srcset]]
const IMAGES = [
  ['rob-burgess-common.JPG', [630, 800]],
  ['new-facillity.jpg', [620, 700]],
];

async function processImage(filename, widths) {
  const filepath = path.join(IMG_DIR, filename);
  if (!fs.existsSync(filepath)) {
    console.log('  skip (not found):', filename);
    return;
  }
  const ext = path.extname(filename);
  const name = path.basename(filename, ext);

  for (const w of widths) {
    const outName = w === Math.max(...widths) ? `${name}.webp` : `${name}-${w}w.webp`;
    const outPath = path.join(IMG_DIR, outName);
    try {
      await sharp(filepath)
        .resize(w, null, { withoutEnlargement: true })
        .webp({ quality: WEBP_QUALITY })
        .toFile(outPath);
      console.log('  created', outName);
    } catch (err) {
      console.error('  error', filepath, err.message);
    }
  }
}

async function main() {
  if (!fs.existsSync(IMG_DIR)) {
    console.log('Img folder not found:', IMG_DIR);
    return;
  }
  console.log('Optimizing content images in', IMG_DIR);
  for (const [filename, widths] of IMAGES) {
    await processImage(filename, widths);
  }
  console.log('Done.');
}

main();
