/**
 * ASENA Presentation Portal - Suite Switcher & Interactive Scripts
 */
function switchSuite(suite) {
    const petshopDiv = document.getElementById('petshopSuites');
    const pharmaDiv = document.getElementById('pharmaSuites');
    const tabPetshopBtn = document.getElementById('tabPetshopBtn');
    const tabPharmaBtn = document.getElementById('tabPharmaBtn');

    if (!petshopDiv || !pharmaDiv || !tabPetshopBtn || !tabPharmaBtn) return;

    if (suite === 'pharmacy') {
        petshopDiv.style.display = 'none';
        pharmaDiv.style.display = 'grid';
        tabPetshopBtn.classList.remove('active');
        tabPharmaBtn.classList.add('active');
        document.body.classList.add('pharma-mode');
    } else {
        petshopDiv.style.display = 'grid';
        pharmaDiv.style.display = 'none';
        tabPetshopBtn.classList.add('active');
        tabPharmaBtn.classList.remove('active');
        document.body.classList.remove('pharma-mode');
    }
}
