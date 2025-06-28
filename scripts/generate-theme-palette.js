const fs = require('fs');
const path = require('path');

const inputFile = path.resolve(__dirname, '../assets/styles/_tokens.scss');
const outputFile = path.resolve(__dirname, '../theme-palette.json');

const content = fs.readFileSync(inputFile, 'utf8');
const lines = content.split('\n');

const palette = [];

lines.forEach(line => {
  const match = line.match(/--color-(.+?):\s*(#(?:[a-fA-F0-9]{3,8}));/);
  if (match) {
    const slug = match[1]
      .replace(/[^a-z0-9\-]/gi, '-')
      .toLowerCase();

    const name = slug
      .replace(/-/g, ' ')
      .replace(/\b(\w)/g, s => s.toUpperCase());

    palette.push({
      slug,
      name,
      color: match[2]
    });
  }
});

fs.writeFileSync(outputFile, JSON.stringify({ color: { palette } }, null, 2));
console.log(`✅ Generated ${outputFile} with ${palette.length} colors`);
