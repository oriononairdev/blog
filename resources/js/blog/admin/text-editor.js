import EasyMDE from "easymde";
window.axios = require('axios');



const editors = document.getElementsByClassName("markdown-editor");
const token = document.head.querySelector("meta[name=\"csrf-token\"]");

function _replaceSelection(cm, active, startEnd, url) {
    if (/editor-preview-active/.test(cm.getWrapperElement().lastChild.className))
        return;

    var text;
    var start = startEnd[0];
    var end = startEnd[1];
    var startPoint = {},
        endPoint = {};
    Object.assign(startPoint, cm.getCursor('start'));
    Object.assign(endPoint, cm.getCursor('end'));
    if (url) {
        start = start.replace('#url#', url);  // url is in start for upload-image
        end = end.replace('#url#', url);
    }
    if (active) {
        text = cm.getLine(startPoint.line);
        start = text.slice(0, startPoint.ch);
        end = text.slice(startPoint.ch);
        cm.replaceRange(start + end, {
            line: startPoint.line,
            ch: 0,
        });
    } else {
        text = cm.getSelection();
        cm.replaceSelection(start + text + end);

        startPoint.ch += start.length;
        if (startPoint !== endPoint) {
            endPoint.ch += start.length;
        }
    }
    cm.setSelection(startPoint, endPoint);
    cm.focus();
}
function isSummary(editor,then,not) {
    then = then ?? true;
    not = not ?? false;
    return editor.id === 'summary' ? then:not;
}

Array.from(editors).forEach((editor) => {
    new EasyMDE({
        autoDownloadFontAwesome: false,
        autofocus: true,
        autosave: {
            enabled: true,
            delay: 10000,
            uniqueId: window.location+editor.id+Math.random()+Math.random()+Math.random(),
        },
        minHeight: isSummary(editor,'166px',''),
        spellChecker: false,
        autoRefresh: {delay: isSummary(editor,'0','300')},
        element: editor,
        previewImagesInEditor: false,
        previewClass: 'editor-preview markup',
        lineNumbers: !isSummary(editor),
        uploadImage: true,
        imageTexts: {
            sbInit: isSummary(editor,'','Attach files by drag and dropping or pasting from clipboard.'),
        },
        imageUploadFunction: function (file, onSuccess, onError) {
            const form_data = new FormData();
            let imageUrl;
            form_data.append('image', file);
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
            axios.post(editor.getAttribute("data-upload-url"), form_data)
                .then(function (response) {
                    imageUrl = response.data.data.filePath;
                    if (response.data.error) {
                        onError(response.data.error)
                        return;
                    }
                    onSuccess(imageUrl);
                    console.log(imageUrl)
                })
                .catch(function (error) {
                    console.log(error);
                    //onError(error);
                });

        },
        previewRender: function (plainText, preview) { // Async method
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
            axios.post(editor.getAttribute("data-preview-url"), {payload: plainText})
                .then(function (response) {
                    preview.innerHTML = response.data.data.html;
                });
            return "Loading...";
        },
        toolbar: [
            {
                name: "bold",
                action: EasyMDE.toggleBold,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M7.34,19 L7.34,4.8 L12.68,4.8 C15,4.8 16.9,6.7 16.9,9.02 C16.9,10.02 16.52,10.84 15.9,11.46 C17.1,12.1 17.9,13.26 17.9,14.78 C17.9,17.12 16,19 13.6,19 L7.34,19 Z M10.54,16.06 L13.3,16.06 C14.16,16.06 14.78,15.44 14.78,14.66 C14.78,13.88 14.16,13.24 13.3,13.24 L10.54,13.24 L10.54,16.06 Z M10.54,10.54 L12.32,10.54 C13.18,10.54 13.8,9.92 13.8,9.14 C13.8,8.36 13.18,7.72 12.32,7.72 L10.54,7.72 L10.54,10.54 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Bold",
            },
            {
                name: "italic",
                action: EasyMDE.toggleItalic,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <polygon fill="currentColor" points="10 19 13 5 15 5 12 19"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Italic",
            },
            {
                name: "headings",
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <polygon fill="currentColor" points="4.634 19 4.634 5.51 6.363 5.51 6.363 11.267 13.811 11.267 13.811 5.51 15.54 5.51 15.54 19 13.811 19 13.811 12.939 6.363 12.939 6.363 19"/>\n' +
                    '        <polygon fill="currentColor" opacity="0.3" points="18.998 19 18.998 6.992 20.632 5.358 20.632 19"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Headings",
                children: [
                    {
                        name: "Heading 1",
                        action: EasyMDE.toggleHeading1,
                        icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                            '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                            '        <rect x="0" y="0" width="24" height="24"/>\n' +
                            '        <polygon fill="currentColor" points="4.634 19 4.634 5.51 6.363 5.51 6.363 11.267 13.811 11.267 13.811 5.51 15.54 5.51 15.54 19 13.811 19 13.811 12.939 6.363 12.939 6.363 19"/>\n' +
                            '        <polygon fill="currentColor" opacity="0.3" points="18.998 19 18.998 6.992 20.632 5.358 20.632 19"/>\n' +
                            '    </g>\n' +
                            '</svg>',
                        title: "Heading 1",
                    },
                    {
                        name: "Heading 2",
                        action: EasyMDE.toggleHeading2,
                        icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                            '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                            '        <rect x="0" y="0" width="24" height="24"/>\n' +
                            '        <polygon fill="currentColor" points="1.634 19 1.634 5.51 3.363 5.51 3.363 11.267 10.811 11.267 10.811 5.51 12.54 5.51 12.54 19 10.811 19 10.811 12.939 3.363 12.939 3.363 19"/>\n' +
                            '        <path d="M14.649,19 L19.874,13.319 C19.646,13.357 19.475,13.376 19.247,13.376 C16.948,13.319 15.333,11.552 15.333,9.405 C15.333,7.125 17.119,5.358 19.418,5.358 C21.717,5.358 23.522,7.125 23.522,9.405 C23.522,11.001 22.819,12.255 21.185,14.022 L18.069,17.48 L23.522,17.48 L23.522,19 L14.649,19 Z M19.418,11.951 C20.862,11.951 21.907,10.868 21.907,9.405 C21.907,7.961 20.862,6.859 19.418,6.859 C17.955,6.859 16.948,7.961 16.948,9.405 C16.948,10.868 17.955,11.951 19.418,11.951 Z" fill="currentColor" opacity="0.3"/>\n' +
                            '    </g>\n' +
                            '</svg>',
                        title: "Heading 2",
                    },
                    {
                        name: "Heading 3",
                        action: EasyMDE.toggleHeading3,
                        className: 'h3-text',
                        title: "Heading 3",
                    },
                ]
            },
            {
                name: "strikethrough",
                action: EasyMDE.toggleStrikethrough,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <rect fill="currentColor" opacity="0.3" x="4" y="11" width="17" height="2" rx="1"/>\n' +
                    '        <path d="M12.06,19.16 C10,19.16 8.28,18.16 7.44,16.96 L8.82,15.76 C9.5,16.64 10.66,17.42 12.04,17.42 C13.68,17.42 14.72,16.66 14.72,15.42 C14.72,14.12 13.92,13.44 12.4,12.78 L11.1,12.22 C8.94,11.3 8,9.98 8,8.2 C8,6.04 10.04,4.64 12.14,4.64 C13.8,4.64 15.16,5.3 16.12,6.46 L14.84,7.74 C14.1,6.86 13.32,6.38 12.08,6.38 C10.88,6.38 9.82,7.06 9.82,8.24 C9.82,9.28 10.42,9.98 11.92,10.64 L13.22,11.2 C15.14,12.04 16.56,13.22 16.56,15.22 C16.56,17.54 14.84,19.16 12.06,19.16 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                className: 'Strikethrough',
                title: "Strikethrough",
            },
            "|",
            {
                name: 'paragraph',
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M10.754,19.864 L10.754,12.54 C8.15,12.54 6.029,10.419 6.029,7.815 C6.029,5.211 8.15,3.09 10.754,3.09 L16.319,3.09 L16.319,19.864 L14.681,19.864 L14.681,4.728 L12.413,4.728 L12.413,19.864 L10.754,19.864 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: 'Paragraph',
                children: [
                    {
                        name: "center",
                        action: function addCenter(editor){
                            var cm = editor.codemirror;
                            var stat = editor.getState(cm);
                            _replaceSelection(cm, stat.link, ['<p class="text-center">','</p>']);
                        },
                        icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                            '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                            '        <rect x="0" y="0" width="24" height="24"/>\n' +
                            '        <path d="M5,5 L19,5 C19.5522847,5 20,5.44771525 20,6 C20,6.55228475 19.5522847,7 19,7 L5,7 C4.44771525,7 4,6.55228475 4,6 C4,5.44771525 4.44771525,5 5,5 Z M5,13 L19,13 C19.5522847,13 20,13.4477153 20,14 C20,14.5522847 19.5522847,15 19,15 L5,15 C4.44771525,15 4,14.5522847 4,14 C4,13.4477153 4.44771525,13 5,13 Z" fill="currentColor" opacity="0.3"/>\n' +
                            '        <path d="M8,9 L16,9 C16.5522847,9 17,9.44771525 17,10 C17,10.5522847 16.5522847,11 16,11 L8,11 C7.44771525,11 7,10.5522847 7,10 C7,9.44771525 7.44771525,9 8,9 Z M8,17 L16,17 C16.5522847,17 17,17.4477153 17,18 C17,18.5522847 16.5522847,19 16,19 L8,19 C7.44771525,19 7,18.5522847 7,18 C7,17.4477153 7.44771525,17 8,17 Z" fill="currentColor"/>\n' +
                            '    </g>\n' +
                            '</svg>',
                        title: "Center",
                    },
                    {
                        name: "justify",
                        action: function addJustify(editor){
                            var cm = editor.codemirror;
                            var stat = editor.getState(cm);
                            _replaceSelection(cm, stat.link, ['<p class="text-justify">','</p>']);
                        },
                        icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                            '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                            '        <rect x="0" y="0" width="24" height="24"/>\n' +
                            '        <path d="M5,5 L19,5 C19.5522847,5 20,5.44771525 20,6 C20,6.55228475 19.5522847,7 19,7 L5,7 C4.44771525,7 4,6.55228475 4,6 C4,5.44771525 4.44771525,5 5,5 Z M5,13 L19,13 C19.5522847,13 20,13.4477153 20,14 C20,14.5522847 19.5522847,15 19,15 L5,15 C4.44771525,15 4,14.5522847 4,14 C4,13.4477153 4.44771525,13 5,13 Z" fill="currentColor" opacity="0.3"/>\n' +
                            '        <path d="M5,9 L19,9 C19.5522847,9 20,9.44771525 20,10 C20,10.5522847 19.5522847,11 19,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L19,17 C19.5522847,17 20,17.4477153 20,18 C20,18.5522847 19.5522847,19 19,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z" fill="currentColor"/>\n' +
                            '    </g>\n' +
                            '</svg>',
                        title: "Justify",
                    },
                    {
                        name: "Right",
                        action: function addRight(editor){
                            var cm = editor.codemirror;
                            var stat = editor.getState(cm);
                            _replaceSelection(cm, stat.link, ['<p class="text-right">','</p>']);
                        },
                        icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                            '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                            '        <rect x="0" y="0" width="24" height="24"/>\n' +
                            '        <path d="M5,5 L19,5 C19.5522847,5 20,5.44771525 20,6 C20,6.55228475 19.5522847,7 19,7 L5,7 C4.44771525,7 4,6.55228475 4,6 C4,5.44771525 4.44771525,5 5,5 Z M5,13 L19,13 C19.5522847,13 20,13.4477153 20,14 C20,14.5522847 19.5522847,15 19,15 L5,15 C4.44771525,15 4,14.5522847 4,14 C4,13.4477153 4.44771525,13 5,13 Z" fill="currentColor" opacity="0.3"/>\n' +
                            '        <path d="M11,9 L19,9 C19.5522847,9 20,9.44771525 20,10 C20,10.5522847 19.5522847,11 19,11 L11,11 C10.4477153,11 10,10.5522847 10,10 C10,9.44771525 10.4477153,9 11,9 Z M11,17 L19,17 C19.5522847,17 20,17.4477153 20,18 C20,18.5522847 19.5522847,19 19,19 L11,19 C10.4477153,19 10,18.5522847 10,18 C10,17.4477153 10.4477153,17 11,17 Z" fill="currentColor"/>\n' +
                            '    </g>\n' +
                            '</svg>',
                        title: "Right",
                    },
                ]
            },
            /*{
                name: 'pre',
                action: function addPre(editor){
                    var cm = editor.codemirror;
                    var stat = editor.getState(cm);
                    _replaceSelection(cm, stat.link, ['<pre>','</pre>']);
                },
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z M17,16 L17,10 C17,8.34314575 15.6568542,7 14,7 L8,7 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L17,16 Z" fill="currentColor" fill-rule="nonzero" opacity="0.3"/>\n' +
                    '        <path d="M9.27272727,9 L13.7272727,9 C14.5522847,9 15,9.44771525 15,10.2727273 L15,14.7272727 C15,15.5522847 14.5522847,16 13.7272727,16 L9.27272727,16 C8.44771525,16 8,15.5522847 8,14.7272727 L8,10.2727273 C8,9.44771525 8.44771525,9 9.27272727,9 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: 'Pre',
            },*/
            "|",
            {
                name: 'Highlighted Code',
                action: function addHighlightedCode(editor){
                    var cm = editor.codemirror;
                    var stat = editor.getState(cm);
                    _replaceSelection(cm, stat.link, ['```\n','\n```']);
                },
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M17.2718029,8.68536757 C16.8932864,8.28319382 16.9124644,7.65031935 17.3146382,7.27180288 C17.7168119,6.89328641 18.3496864,6.91246442 18.7282029,7.31463817 L22.7282029,11.5646382 C23.0906029,11.9496882 23.0906029,12.5503176 22.7282029,12.9353676 L18.7282029,17.1853676 C18.3496864,17.5875413 17.7168119,17.6067193 17.3146382,17.2282029 C16.9124644,16.8496864 16.8932864,16.2168119 17.2718029,15.8146382 L20.6267538,12.2500029 L17.2718029,8.68536757 Z M6.72819712,8.6853647 L3.37324625,12.25 L6.72819712,15.8146353 C7.10671359,16.2168091 7.08753558,16.8496835 6.68536183,17.2282 C6.28318808,17.6067165 5.65031361,17.5875384 5.27179713,17.1853647 L1.27179713,12.9353647 C0.909397125,12.5503147 0.909397125,11.9496853 1.27179713,11.5646353 L5.27179713,7.3146353 C5.65031361,6.91246155 6.28318808,6.89328354 6.68536183,7.27180001 C7.08753558,7.65031648 7.10671359,8.28319095 6.72819712,8.6853647 Z" fill="currentColor" fill-rule="nonzero"/>\n' +
                    '        <rect fill="currentColor" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-345.000000) translate(-12.000000, -12.000000) " x="11" y="4" width="2" height="16" rx="1"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: 'Highlighted Code',
            },
            {
                name: "quote",
                action: EasyMDE.toggleBlockquote,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <polygon fill="currentColor" transform="translate(16.500000, 12.500000) rotate(-180.000000) translate(-16.500000, -12.500000) " points="19 7 17 13 19 13 19 18 14 18 14 13 16 7"/>\n' +
                    '        <polygon fill="currentColor" opacity="0.3" transform="translate(8.500000, 12.500000) rotate(-180.000000) translate(-8.500000, -12.500000) " points="11 7 9 13 11 13 11 18 6 18 6 13 8 7"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Quote",
            },
            {
                name: "unordered-list",
                action: EasyMDE.toggleUnorderedList,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="currentColor"/>\n' +
                    '        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="currentColor" opacity="0.3"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Unordered-list",
            },
            {
                name: "Highlight",
                action: EasyMDE.toggleCodeBlock,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M9.61764706,5 L8.73529412,7 L3,7 C2.44771525,7 2,6.55228475 2,6 C2,5.44771525 2.44771525,5 3,5 L9.61764706,5 Z M14.3823529,5 L21,5 C21.5522847,5 22,5.44771525 22,6 C22,6.55228475 21.5522847,7 21,7 L15.2647059,7 L14.3823529,5 Z M6.08823529,13 L5.20588235,15 L3,15 C2.44771525,15 2,14.5522847 2,14 C2,13.4477153 2.44771525,13 3,13 L6.08823529,13 Z M17.9117647,13 L21,13 C21.5522847,13 22,13.4477153 22,14 C22,14.5522847 21.5522847,15 21,15 L18.7941176,15 L17.9117647,13 Z M7.85294118,9 L6.97058824,11 L3,11 C2.44771525,11 2,10.5522847 2,10 C2,9.44771525 2.44771525,9 3,9 L7.85294118,9 Z M16.1470588,9 L21,9 C21.5522847,9 22,9.44771525 22,10 C22,10.5522847 21.5522847,11 21,11 L17.0294118,11 L16.1470588,9 Z M4.32352941,17 L3.44117647,19 L3,19 C2.44771525,19 2,18.5522847 2,18 C2,17.4477153 2.44771525,17 3,17 L4.32352941,17 Z M19.6764706,17 L21,17 C21.5522847,17 22,17.4477153 22,18 C22,18.5522847 21.5522847,19 21,19 L20.5588235,19 L19.6764706,17 Z" fill="currentColor" opacity="0.3"/>\n' +
                    '        <path d="M11.044,5.256 L13.006,5.256 L18.5,19 L16,19 L14.716,15.084 L9.19,15.084 L7.5,19 L5,19 L11.044,5.256 Z M13.924,13.14 L11.962,7.956 L9.964,13.14 L13.924,13.14 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                className: 'bg-red-500',
                title: "Highlight",
            },
            "|",
            {
                name: "link",
                action: EasyMDE.drawLink,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z" fill="currentColor" opacity="0.3" transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641) "/>\n' +
                    '        <path d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z" fill="currentColor" transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359) "/>\n' +
                    '        <path d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z" fill="currentColor" opacity="0.3" transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146) "/>\n' +
                    '        <path d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z" fill="currentColor" opacity="0.3" transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961) "/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Link",
            },
            {
                name: "Link-image",
                action: EasyMDE.drawImage,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <polygon points="0 0 24 0 24 24 0 24"/>\n' +
                    '        <path d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Link-image",
            },
            {
                name: "upload-image",
                action: EasyMDE.drawUploadedImage,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="currentColor" opacity="0.3"/>\n' +
                    '        <path d="M8.54301601,14.4923287 L10.6661,14.4923287 L10.6661,16.5 C10.6661,16.7761424 10.8899576,17 11.1661,17 L12.33392,17 C12.6100624,17 12.83392,16.7761424 12.83392,16.5 L12.83392,14.4923287 L14.9570039,14.4923287 C15.2331463,14.4923287 15.4570039,14.2684711 15.4570039,13.9923287 C15.4570039,13.8681299 15.41078,13.7483766 15.3273331,13.6563877 L12.1203391,10.1211145 C11.934804,9.91658739 11.6185961,9.90119131 11.414069,10.0867264 C11.4020553,10.0976245 11.390579,10.1091008 11.3796809,10.1211145 L8.1726869,13.6563877 C7.98715181,13.8609148 8.00254789,14.1771227 8.20707501,14.3626578 C8.29906387,14.4461047 8.41881721,14.4923287 8.54301601,14.4923287 Z" fill="currentColor"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Upload-image",
            },
            "|",
            {
                name: "preview",
                action: EasyMDE.togglePreview,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="currentColor" fill-rule="nonzero" opacity="0.3"/>\n' +
                    '        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="currentColor" opacity="0.3"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                noDisable: true,
                title: "Preview",
            },
            {
                name: "side-by-side",
                action: EasyMDE.toggleSideBySide,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <rect fill="currentColor" x="5" y="4" width="6" height="16" rx="1.5"/>\n' +
                    '        <rect fill="currentColor" opacity="0.3" x="13" y="4" width="6" height="16" rx="1.5"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Side-by-side",
            },
            {
                name: "fullscreen",
                action: EasyMDE.toggleFullScreen,
                icon: '<svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <polygon points="0 0 24 0 24 24 0 24"/>\n' +
                    '        <path d="M10.5857864,12 L5.46446609,6.87867966 C5.0739418,6.48815536 5.0739418,5.85499039 5.46446609,5.46446609 C5.85499039,5.0739418 6.48815536,5.0739418 6.87867966,5.46446609 L12,10.5857864 L18.1923882,4.39339828 C18.5829124,4.00287399 19.2160774,4.00287399 19.6066017,4.39339828 C19.997126,4.78392257 19.997126,5.41708755 19.6066017,5.80761184 L13.4142136,12 L19.6066017,18.1923882 C19.997126,18.5829124 19.997126,19.2160774 19.6066017,19.6066017 C19.2160774,19.997126 18.5829124,19.997126 18.1923882,19.6066017 L12,13.4142136 L6.87867966,18.5355339 C6.48815536,18.9260582 5.85499039,18.9260582 5.46446609,18.5355339 C5.0739418,18.1450096 5.0739418,17.5118446 5.46446609,17.1213203 L10.5857864,12 Z" fill="currentColor" opacity="0.3" transform="translate(12.535534, 12.000000) rotate(-360.000000) translate(-12.535534, -12.000000) "/>\n' +
                    '        <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="currentColor" fill-rule="nonzero"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Fullscreen",
            },
            "|",
            {
                name: "undo",
                action: EasyMDE.undo,
                icon: '<svg class="w-5 h-5 mx-auto text-blue-500 hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M21.4451171,17.7910156 C21.4451171,16.9707031 21.6208984,13.7333984 19.0671874,11.1650391 C17.3484374,9.43652344 14.7761718,9.13671875 11.6999999,9 L11.6999999,4.69307548 C11.6999999,4.27886191 11.3642135,3.94307548 10.9499999,3.94307548 C10.7636897,3.94307548 10.584049,4.01242035 10.4460626,4.13760526 L3.30599678,10.6152626 C2.99921905,10.8935795 2.976147,11.3678924 3.2544639,11.6746702 C3.26907199,11.6907721 3.28437331,11.7062312 3.30032452,11.7210037 L10.4403903,18.333467 C10.7442966,18.6149166 11.2188212,18.596712 11.5002708,18.2928057 C11.628669,18.1541628 11.6999999,17.9721616 11.6999999,17.7831961 L11.6999999,13.5 C13.6531249,13.5537109 15.0443703,13.6779456 16.3083984,14.0800781 C18.1284272,14.6590944 19.5349747,16.3018455 20.5280411,19.0083314 L20.5280247,19.0083374 C20.6363903,19.3036749 20.9175496,19.5 21.2321404,19.5 L21.4499999,19.5 C21.4499999,19.0068359 21.4451171,18.2255859 21.4451171,17.7910156 Z" fill="currentColor" fill-rule="nonzero"/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Undo",
            },
            {
                name: "redo",
                action: EasyMDE.redo,
                icon: '<svg class="w-5 h-5 mx-auto text-red-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                    '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                    '        <rect x="0" y="0" width="24" height="24"/>\n' +
                    '        <path d="M21.4451171,17.7910156 C21.4451171,16.9707031 21.6208984,13.7333984 19.0671874,11.1650391 C17.3484374,9.43652344 14.7761718,9.13671875 11.6999999,9 L11.6999999,4.69307548 C11.6999999,4.27886191 11.3642135,3.94307548 10.9499999,3.94307548 C10.7636897,3.94307548 10.584049,4.01242035 10.4460626,4.13760526 L3.30599678,10.6152626 C2.99921905,10.8935795 2.976147,11.3678924 3.2544639,11.6746702 C3.26907199,11.6907721 3.28437331,11.7062312 3.30032452,11.7210037 L10.4403903,18.333467 C10.7442966,18.6149166 11.2188212,18.596712 11.5002708,18.2928057 C11.628669,18.1541628 11.6999999,17.9721616 11.6999999,17.7831961 L11.6999999,13.5 C13.6531249,13.5537109 15.0443703,13.6779456 16.3083984,14.0800781 C18.1284272,14.6590944 19.5349747,16.3018455 20.5280411,19.0083314 L20.5280247,19.0083374 C20.6363903,19.3036749 20.9175496,19.5 21.2321404,19.5 L21.4499999,19.5 C21.4499999,19.0068359 21.4451171,18.2255859 21.4451171,17.7910156 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.254964, 11.721538) scale(-1, 1) translate(-12.254964, -11.721538) "/>\n' +
                    '    </g>\n' +
                    '</svg>',
                title: "Redo",
            },
        ],
    });
});

/*if (editors.length) {
    const imageUploadEndpoint = editors[0].getAttribute("data-upload-url");
    /* eslint-disable no-new */
/*new EasyMDE({
    spellChecker: false,
    autoDownloadFontAwesome: true,
    element: editors[0],
    toolbar: [
        "bold",
        "italic",
        "heading",
        "strikethrough",
        "|",
        "quote",
        "unordered-list",
        "ordered-list",
        "code",
        "|",
        "link",
        imageUploadEndpoint !== "" ? "upload-image" : "image",
        "table",
        "horizontal-rule",
        "|",
        "preview",
        "side-by-side",
        "fullscreen",
        "|",
        "undo",
        "redo"
    ],
    autosave: {
        enabled: true,
        delay: 10000,
        uniqueId: window.location
    },
    uploadImage: imageUploadEndpoint !== "",
    imageUploadEndpoint: imageUploadEndpoint,
    imageMaxSize: parseInt(editors[0].getAttribute("data-max-size"), 10),
    // previewRender: function (plainText) {
    //   return MarkdownIt.render(plainText); // Returns HTML from a custom parser
    // }
    previewRender: function(plainText, preview) { // Async method
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
        axios.post(editors[0].getAttribute("data-preview-url"), {payload: plainText})
            .then(function(response) {
                preview.innerHTML = response.data.data.html;
            });
        return "";
    },
});
} */
