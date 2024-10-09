  // Function to reload script and display courses
 
// Function to reload script
function reloadMailJs() {
    var scriptUrl = 'Mail.js';
    var existingScript = document.querySelector('script[src="' + scriptUrl + '"]');
    if (existingScript) {
        existingScript.parentNode.removeChild(existingScript);
    }

    var script = document.createElement('script');
    script.src = scriptUrl;
    script.onload = function() {
        console.log('Script reloaded: ' + scriptUrl);
        if (typeof init === 'function') {
            init(); // Reinitialize script after reload
        }
    };
    document.head.appendChild(script);
}
