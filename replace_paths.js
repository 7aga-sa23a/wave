const fs = require('fs');
const path = require('path');

const templatesDir = path.join(__dirname, 'src', 'templates');
const files = fs.readdirSync(templatesDir).filter(f => f.endsWith('.php'));

files.forEach(file => {
    const filePath = path.join(templatesDir, file);
    let content = fs.readFileSync(filePath, 'utf-8');
    
    // Add config require if not present
    if (!content.includes('require_once __DIR__ . \'/../core/config.php\';') && 
        !content.includes('require __DIR__ . \'/../core/config.php\';') &&
        !content.includes("require_once __DIR__ . '/../core/config.php';")) {
        content = `<?php require_once __DIR__ . '/../core/config.php'; ?>\n` + content;
    }

    // Replace CSS
    content = content.replace(/(["'])(\.\.\/css\/)(.*?)\1/g, "$1<?= CSS_URL ?>/$3$1");
    
    // Replace JS
    content = content.replace(/(["'])(\.\.\/js\/)(.*?)\1/g, "$1<?= JS_URL ?>/$3$1");
    
    // Replace IMG
    content = content.replace(/(["'])(\.\.\/assets\/img\/)(.*?)\1/g, "$1<?= IMG_URL ?>/$3$1");
    
    // Replace COMPONENTS
    content = content.replace(/(["'])(\.\.\/components\/)(.*?)\1/g, "$1<?= COMPONENTS_URL ?>/$3$1");
    
    // Replace ../pages/ with TEMPLATES_URL
    content = content.replace(/(["'])(\.\.\/pages\/)(.*?)\1/g, "$1<?= TEMPLATES_URL ?>/$3$1");

    fs.writeFileSync(filePath, content, 'utf-8');
    console.log(`Updated ${file}`);
});
