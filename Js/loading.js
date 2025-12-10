function Loading(){
	let overlay = document.getElementById('loading-overlay');
    if (!overlay) {
        // crear dinámicamente el overlay si no existe
        overlay = document.createElement('div');
        overlay.id = 'loading-overlay';
        overlay.innerHTML = `
            <div class="loader">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                    <circle fill="none" stroke-opacity="1" 
                            stroke="var(--color-principal, #FF156D)" 
                            stroke-width=".5" cx="100" cy="100" r="0">
                        <animate attributeName="r" calcMode="spline" dur="1.5s" 
                                 values="1;80" keyTimes="0;1" 
                                 keySplines="0 .2 .5 1" repeatCount="indefinite" />
                        <animate attributeName="stroke-width" calcMode="spline" dur="1.5s" 
                                 values="0;25" keyTimes="0;1" 
                                 keySplines="0 .2 .5 1" repeatCount="indefinite" />
                        <animate attributeName="stroke-opacity" calcMode="spline" dur="1.5s" 
                                 values="1;0" keyTimes="0;1" 
                                 keySplines="0 .2 .5 1" repeatCount="indefinite" />
                    </circle>
                </svg>
            </div>
        `;
        document.body.appendChild(overlay);
    }

    // activa el overlay con transición
    requestAnimationFrame(() => {
        overlay.classList.add('active');
    });
}

function EndLoading(){
	const overlay = document.getElementById('loading-overlay');
    if (!overlay) return;

    // animación de salida suave
    overlay.classList.remove('active');
    // esperar que termine la transición antes de ocultar completamente
    setTimeout(() => {
        if (overlay && !overlay.classList.contains('active')) {
            overlay.remove();
        }
    }, 400); 
}