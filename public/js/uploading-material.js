
const fileInput = document.getElementById('file-input');
const dragZone  = document.querySelector('.drag-file');
const chooseBtn = document.querySelector('.choose-file-btn');
const filesListEl    = document.getElementById('files-list');
const previewSection = document.getElementById('uploaded-files-preview');

let uploadedFiles = [];
let db = null;
// const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';

const iconPdf = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"/><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"/><path d="M17 18h2"/><path d="M20 15h-3v6"/><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"/></svg>`;
const iconWord = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2"/><path d="M9 12l1.333 5l1.333 -3l1.333 3l1.333 -5"/></svg>`;
const iconImg = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01"/><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12"/><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"/><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"/></svg>`;

// ===== Setup bta3 el IndexedDB 3ashan n-save el files local =====
const dbRequest = indexedDB.open('CognifyDB', 1);
dbRequest.onupgradeneeded = (e) => {
    const database = e.target.result;
    if (!database.objectStoreNames.contains('materials')) {
        database.createObjectStore('materials', { keyPath: 'id', autoIncrement: true });
    }
};
dbRequest.onsuccess = (e) => {
    db = e.target.result;
    loadFromDB(); // Load existing files on page open
};
dbRequest.onerror = () => console.error('IndexedDB failed to open');

// Function bt-load el files el metsayva fel database
function loadFromDB() {
    if (!db) return;
    const tx    = db.transaction('materials', 'readonly');
    const store = tx.objectStore('materials');
    const req   = store.getAll();
    req.onsuccess = () => {
        if (req.result.length > 0) {
            uploadedFiles = req.result;
            renderFiles();
        }
    };
}

// Function b-tsave el files el gdeda w t-msa7 el adeem
function saveToDB(callback) {
    if (!db) { callback(); return; }
    const tx    = db.transaction('materials', 'readwrite');
    const store = tx.objectStore('materials');
    store.clear();
    uploadedFiles.forEach(f => store.add(f));
    tx.oncomplete = callback;
    tx.onerror = callback; // navigate even if error
}

// ===== Events bta3et rafa3 el files (Click, Drag, Drop) =====
chooseBtn.addEventListener('click', (e) => { e.stopPropagation(); fileInput.click(); });
dragZone.addEventListener('click', (e)  => { if (e.target.tagName === 'BUTTON') return; fileInput.click(); });
dragZone.addEventListener('dragover',  (e) => { e.preventDefault(); dragZone.style.borderColor = '#4f46e5'; });
dragZone.addEventListener('dragleave', ()  => { dragZone.style.borderColor = ''; });
dragZone.addEventListener('drop', (e) => { e.preventDefault(); dragZone.style.borderColor = ''; handleFiles(e.dataTransfer.files); });
fileInput.addEventListener('change', () => handleFiles(fileInput.files));

// Function b-thandel el files lma tt-rafa3
function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            uploadedFiles.push({ name: file.name, type: file.type, size: file.size, dataUrl: e.target.result });
            renderFiles();
        };
        reader.readAsDataURL(file);
    });
}

// Function b-t-render el files 3ala el shasha w t-zahr el preview
function renderFiles() {
    previewSection.style.display = 'block';
    filesListEl.innerHTML = '';
    uploadedFiles.forEach((f, i) => {
        const ext  = f.name.split('.').pop().toUpperCase();
        const icon = ext === 'PDF' ? iconPdf : (ext === 'DOCX' || ext === 'DOC') ? iconWord : iconImg;
        const item = document.createElement('div');
        item.style.cssText = 'display:flex;align-items:center;gap:12px;background:#fff;border:1px solid #e5e7eb;padding:12px 16px;border-radius:10px;font-family:Inter,sans-serif;';
        item.innerHTML = `
            <span style="display:flex;align-items:center;color:#4f46e5;">${icon}</span>
            <div style="flex:1;">
                <div style="font-weight:600;font-size:14px;">${f.name}</div>
                <div style="font-size:12px;color:#888;">${ext} &bull; ${(f.size/1024).toFixed(1)} KB</div>
            </div>
            <button onclick="removeFile(${i})" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:18px;">&times;</button>`;
        filesListEl.appendChild(item);
    });
}

// Function 3ashan n-msa7 file mn el list
function removeFile(index) {
    uploadedFiles.splice(index, 1);
    if (uploadedFiles.length === 0) previewSection.style.display = 'none';
    else renderFiles();
}

// El functions de b-tetnada mn el HTML b-shakl mobasher
window.removeFile = removeFile;

window.skipToSession = function() { 
    const baseUrl = window.APP_PATHS?.TEMPLATES_URL || '';
    window.location.href = `${baseUrl}/focus-session.php`; 
}

window.continueToSession = function() {
    const nav = () => { 
        const baseUrl = window.APP_PATHS?.TEMPLATES_URL || '';
        window.location.href = `${baseUrl}/focus-session.php`; 
    };
    try {
        saveToDB(nav);
    } catch (error) {
        console.error('Failed to save to IndexedDB:', error);
        nav();
    }
}
