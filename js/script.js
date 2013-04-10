var dropArea = document.getElementById('dropArea');
var destinationUrl = document.getElementById('url');
var imgs = document.getElementById('images');
var list = [];
var totalSize = 0;
var totalProgress = 0;

(function(){

    function initHandlers() {
        dropArea.addEventListener('drop', handleDrop, false);
        dropArea.addEventListener('dragover', handleDragOver, false);
    }
    
    function handleDragOver(event) {
        event.stopPropagation();
        event.preventDefault();

        dropArea.className = 'hover';
    }

    
    function handleDrop(event) {
        event.stopPropagation();
        event.preventDefault();

        processFiles(event.dataTransfer.files);
    }

    
    function processFiles(filelist) {
        if (!filelist || !filelist.length || list.length) return;

        totalSize = 0;
        totalProgress = 0;

        for (var i = 0; i < filelist.length && i < 5; i++) {
            list.push(filelist[i]);
            totalSize += filelist[i].size;
        }
        uploadNext();
    }

    
    function handleComplete(size) {
        uploadNext();
    }
    
    function uploadFile(file, status) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', destinationUrl.value);
        xhr.onload = function() {
            handleComplete(file.size);
        };
        xhr.onerror = function() {
            handleComplete(file.size);
        };
        xhr.upload.onloadstart = function(event) {
        }

        var formData = new FormData();  
        formData.append('myfile', file); 
        xhr.send(formData);

        var xmlHttp = null;
        try {
            xmlHttp = new XMLHttpRequest();
        } catch(e) {
            try {
                xmlHttp  = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                try {
                    xmlHttp  = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e) {
                    xmlHttp  = null;
                }
            }
        }
    }

    
    function uploadNext() {
        if (list.length) {
            dropArea.className = 'uploading';

            var nextFile = list.shift();
            uploadFile(nextFile, status);
        } else {
            dropArea.className = '';
        }
    }

    initHandlers();
})();
