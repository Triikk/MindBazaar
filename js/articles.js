function updateRangeValue(id) {
    const rangeInput = document.getElementById(id);
    const rangeValue = document.getElementById(id + 'Value');
    if (id === 'prezzoMax' && parseInt(rangeInput.value) < parseInt(document.getElementById('prezzoMin').value)) {
        rangeInput.value = document.getElementById('prezzoMin').value;
    }
    rangeValue.textContent = rangeInput.value;
    if (id === 'prezzoMin') {
        const prezzoMaxInput = document.getElementById('prezzoMax');
        const prezzoMaxValue = document.getElementById('prezzoMaxValue');
        if (parseInt(prezzoMaxInput.value) < parseInt(rangeInput.value)) {
            prezzoMaxValue.textContent = rangeInput.value;
            prezzoMaxInput.value = rangeInput.value;
        }
    }
}

// Initialize the range values on page load
document.addEventListener('DOMContentLoaded', () => {
    updateRangeValue('prezzoMin');
    updateRangeValue('prezzoMax');
    updateRangeValue('etaMinima');
});
