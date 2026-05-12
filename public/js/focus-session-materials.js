// ===== Materials Card — IndexedDB =====
const materialsList  = document.getElementById('materials-list');
const fileViewerModal = document.getElementById('file-viewer-modal');
const iframeContainer = document.getElementById('iframe-container');
const viewerFileName = document.getElementById('viewer-file-name');
const viewerFileIcon = document.getElementById('viewer-file-icon');
const closeViewerBtn = document.getElementById('close-viewer-btn');
let currentBlobUrl   = null;

const iconPdf = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"/><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"/><path d="M17 18h2"/><path d="M20 15h-3v6"/><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"/></svg>`;
const iconWord = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2"/><path d="M9 12l1.333 5l1.333 -3l1.333 3l1.333 -5"/></svg>`;
const iconImg = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01"/><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12"/><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"/><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"/></svg>`;
const iconWarn = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4"/><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"/><path d="M12 16h.01"/></svg>`;
const iconWordBig = `<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color:var(--primary-color)"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2"/><path d="M9 12l1.333 5l1.333 -3l1.333 3l1.333 -5"/></svg>`;
const iconDown = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"/><path d="M7 11l5 5l5 -5"/><path d="M12 4l0 12"/></svg>`;

// bn-open el IndexedDB 3ashan n-load el files el metsayva
const idbRequest = indexedDB.open('CognifyDB', 1);
idbRequest.onupgradeneeded = (e) => {
    const database = e.target.result;
    if (!database.objectStoreNames.contains('materials')) {
        database.createObjectStore('materials', { keyPath: 'id', autoIncrement: true });
    }
};
idbRequest.onsuccess = (e) => {
    const db  = e.target.result;
    const tx  = db.transaction('materials', 'readonly');
    const req = tx.objectStore('materials').getAll();
    req.onsuccess = () => renderMaterials(req.result || []);
};
idbRequest.onerror = () => {
    if (materialsList) materialsList.innerHTML = '<p class="tip-text" style="font-size:12px;margin:0;">Could not load materials.</p>';
};

// Function b-t-render el materials fel sidebar
function renderMaterials(materials) {
    if (!materialsList) return;
    materialsList.innerHTML = '';
    if (materials.length === 0) {
        materialsList.innerHTML = '<p class="tip-text" style="font-size:12px;margin:0;">No materials uploaded.</p>';
        return;
    }
    materials.forEach(file => {
        const ext  = file.name.split('.').pop().toUpperCase();
        const icon = ext === 'PDF' ? iconPdf : (ext === 'DOCX' || ext === 'DOC') ? iconWord : iconImg;
        const item = document.createElement('div');
        item.className = 'sidebar-note-item';
        item.style.cssText = 'display:flex;align-items:center;gap:8px;';
        item.innerHTML = `<span style="display:flex;align-items:center;color:var(--text-main);">${icon}</span><span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${file.name}</span>`;
        item.addEventListener('click', () => openFileViewer(file));
        materialsList.appendChild(item);
    });
}

// Function b-t-convert el dataUrl l-Blob 3ashan na3raf n-shofo
function dataURLtoBlob(dataUrl) {
    const [header, data] = dataUrl.split(',');
    const mime = header.match(/:(.*?);/)[1];
    const binary = atob(data);
    const arr = new Uint8Array(binary.length);
    for (let i = 0; i < binary.length; i++) arr[i] = binary.charCodeAt(i);
    return new Blob([arr], { type: mime });
}

// Function bt-fta7 el file viewer (el modal) lma tdous 3la file
function openFileViewer(file) {
    const ext = file.name.split('.').pop().toUpperCase();
    viewerFileName.textContent = file.name;
    viewerFileIcon.innerHTML = ext === 'PDF' ? iconPdf : ['JPG','JPEG','PNG','GIF'].includes(ext) ? iconImg : iconWord;

    // bn-revoke el blob URL el adeem 3ashan n-faragh el memory (memory leak prevention)
    if (currentBlobUrl) { URL.revokeObjectURL(currentBlobUrl); currentBlobUrl = null; }

    if (!file.dataUrl) {
        iframeContainer.innerHTML = `<div style="display:flex;align-items:center;justify-content:center;gap:8px;height:100%;color:#888;font-family:Inter,sans-serif;font-size:15px;">${iconWarn} File too large to preview — was stored without data.</div>`;
        fileViewerModal.style.display = 'flex';
        return;
    }

    // bn-reset el iframe abl ma n-7ot el gdeed
    iframeContainer.innerHTML = '<iframe id="viewer-iframe" src="" style="width:100%;height:100%;border:none;"></iframe>';
    const iframe = document.getElementById('viewer-iframe');

    if (ext === 'PDF') {
        // bn-create blob URL lel PDF
        const blob = dataURLtoBlob(file.dataUrl);
        currentBlobUrl = URL.createObjectURL(blob);
        iframe.src = currentBlobUrl;

    } else if (['JPG','JPEG','PNG','GIF'].includes(ext)) {
        // bn-show el soura 3alatoul mn gher iframe
        iframeContainer.innerHTML = `<div style="display:flex;align-items:center;justify-content:center;height:100%;background:#111;overflow:auto;padding:20px;">
            <img src="${file.dataUrl}" style="max-width:100%;max-height:100%;object-fit:contain;border-radius:8px;">
        </div>`;

    } else if (ext === 'DOCX' || ext === 'DOC') {
        // malafat el Word msh b-tfta7 fl browser fa-bnedy 5ayar lel download
        const blob = dataURLtoBlob(file.dataUrl);
        currentBlobUrl = URL.createObjectURL(blob);
        iframeContainer.innerHTML = `<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:20px;font-family:Inter,sans-serif;">
            ${iconWordBig}
            <p style="color:var(--text-main);font-size:16px;font-weight:600;">${file.name}</p>
            <p style="color:var(--text-muted);font-size:13px;">Word documents can't be previewed directly in the browser.</p>
            <a href="${currentBlobUrl}" download="${file.name}" style="background:var(--primary-color);color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">${iconDown} Download to View</a>
        </div>`;

    } else {
        // ay 7aga tanya bn7awel n-fta7ha ka-blob
        const blob = dataURLtoBlob(file.dataUrl);
        currentBlobUrl = URL.createObjectURL(blob);
        iframe.src = currentBlobUrl;
    }

    fileViewerModal.style.display = 'flex';
}

// Function 3ashan n-2fel el viewer modal
function closeViewer() {
    fileViewerModal.style.display = 'none';
    if (currentBlobUrl) { URL.revokeObjectURL(currentBlobUrl); currentBlobUrl = null; }
    // bn-raga3 el iframe fadya tany
    iframeContainer.innerHTML = '<iframe id="viewer-iframe" src="" style="width:100%;height:100%;border:none;"></iframe>';
}

if (closeViewerBtn) {
    closeViewerBtn.addEventListener('click', closeViewer);
}

fileViewerModal.addEventListener('click', (e) => {
    if (e.target === fileViewerModal) closeViewer();
});
