document.addEventListener('DOMContentLoaded', function () {
    const storageTimestampKey = 'storageTimestamp';
    const currentTime = Date.now();
    const oneDayInMilliseconds = 12 * 60 * 60 * 1000;

    const lastTimestamp = localStorage.getItem(storageTimestampKey);

    if (!lastTimestamp || currentTime - lastTimestamp > oneDayInMilliseconds) {
        localStorage.clear();

        localStorage.setItem(storageTimestampKey, currentTime);
    }
});

document.addEventListener("keydown", function (event) {
    if ((event.ctrlKey && event.shiftKey && event.keyCode === 73) ||
        (event.ctrlKey && event.keyCode === 85) ||
        (event.ctrlKey && event.shiftKey && event.keyCode === 74) ||
		(event.ctrlKey && event.shiftKey && event.keyCode === 67) ||
        (event.ctrlKey && event.keyCode === 123) ||
        event.keyCode === 123) {
		event.preventDefault();

		const overlay = document.getElementById('overlayAccessBg');
		overlay.classList.toggle('active');
	  
		const access = document.getElementById('accessDenied');
		access.classList.toggle('active');
	}
});

document.addEventListener("contextmenu", function (event) {
    event.preventDefault();
	
		const overlay = document.getElementById('overlayAccessBg');
		overlay.classList.toggle('active');
	
		const access = document.getElementById('accessDenied');
		access.classList.toggle('active');
});

function hideaccessDenied() {
	const overlay = document.getElementById('overlayAccessBg');
	overlay.classList.toggle('active');
	
	const access = document.getElementById('accessDenied');
	access.classList.toggle('active');
}

(function() {
    let devtoolsOpen = false;

    const checkDevTools = () => {
        const widthThreshold = window.outerWidth - window.innerWidth > 100;
        const heightThreshold = window.outerHeight - window.innerHeight > 100;
        devtoolsOpen = widthThreshold || heightThreshold;

        if (devtoolsOpen) {
            const overlay = document.getElementById('overlayAccessBg');
			overlay.classList.toggle('active');
			
			const access = document.getElementById('accessDenied');
			access.classList.toggle('active');
        }
    };

    window.addEventListener('resize', checkDevTools);
    setInterval(checkDevTools, 1000);
})();
